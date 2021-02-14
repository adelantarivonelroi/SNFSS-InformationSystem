<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $disabled = "disabled"; //for section dropdown and button

  #SCHOOL YEAR
  $sql_sy = "SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_sy);
  $list_sy = "";
  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $systart = $row['SchoolYearStart'];
    $syend = $row['SchoolYearEnd'];
  }

  #LEVEL
  $sql_level = "SELECT LevelID, LevelName FROM level ORDER BY LevelID";
  $result_level = $con->query($sql_level);
  $list_level = "";
  while ($row = mysqli_fetch_array($result_level))
  {
    $lvlid = $row['LevelID'];
    $lvln = $row['LevelName'];
    $list_level .= "<option value='$lvlid'>$lvln</option>";
  }

  #Student
  $sql_studentlist = "SELECT s.StudentID, l.LevelName, s.FirstName, s.MiddleName, s.LastName, e.EnrollmentStatus, ga.Grade, s.AssignStatus 
  FROM students s
  INNER JOIN level l 
  ON s.LevelID = l.LevelID 
  INNER JOIN gradeaverage ga 
  ON s.StudentID = ga.StudentID 
  INNER JOIN enrollment e
  ON s.StudentID = e.StudentID 
  WHERE e.EnrollmentStatus = 'Enrolled' AND s.AssignStatus = 'Unassigned'";
  $result_studentlist = $con->query($sql_studentlist) or die(mysqli_error($con)); 

  #TEMP LIST
  $sql_templist = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName, l.LevelName, ga.Grade, s.AssignStatus 
    FROM studentlist sl
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID
    INNER JOIN gradeaverage ga 
    ON s.StudentID = ga.StudentID 

    WHERE sl.Status = 'Temporary'";
  $result_templistselect = $con->query($sql_templist) or die(mysqli_error($con));

  #SELECT YEAR LEVEL
  if (isset($_POST['selectyl'])) {
    $selectedyl = mysqli_real_escape_string($con, $_POST['listyearlevel']);
    $sql_section = "SELECT SectionID, LevelID, SectionName FROM section WHERE LevelID = $selectedyl";
    $result_section = $con->query($sql_section);

    $list_section = "";
      #LEVEL
    while ($row = mysqli_fetch_array($result_section))
    {
      $secid = $row['SectionID'];
      $seclevelid = $row['LevelID'];
      $secnumber = $row['SectionName'];
      $list_section .= "<option value='$secid'>$seclevelid - $secnumber</option>";
    }
    $disabled = "";

    $sql_studentlist = "SELECT s.StudentID, l.LevelName, s.FirstName, s.MiddleName, s.LastName, e.EnrollmentStatus, ga.Grade, s.AssignStatus 
    FROM students s
    INNER JOIN level l 
    ON s.LevelID = l.LevelID 
    INNER JOIN gradeaverage ga 
    ON s.GradeAverageID = ga.GradeAverageID 
    INNER JOIN enrollment e
    ON s.StudentID = e.StudentID 
    WHERE e.EnrollmentStatus = 'Enrolled' AND s.AssignStatus = 'Unassigned' AND l.LevelID = $selectedyl";
    $result_studentlist = $con->query($sql_studentlist) or die(mysqli_error($con));
     
  }

  #SELECT SECTION
  if (isset($_POST['selectsection'])) {
    $selectedsection = mysqli_real_escape_string($con, $_POST['listsection']);

    $sql_templistselect = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName, l.LevelName, ga.Grade
    FROM studentlist sl
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID
    INNER JOIN gradeaverage ga 
    ON s.GradeAverageID = ga.GradeAverageID 

    WHERE sl.Status = 'Temporary'  AND sl.SectionID = $selectedsection";
    $result_templistselect = $con->query($sql_templistselect) or die(mysqli_error($con));
  }

  #ADD TEACHER
  if (isset($_POST['add'])) {
    $schoolyear = mysqli_real_escape_string($con, $syid);
    $listyearlevel = mysqli_real_escape_string($con,  $_POST['listyearlevel']);
    $listsection = mysqli_real_escape_string($con,  $_POST['listsection']);
    $scheckboxes = isset($_POST['scheck_list']) ? $_POST['scheck_list'] : array();

    if(!empty($scheckboxes)) {
      foreach ($scheckboxes as $selected) {
        $sql_addtemp = "INSERT INTO  studentlist ( SchoolYearID, LevelID, SectionID, StudentID, Status ) VALUES ( $schoolyear, $listyearlevel, $listsection, $selected, 'Temporary')";  
        $sql_assignstudent = "UPDATE students SET AssignStatus = 'Assigned' WHERE StudentID = $selected";  

        $con->query($sql_addtemp) or die(mysqli_error($con));
        $con->query($sql_assignstudent) or die(mysqli_error($con));
        $message = "Successfully added student to temporary list";
        header('location: createsl.php');
      }
    }
  }

  #REMOVE TEADHER 
  if (isset($_POST['remove'])) {
    $tmpcheckboxes = isset($_POST['tcheck_list']) ? $_POST['tcheck_list'] : array();

     if(!empty($tmpcheckboxes)) {
      foreach ($tmpcheckboxes as $tmpselected) {

          $sql_getstudent = "SELECT StudentID FROM studentlist WHERE StudentListID = $tmpselected";
          $result_getstudent = $con->query($sql_getstudent) or die(mysqli_error($con)); 
          while ( $row = mysqli_fetch_array($result_getstudent))
          {
            $studentid = $row['StudentID'];
            $sql_assignstudent = "UPDATE students SET AssignStatus = 'Unassigned' WHERE StudentID = $studentid"; 
            $con->query($sql_assignstudent) or die(mysqli_error($con)); 

          }

          $sql_delete = "DELETE FROM studentlist WHERE StudentListID = $tmpselected";
          $con->query($sql_delete) or die(mysqli_error($con));
          $message = "Successfully removed from the list";
          header('location: createsl.php');


      }
      }
    }

  #SUBMIT
  if (isset($_POST['propose'])) {
    while ($row = mysqli_fetch_array($result_templistselect)) {

    $sql_propose = "UPDATE studentlist SET DateCreated = NOW(), Status = 'Pending' WHERE Status = 'Temporary'";
    //echo "<meta http-equiv='refresh' content='0'>";
      $con->query($sql_propose);
      $message = "Successfully submitted to be approved.";
     header('location: createsl.php');
    }
  }
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Section</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../section/index.php"><i class="fa fa-circle-o"></i>Manage section</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Assign class</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Manage lists</a></li>
              </ul>
            </li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>  
                

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create student list
        <small>assign class</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Assign class</a></li>
        <li class="active">create student list</li>
      </ol>
    </section>



    <!-- Main content -->
    <form method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
          <div class="col-md-12">


            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Functions</h3>
                </div>
                <!-- /.box-header -->
                  <div class=box-body>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <p class="control-label col-sm-2">School Year</p>
                          <div class="col-sm-8">
                            <label class="control-label col-sm-4"><?php echo $systart . ' - ' . $syend ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <p class="control-label col-sm-2">Year Level</p>
                          <div class="col-sm-3">
                            <select name="listyearlevel" class="form-control" required>
                              <option value="">Select one...</option>
                              <?php echo $list_level; ?>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button name="selectyl" type="submit" class="btn btn-success">
                                Select
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <p class="control-label col-sm-2">Section</p>
                          <div class="col-sm-3">
                            <select name="listsection" class="form-control" <?php echo $disabled ?>>
                              <option value="">Select one...</option>
                              <?php echo $list_section; ?>
                            </select>
                          </div>
                          <div class="col-sm-3">
                            <button name="selectsection" type="submit" class="btn btn-success" <?php echo $disabled ?>>
                                View
                            </button>
                          </div>
                          <div class="col-sm-3">
                            <button name="add" type="submit" class="btn btn-success" <?php echo $disabled ?>>
                                Add
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <div class="col-sm-8">
                            <button name="remove" type="submit" class="btn btn-danger">
                              Remove
                            </button>
                            <button name="propose" type="submit" class="btn btn-info">
                              Submit
                            </button>
                            <a href="index.php" class="btn btn-default">
                              Back to View
                            </a>
                          </div> 
                        </div>
                      </div>
                  </div>
            </div>

          <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Section detail</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
               <table id="example2" class="text-center table table-bordered table-striped">
                  <thead>
                    <th></th>
                    <th>Student name</th>
                    <th>Average Grade</th>

                  </thead>
                   <tbody>
                    <?php
                      while ($row = mysqli_fetch_array($result_templistselect))
                      {
                        $tmpsid = $row['StudentListID'];
                        $tmpfn = $row['FirstName'];
                        $tmpsmn = $row['MiddleName'];
                        $tmpsln = $row['LastName'];
                        $tmplvln = $row['LevelName'];
                        $tmpgrade = $row['Grade'];

                        echo "
                          <tr>
                            <td>
                            <input type='checkbox' name='tcheck_list[]' value='$tmpsid' />
                            </td>
                            <td>$tmpsln, $tmpfn $tmpsmn</td>
                            <td>$tmpgrade</td>
                          </tr>
                        ";
                      }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Students</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body with-border">
               <table id="example1" class="text-center table table-bordered table-striped">
                  <thead>
                    <th></th>
                    <th>Level</th>
                    <th>Student name</th>
                    <th>Average Grade</th>
                  </thead>
                  <tbody>
                    <?php
                      while ($row = mysqli_fetch_array($result_studentlist))
                      {
                        $sid = $row['StudentID'];
                        $fn = $row['FirstName'];
                        $smn = $row['MiddleName'];
                        $sln = $row['LastName'];
                        $lvln = $row['LevelName'];
                        $grade = $row['Grade'];
                        echo "
                          <tr>
                            <td>
                            <input type='checkbox' name='scheck_list[]' value='$sid' />
                            </td>
                            <td>$lvln</td>
                            <td>$sln, $fn $smn</td>
                            <td>$grade</td>
                          </tr>
                        ";
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
    include_once('../../../includes/footer.php');
?>