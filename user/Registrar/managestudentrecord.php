<?php
    $page_title = "Register a User";
    include_once( '../../includes/header.php');
    
# list of gender
    $sql_gender = "SELECT genderName, genderID FROM gender";
     $result_gender =$con->query($sql_gender);

     $list_gender = "";
     while($row = mysqli_fetch_array($result_gender))
     {
        $genderID= $row['genderID'];
        $genderName= $row['genderName'];
        $list_gender .="<option value='$genderID'>$genderName</option>";
     }

     # list of status
    $sql_status = "SELECT StatusName, StatusStudentID FROM statusstudent";
    $result_status =$con->query($sql_status);

     $list_status = "";
     while($row = mysqli_fetch_array($result_status))
     {
        $statusStudentID= $row['StatusStudentID'];
        $statusName= $row['StatusName'];
        $list_status .="<option value='$statusStudentID'>$statusName</option>";
     }

     # list of level
    $sql_level = "SELECT LevelName, LevelID FROM level ORDER BY LevelID";
     $result_level =$con->query($sql_level);

     $list_level = "";
     while($row = mysqli_fetch_array($result_level))
     {
        $LevelID= $row['LevelID'];
        $LevelName= $row['LevelName'];
        $list_level .="<option value='$LevelID'>$LevelName</option>";
     }
     
     $displaymessage = "";

    # add a student
  if (isset($_POST['add']))
  {
    
    $statusStudentid = mysqli_real_escape_string($con, $_POST['StatusStudentID']);
    $levelid = mysqli_real_escape_string($con, $_POST['LevelID']);
    $fn = mysqli_real_escape_string($con, $_POST['FirstName']);
    $mn = mysqli_real_escape_string($con, $_POST['MiddleName']);
    $ln = mysqli_real_escape_string($con, $_POST['LastName']);
    $pic = mysqli_real_escape_string($con, $_POST['Picture']);
    $genderid = mysqli_real_escape_string($con, $_POST['GenderID']);
    $bday = mysqli_real_escape_string($con, $_POST['Birthday']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $contactNo = mysqli_real_escape_string($con, $_POST['ContactNo']);
    $address = mysqli_real_escape_string($con, $_POST['Address']);
    $mFN = mysqli_real_escape_string($con, $_POST['MotherFirstName']);
    $mLN = mysqli_real_escape_string($con, $_POST['MotherLastName']);
    $mOccu = mysqli_real_escape_string($con, $_POST['MotherOccupation']);
    $fFN = mysqli_real_escape_string($con, $_POST['FatherFirstName']);
    $fLN = mysqli_real_escape_string($con, $_POST['FatherLastName']);
    $fOccu = mysqli_real_escape_string($con, $_POST['FatherOccupation']);

    $sql_addrecord = "INSERT INTO students (`StudentID`, `StatusStudentID`, `LevelID`, `FirstName`, `MiddleName`, `LastName`, `Picture`, `GenderID`, `Birthday`, `Email`, `ContactNo`, `Address`, `MotherFirstName`, `MotherLastName`, `MotherOccupation`, `FatherFirstName`, `FatherLastName`, `FatherOccupation`, `DateAdded`, `DateModified`, `AssignStatus` ) VALUES ('', $statusStudentid, $levelid, '$fn', '$mn', '$ln', '$pic', $genderid, '$bday', '$email', '$contactNo', '$address', '$mFN', '$mLN', '$mOccu', '$fFN', '$fLN', '$fOccu', NOW(), NULL, 'Unassigned')";

    $con->query($sql_addrecord) or die(mysqli_error($con));

    $sid = $con->insert_id;
    $estat = mysqli_real_escape_string($con, $_POST['EnrollmentStatus']);
    $dateenrolled = mysqli_real_escape_string($con, $_POST['enrolldate']);

    $sql_addenrollment = "INSERT INTO enrollment ( StudentID, EnrollmentStatus, DateEnroll ) VALUES ( $sid, '$estat', '$dateenrolled')";

    $con->query($sql_addenrollment) or die(mysqli_error($con));

    $displaymessage = "Successfully created a new record.";
    # edit location  
    header('location:createstudentrecord.php');
  }

    
?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header">Index</li>
      <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
      <li class="header">Enrollment Process</li>
      <li><a href="enrollmentsearch.php"><i class="fa fa-circle-o text-red"></i> <span>Check enrollee</span></a></li>
      <li><a href="enrollmentviewall.php"><i class="fa fa-circle-o text-red"></i> <span>View all enrollee</span></a></li>
      <li class="header">Student Record(s)</li>
      <li><a href="studentrecordmain.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student Record</span></a></li>
      <li class="header">Grade Encoding</li>
      <li><a href="encodefeature.php"><i class="fa fa-circle-o text-red"></i> <span>Update Encode Feature</span></a></li>
      <li class="header">Clearance</li>
      <li><a href="updateclearancesearch.php"><i class="fa fa-circle-o text-red"></i> <span>Update Clearance Status</span></a></li>
      <li class="header">Academic Year</li>
      <li><a href="addacademicyear.php"><i class="fa fa-circle-o text-red"></i> <span>Add academic year</span></a></li>
      <li class="header">Periodic Rating</li>
      <li><a href="updateperiodicrating.php"><i class="fa fa-circle-o text-red"></i> <span>Update Periodic Rating</span></a></li>
      <li class="header">Import Records</li>
      <li><a href="importstudent.php"><i class="fa fa-circle-o text-red"></i> <span>Import Student Record</span></a></li>
      <li><a href="importaddress.php"><i class="fa fa-circle-o text-red"></i> <span>Import Address Record</span></a></li>
      <li><a href="importenrollment.php"><i class="fa fa-circle-o text-red"></i> <span>Import Enrollment Record</span></a></li>

    </ul>
  </section>
</section>
<!-- /.sidebar -->
</aside>


  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enrollment
        <small>process enrollment</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create student record</h3> <h2><?php echo $displaymessage ?></h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal">
              <div class="box-body">
                <table>
                  <tbody>
                    <tr>
                        <td rowspan="2">Subject</td>
                        <td colspan="3">Call Standard</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                    </tr>
                  </tbody>
                </table>

                <!-- /.input group -->
              </div>
              <!-- /.box-body -->
              <div class="form-group">
                <div class="col-lg-offset-4 col-lg-8">
                  <button name="add" type="submit" class="btn btn-success">
                    Add
                  </button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </section>

<?php
    include_once('../../includes/footer.php');
?>