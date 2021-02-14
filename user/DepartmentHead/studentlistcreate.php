<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $disabled = "disabled"; //for section dropdown and button
  $displaymessage = "";
  $message = "";

  #get school year
  $sql_sy = "SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_sy) or die(mysqli_error($con));
  $list_sy = "";
  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $systart = $row['SchoolYearStart'];
    $syend = $row['SchoolYearEnd'];
  }

  #get section
  $sql_section = "SELECT SectionID, LevelID, SectionName FROM section WHERE SectionStatus = 'Approved' ORDER BY LevelID";
  $result_section = $con->query($sql_section);

  $list_section = "";
  while ($row = mysqli_fetch_array($result_section))
  {
    $secid = $row['SectionID'];
    $seclevelid = $row['LevelID'];
    $secnumber = $row['SectionName'];
    $list_section .= "<option value='$secid'>$seclevelid - $secnumber</option>";
  }


  if (isset($_SESSION['slsectionid']) && !empty($_SESSION['slsectionid']) && isset($_SESSION['levelid']) && !empty($_SESSION['levelid']) && isset($_SESSION['slsectionno']) && !empty($_SESSION['slsectionno']))
  {
    $csid = $_SESSION['slsectionid'];
    $lvlses = $_SESSION['sllevelid'];
    $snses = $_SESSION['slsectionno'];

    $sql_viewselected = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName, l.LevelName, sec.SectionName, s.AssignStatus 
    FROM studentlist sl
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID

    WHERE sl.Status = 'Temporary' AND sl.LevelID = $lvlses";
    $result_templistselect = $con->query($sql_viewselected) or die(mysqli_error($con));

    #Student
    $sql_studentlist = "SELECT s.StudentID, l.LevelName, l.LevelID, s.FirstName, s.MiddleName, s.LastName, e.EnrollmentStatus, s.AssignStatus 
    FROM students s
    INNER JOIN level l 
    ON s.LevelID = l.LevelID 
    INNER JOIN enrollment e
    ON s.StudentID = e.StudentID 
    WHERE e.EnrollmentStatus = 'Enrolled' AND s.AssignStatus = 'Unassigned' AND l.LevelID = $lvlses";
    $result_studentlist = $con->query($sql_studentlist) or die(mysqli_error($con)); 

    $displaymessage = "Currently assigning faculty to section " . $lvlses . "-" . $snses;
  }
  else
  {
    #TEMP LIST
    $sql_templist = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName, l.LevelName, sec.SectionName, s.AssignStatus 
    FROM studentlist sl
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID

    WHERE sl.Status = 'Temporary'";
  $result_templistselect = $con->query($sql_templist) or die(mysqli_error($con));

    #Student
    $sql_studentlist = "SELECT s.StudentID, l.LevelName, s.FirstName, s.MiddleName, s.LastName, e.EnrollmentStatus, s.AssignStatus 
    FROM students s
    INNER JOIN level l 
    ON s.LevelID = l.LevelID 
    INNER JOIN enrollment e
    ON s.StudentID = e.StudentID 
    WHERE e.EnrollmentStatus = 'Enrolled' AND s.AssignStatus = 'Unassigned'";
    $result_studentlist = $con->query($sql_studentlist) or die(mysqli_error($con)); 

    $displaymessage = "Currently viewing all students.";
  }

  if ( isset($_POST['viewsectionsl']))
  {

    $selectsec = mysqli_real_escape_string($con, $_POST['listsection']);

    $_SESSION['slsectionid'] = $selectsec;

    $sql_getsection = "SELECT LevelID, SectionName FROM section WHERE SectionID = $selectsec";
    $result_getsection = $con->query($sql_getsection) or die(mysqli_error($con));

    while ( $row = mysqli_fetch_array($result_getsection))
    {
      $lvl = $row['LevelID'];
      $sno = $row['SectionName'];

      $_SESSION['sllevelid'] = $lvl;
      $_SESSION['slsectionno'] = $sno;
    }

    $sql_view = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName, l.LevelName, sec.SectionName
    FROM studentlist sl
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID

    WHERE sl.Status = 'Temporary'  AND sl.SectionID = $selectsec";


    $result_templistselect = $con->query($sql_view) or die(mysqli_error($con));

    #Student
    $sql_studentlist = "SELECT s.StudentID, l.LevelName, s.FirstName, s.MiddleName, s.LastName, e.EnrollmentStatus, s.AssignStatus 
    FROM students s
    INNER JOIN level l 
    ON s.LevelID = l.LevelID 
    INNER JOIN enrollment e
    ON s.StudentID = e.StudentID 
    WHERE e.EnrollmentStatus = 'Enrolled' AND s.AssignStatus = 'Unassigned' AND s.LevelID = $lvl";
    $result_studentlist = $con->query($sql_studentlist) or die(mysqli_error($con)); 

    //header('location: studentlistcreate.php');
    $displaymessage = "Currently assigning faculty to section " . $lvl . "-" . $sno;

  }

  if (isset($_POST['assign'])) {
    $schoolyear = mysqli_real_escape_string($con, $syid);
    $sec = $_SESSION['slsectionid'];
    $lev = $_SESSION['sllevelid'];
    $secno = $_SESSION['slsectionid'];
    $scheckboxes = isset($_POST['scheck_box']) ? $_POST['scheck_box'] : array();

    if(!empty($scheckboxes)) {
      foreach ($scheckboxes as $stuselected) {
        $sql_addtemp = "INSERT INTO  studentlist ( SchoolYearID, LevelID, SectionID, StudentID, Status ) VALUES ( $schoolyear, $lev, $secno, $stuselected, 'Temporary')";  
        $sql_assignstudent = "UPDATE students SET AssignStatus = 'Assigned' WHERE StudentID = $stuselected";  

        $con->query($sql_addtemp) or die(mysqli_error($con));
        $con->query($sql_assignstudent) or die(mysqli_error($con));
        $message = "Successfully added student to temporary list";
        header('location: studentlistcreate.php');
      }
    }
    else
      {
        $message = "Please select a student to assign first.";
      }
  }
  #REMOVE TEADHER 
  if (isset($_POST['remove'])) {
    $tmpcheckboxes = isset($_POST['tcheck_box']) ? $_POST['tcheck_box'] : array();

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
          header('location: studentlistcreate.php');
        }
      }
      else
      {
        $message = "Please select a student to assign first.";
      }
  }

  #SUBMIT
  if (isset($_POST['propose'])) {
    while ($row = mysqli_fetch_array($result_templistselect)) {

    $sql_propose = "UPDATE studentlist SET DateCreated = NOW(), Status = 'Pending' WHERE Status = 'Temporary'";
    //echo "<meta http-equiv='refresh' content='0'>";
      $con->query($sql_propose);
      $message = "Successfully submitted to be approved.";
     header('location: studentlistcreate.php');
    }
  }

  if (isset($_POST['back'])) {

     header('location: studentlisthome.php');

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
            <li class="header">Student Record</li>
            <li><a href="studentrecordsearch.php"><i class="fa fa-circle-o text-red"></i> <span>View Student Record</span></a></li>
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
        <li class="active">Create student list</li>
      </ol>
    </section>



    <!-- Main content -->
    <form method="POST" class="form-horizontal">
    <section class="content">
      <div class="row">
        <!-- left column -->
          <div class="col-md-12">


            <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Functions</h3>
                </div>

                <div class="box-body with-border border-bottom">

                  <div class="form-group">
                    <p class="col-sm-2 control-label">School year</p>
                    <div class="col-sm-2">
                      <label class="form-control"><?php echo $systart . " - " . $syend ?></label>
                    </div>
                    <div class="col-sm-2">
                      <button name='back' type='submit' class='btn btn-default'>
                        Back
                      </button>
                    </div>
                  </div>

                  <div class="form-group">
                    <p class="col-sm-2 control-label">Select section</p>
                    <div class="col-sm-2">
                      <select name="listsection" class="form-control">
                        <?php echo $list_section; ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button name='viewsectionsl' type='submit' class='btn btn-primary'>
                        Select
                      </button>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                    <p class="col-sm-2 control-label"></p>
                    <div class="col-sm-3">
                      <button name='assign' type='submit' class='btn btn-primary'>
                        Assign
                      </button>
                      <button name='remove' type='submit' class='btn btn-danger'>
                        Remove
                      </button>
                      <button name='propose' type='submit' class='btn btn-success'>
                        Submit
                      </button>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <?php echo $displaymessage ?>
                    </label>
                    <label class="col-sm-3 control-label">
                      <?php echo $message ?>
                    </label>
                  </div>
                </div>
            </div>
           
            <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Section details</h3>
              </div>
              <!-- /.box-header -->
                <div class="box-body with-border">
                   <table id="example3" class="text-center table table-bordered table-striped">
                      <thead>
                        <th></th>
                        <th>Section</th>
                        <th>Student name</th>
                      <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($result_templistselect))
                            {
                              $tmpsid = $row['StudentListID'];
                              $tmpfn = $row['FirstName'];
                              $tmpsmn = $row['MiddleName'];
                              $tmpsln = $row['LastName'];
                              $tmplvln = $row['LevelName'];
                              $tmpsection = $row['SectionName'];

                              echo "
                                <tr>
                                  <td><input type='checkbox' name='tcheck_box[]' value='$tmpsid' /></td>
                                  <td>$tmplvln - $tmpsection</td>
                                  <td>$tmpsln, $tmpfn $tmpsmn</td>
                                </tr>
                              ";
                            }
                        ?>
                      </tbody>
                    </table>
              </div>
            </div>
              
          <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Students unassigned</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body with-border">
                 <table id="example3" class="text-center table table-bordered table-striped">
                    <thead>
                      <th></th>
                      <th>Level</th>
                      <th>Student name</th>

                    </thead>
                     <tbody>
                      <?php
                          while ($row = mysqli_fetch_array($result_studentlist))
                          {
                            $sid = $row['StudentID'];
                            $sfn = $row['FirstName'];
                            $smn = $row['MiddleName'];
                            $sln = $row['LastName'];
                            $lvln = $row['LevelName'];

                            echo "
                              <tr>
                                <td><input type='checkbox' name='scheck_box[]'' value='$sid' /></td>
                                <td>$lvln</td>
                                <td>$sln, $sfn $smn</td>
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
    include_once('../../includes/footer.php');
?>