<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  # get school year
  $sql_schoolyear = "SELECT * FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_schoolyear) or die(mysqli_error($con));

  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $sys = $row['SchoolYearStart'];
    $sye = $row['SchoolYearEnd'];
  }

  # get faculty
  $sql_faculty = "SELECT t.TeacherID, s.SubjectName, u.FirstName, u.LastName FROM teacher t INNER JOIN user u ON t.UserID = u.UserID INNER JOIN subject s ON t.SubjectID = s.SubjectID ORDER BY s.SubjectName ASC";
  $result_faculty = $con->query($sql_faculty) or die(mysqli_error($con));

  $list_faculty = "";
  while ($row = mysqli_fetch_array($result_faculty))
  {
    $teachid= $row['TeacherID'];
    $teachfn= $row['FirstName'];
    $teachln= $row['LastName'];
    $teachsubject= $row['SubjectName'];
    $list_faculty .="<option value='$teachid'>$teachsubject - $teachln, $teachfn</option>";
  }

  # get faculty
  $sql_getsections = "SELECT ss.SummerSectionID, s.SubjectName, l.LevelName FROM summersection ss INNER JOIN subject s ON ss.SubjectID = s.SubjectID INNER JOIN level l ON ss.LevelID = l.LevelID WHERE Status = 'Temporary'";
  $result_getsections = $con->query($sql_getsections) or die(mysqli_error($con));

  #total
  $sql_getenrollment = "SELECT s.SubjectName, l.LevelName, et.EnrollmentTypeName FROM summerstudent ss 
  INNER JOIN enrollment e
  ON ss.EnrollmentID = e.EnrollmentID
  INNER JOIN enrollmenttype et
  ON e.EnrollmentTypeID = et.EnrollmentTypeID 
  INNER JOIN subject s 
  ON ss.SubjectID = s.SubjectID
  INNER JOIN level l 
  ON ss.LevelID = l.LevelID";

  $result = $con->query($sql_getenrollment) or die(mysqli_error($con));

  $total = mysqli_num_rows($result);

  #Year level with enrollees
  $sql_level = "SELECT DISTINCT l.LevelID, l.LevelName FROM summerstudent ss 
  INNER JOIN enrollment e
  ON ss.EnrollmentID = e.EnrollmentID
  INNER JOIN enrollmenttype et
  ON e.EnrollmentTypeID = et.EnrollmentTypeID 
  INNER JOIN subject s 
  ON ss.SubjectID = s.SubjectID
  INNER JOIN level l 
  ON ss.LevelID = l.LevelID ORDER BY LevelName DESC";

  $result_level =$con->query($sql_level);

  $list_level = "";
  while($row = mysqli_fetch_array($result_level))
  {
     $lvlid= $row['LevelID'];
     $lvlname= $row['LevelName'];
     $list_level .="<option value='$lvlid'>$lvlname</option>";
  }

  $messagelevel = "";

  
  if ( isset($_POST['select']) ) 
  {
      if (!empty($_POST['selectlevel']))
      {
        $selectlvl = mysqli_real_escape_string($con, $_POST['selectlevel']);
        $_SESSION['summersectionlevel'] = $selectlvl;

        $sql_row = "SELECT DISTINCT s.SubjectID, s.SubjectName, l.LevelID, l.LevelName FROM summerstudent ss 
            INNER JOIN enrollment e
            ON ss.EnrollmentID = e.EnrollmentID
            INNER JOIN enrollmenttype et
            ON e.EnrollmentTypeID = et.EnrollmentTypeID 
            INNER JOIN subject s 
            ON ss.SubjectID = s.SubjectID
            INNER JOIN level l 
            ON ss.LevelID = l.LevelID WHERE l.LevelID = $selectlvl ORDER BY LevelName DESC";

        $result_row = $con->query($sql_row) or die(mysqli_error($con));

        $result_subject = $con->query($sql_row) or die(mysqli_error($con));

         $list_subject = "";
          while($row = mysqli_fetch_array($result_subject))
          {
             $subjectidadd= $row['SubjectID'];
             $subjectnameadd= $row['SubjectName'];
             $list_subject .="<option value='$subjectidadd'>$subjectnameadd</option>";
          }

        $messagelevel = "<p>Currently selected level ID : <b>" . $selectlvl . "</b></p><br>";

      }
      else 
      {
        $message ="Please select a year level first.";
      }
  }
  if ( isset($_POST['add']) ) 
  {
    $summerleveladd = $_SESSION['summersectionlevel'];
    $subjectadd = mysqli_real_escape_string($con, $_POST['selectsubject']);

    $sql_searchsection = "SELECT DISTINCT SectionName FROM summersection WHERE LevelID = $summerleveladd AND SubjectID = $subjectadd ORDER BY SummerSectionID DESC LIMIT 1";
    $result_sectioncheck = $con->query($sql_searchsection) or die(mysqli_error($con));

    if (mysqli_num_rows($result_sectioncheck) > 0)
    {
      while ($row = mysqli_fetch_array($result_sectioncheck))
      {
        $secnumber = $row['SectionName'];

        $newnum = $secnumber + 1;

        $sql_addsection = "INSERT INTO summersection ( SchoolYearID, LevelID, SubjectID, SectionName, DateCreated, Status ) 
        VALUES ( $syid, $summerleveladd, $subjectadd, $newnum, NOW(), 'Temporary')";
        $con->query($sql_addsection) or die(mysqli_error($con));


      }
    }
    else
    {
      $sql_addsection = "INSERT INTO summersection ( SchoolYearID, LevelID, SubjectID, SectionName, DateCreated, Status ) 
      VALUES ( $syid, $summerleveladd, $subjectadd, 1, NOW(), 'Temporary')";

      $con->query($sql_addsection) or die(mysqli_error($con));
    }
  }

  if ( isset($_POST['propose']) ) 
  {
    $sql_submit = "UPDATE summersection SET Status = 'Pending'";
    $con->query($sql_submit) or die(mysqli_error($con));
    header('location: summersectionsuccess.php');
  }

  if (isset($_POST['back']))
  {
    header('location: sectionhome.php');
  }
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
           <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Index</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Faculty list</li>
            <li><a href="facultylisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Faculty list</span></a></li>
            <li class="header">Student list</li>
            <li><a href="studentlisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student list</span></a></li>
            <li class="header">Sections</li>
            <li><a href="sectionhome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Sections</span></a></li>
            <li class="header">Summer class</li>
            <li><a href="summerclasshome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Summer Class</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="studentrecordsearch.php"><i class="fa fa-circle-o text-red"></i> <span>View Student Record</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside> 
                

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Section
        <small>Manage sections</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Section</a></li>
        <li class="active">Manage sections</li>
      </ol>
    </section>

    <form class="form-horizontal" method="POST">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Manage section</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <label>Current school year is <?php echo $sys . "-" . $sye ?></label><br>
                    <label>Total number of summer enrollees : <?php echo $total ?></label><br>
                    <?php echo $messagelevel ?>
                     <div class="form-group">
                      <p class="control-label col-sm-4">Select year level</p>
                      <div class="col-sm-4">
                        <select name="selectlevel"  class="form-control">
                            <option></option>
                            <?php echo $list_level ?>
                        </select>   
                      </div>  
                      <div class="col-sm-3">
                        <button name="select" type="submit" class="btn btn-primary">Select</button>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Summer enrollee information</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>SubjectName</th>
                  <th>Number of enrollees in that subject</th>
                </thead>
                <tbody>
                  <?php

                  if ( !empty($result_row) )
                  {
                    while ($row = mysqli_fetch_array($result_row))
                    {
                      $subjectidselect = $row['SubjectID'];
                      $subjectname = $row['SubjectName'];

                      $sql_enrolleepersubject = "SELECT s.SubjectID, s.SubjectName, l.LevelID, l.LevelName FROM summerstudent ss 
                          INNER JOIN enrollment e
                          ON ss.EnrollmentID = e.EnrollmentID
                          INNER JOIN enrollmenttype et
                          ON e.EnrollmentTypeID = et.EnrollmentTypeID 
                          INNER JOIN subject s 
                          ON ss.SubjectID = s.SubjectID
                          INNER JOIN level l 
                          ON ss.LevelID = l.LevelID WHERE ss.SubjectID = $subjectidselect";

                      $result_enrolleepersubject = $con->query($sql_enrolleepersubject) or die(mysqli_error($con));
                      $subjectenrollee = mysqli_num_rows($result_enrolleepersubject);


                    
                      echo "
                        <tr>
                          <td>$subjectname</td>
                          <td>$subjectenrollee</td>
                        </tr>
                      ";
                    }
                  } 
                  else
                  {
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add section </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                     <div class="form-group">
                      <p class="control-label col-sm-4">Subject</p>
                      <div class="col-sm-4">
                        <select name="selectsubject"  class="form-control">
                            <option></option>
                            <?php echo $list_subject ?>
                        </select>   
                      </div>  
                      <div class="col-sm-3">
                        <button name="add" type="submit" class="btn btn-primary">Add</button>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sections created</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-sm-3 text-center">
                <button name="propose" type="submit" class="btn btn-primary">Submit</button>
            </div>
             <table id="example4" class="table table-bordered table-striped">
                <thead>
                  <th>Section ID</th>
                  <th>Year Level</th>
                  <th>Subject</th>
                </thead>
                <tbody>
                  <?php

                  if ( !empty($result_row) )
                  {
                    while ($row = mysqli_fetch_array($result_getsections))
                    {
                      $summersectionid = $row['SummerSectionID'];
                      $subjectname = $row['SubjectName'];
                      $levelname = $row['LevelName'];
                    
                      echo "
                        <tr>
                          <td>$summersectionid</td>
                          <td>$subjectname</td>
                          <td>$levelname</td>
                        </tr>
                      ";
                    }
                  } 
                  else
                  {
                  }

                  ?>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    </section>
  </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>