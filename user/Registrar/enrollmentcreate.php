<?php
    $page_title = "Register a User";
    include_once( '../../includes/header.php');
    validateAccess();
    validateRegistrar();
    
    # list of classification
    $sql_stutype = "SELECT StudentTypeID, StudentTypeName FROM studenttype";
     $result_stutype =$con->query($sql_stutype);

     $list_stutype = "";
     while($row = mysqli_fetch_array($result_stutype))
     {
        $stutypeid= $row['StudentTypeID'];
        $stutypename= $row['StudentTypeName'];
        $list_stutype .="<option value='$stutypeid'>$stutypename</option>";
     }

     # list of enrollment type
    $sql_enrolltype = "SELECT EnrollmentTypeID, EnrollmentTypeName FROM enrollmenttype";
     $result_enrolltype =$con->query($sql_enrolltype);

     $list_enrolltype = "";
     while($row = mysqli_fetch_array($result_enrolltype))
     {
        $entypeid= $row['EnrollmentTypeID'];
        $entypename= $row['EnrollmentTypeName'];
        $list_enrolltype .="<option value='$entypeid'>$entypename</option>";
     }

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

    # list of cities
    $sql_city = "SELECT cityid, cityname FROM city ORDER BY cityname ASC";
    $result_city =$con->query($sql_city);

     $list_city = "";
     while($row = mysqli_fetch_array($result_city))
     {
        $cityID= $row['cityid'];
        $cityName= $row['cityname'];
        $list_city .="<option value='$cityID'>$cityName</option>";
     }
$displayerror = "";
  #process new student
  if (isset($_POST['add']))
  {
  	$stuclassidinp = clean_input($_POST['studentclassid']);
  	
  	$street = encrypt(clean_input($_POST['Street']));
    $barangay = encrypt(clean_input($_POST['Barangay']));
  	$cityid = clean_input($_POST['cityid']);

  	#Insert address
    $sql_addaddress = "INSERT INTO address ( Street, Barangay, CityID ) VALUES ( '$street', '$barangay', $cityid )";
    $con->query($sql_addaddress) or die(mysqli_error($con));
    $addid = $con->insert_id; 

    $statusStudentid = mysqli_real_escape_string($con, $_POST['StatusStudentID']);
    $levelid = mysqli_real_escape_string($con, $_POST['level']);
    $fn = clean_input($_POST['FirstName']);
    $mn = clean_input($_POST['MiddleName']);
    $ln = clean_input($_POST['LastName']);
    $genderid = mysqli_real_escape_string($con, $_POST['GenderID']);
    $bday = mysqli_real_escape_string($con, $_POST['Birthday']);
    $newbday = date("Y-m-d", strtotime($bday));
    $email = clean_input($_POST['Email']);
    $contactNo = clean_input($_POST['ContactNo']);
    # -Removed address part and replaced with above-
    $mFN = clean_input($_POST['MotherFirstName']);
    $mLN = clean_input($_POST['MotherLastName']);
    $mOccu = clean_input($_POST['MotherOccupation']);
    $fFN = clean_input($_POST['FatherFirstName']);
    $fLN = clean_input($_POST['FatherLastName']);
    $fOccu = clean_input($_POST['FatherOccupation']);

    $error = "";
    if(!preg_match('/^[a-zA-z]+$/i', $fn)) {
        $error .= '<b>* First Name incorrect form.</b><br>';
        
    }
    if(!preg_match('/^[a-zA-z]+$/i', $mn)) {
        $error .= '<b>* Middle Name incorrect form. </b><br>';
        
    }
    if(!preg_match('/^[a-zA-z]+$/i', $ln)) {
        $error .= '<b>* Last Name incorrect form. </b><br>';
        
    }
    if ( isset($_FILES["picture"]))
    {
        $upload = "images/student/"; # location where to upload the image
        $picture = $_FILES["picture"]["name"]; # gets the file from file upload
        $newPicture = date('YmdHis-') . basename($picture); # eg. 20170322051234-sample.jpg
        $file = $upload . $newPicture;

        move_uploaded_file($_FILES["picture"]["tmp_name"], $file);
    }

    if ($error)
    {
      $displayerror = $error;
    }
    else
    {


      #add student
      $sql_addrecord = "INSERT INTO students (`StudentID`, `StatusStudentID`, `StudentTypeID`, `LevelID`, `FirstName`, `MiddleName`, `LastName`, `Picture`, `GenderID`, `Birthday`, `Email`, `ContactNo`, `AddressID`, `MotherFirstName`, `MotherLastName`, `MotherOccupation`, `FatherFirstName`, `FatherLastName`, `FatherOccupation`, `DateAdded`, `DateModified`, AssignStatus ) VALUES ('', $statusStudentid, $stuclassidinp, $levelid, '$fn', '$mn', '$ln', '$newPicture', $genderid, '$newbday', '$email', '$contactNo', '$addid', '$mFN', '$mLN', '$mOccu', '$fFN', '$fLN', '$fOccu', NOW(), NULL, 'Unassigned')";
      $con->query($sql_addrecord) or die(mysqli_error($con));
      $sid = $con->insert_id;

      $string = "Added a student record with the id " . $sid;
      #audit add student
      $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
      $con->query($sql_audit) or die (mysqli_error($con));

      #enroll student
      $estat = mysqli_real_escape_string($con, $_POST['EnrollmentStatus']);
      $entypeidinp = clean_input($_POST['enrollmenttypeid']);
      $dateenrolled = mysqli_real_escape_string($con, $_POST['enrolldate']);
      $sql_addenrollment = "INSERT INTO enrollment ( StudentID, EnrollmentStatus, EnrollmentTypeID, DateEnroll ) VALUES ( $sid, '$estat', $entypeidinp, '$dateenrolled')";

      $con->query($sql_addenrollment) or die(mysqli_error($con));

      #add clearance record
      $sql_addclearance = "INSERT INTO clearance ( StudentID, ClearanceStatus ) VALUES ( $sid, 'Cleared')";
      $con->query($sql_addclearance) or die(mysqli_error($con));

      $hashedparentpass = hash('sha256', mysqli_real_escape_string($con, 'changeme'));

      #create parent account
      $sql_addparentacc = "INSERT INTO user ( TypeID, UserName, Password, DateAdded, Status ) VALUES (3, $sid, '$hashedparentpass', NOW(), 'Active')";
      $con->query($sql_addparentacc) or die(mysqli_error($con));
      $pid = $con->insert_id;

      #connect student to parent
      $sql_connectparent = "INSERT INTO parent ( UserID, StudentID ) VALUES ( $pid, $sid)";
      $con->query($sql_connectparent) or die(mysqli_error($con));
      $rid = $con->insert_id;
      $_SESSION['parentstudent'] = $rid;

      #send to success page location  
      header('location:enrollmentcreatesuccess.php');
    }
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
<!-- /.sidebar -->
</aside>

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student record
        <small>manage student record</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">manage student record</a></li>
        <li class="active">Create student record</li>
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
              <h3 class="box-title">Create student record</h3> <p><?php echo $displayerror ?></p>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Type of student(*)</label>
                  <div class="col-sm-2">
                    <select name="StatusStudentID"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_status; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Student classification(*)</label>
                  <div class="col-sm-2">
                    <select name="studentclassid"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_stutype; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Enrollment status(*)</label>
                  <div class="col-sm-2">
                    <select name="EnrollmentStatus"  class="form-control" required>
                      <option value='Enrolled'>Enrolled</option>
                      <option value='Not Enrolled'>Not Enrolled</option>
                    </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Enrollment type(*)</label>
                  <div class="col-sm-2">
                    <select name="enrollmenttypeid"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_enrolltype; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Date enrolled(*)</label>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="enrolldate"  class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Year level(*)</label>
                  <div class="col-sm-2">
                    <select name="level"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_level; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label for="firstName" class="col-sm-2 control-label">First name(*)</label>

                  <div class="col-sm-4">
                    <input type="text" name="FirstName"  class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="middleName" class="col-sm-2 control-label">Middle name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MiddleName"  class="form-control">
                  </div>
                </div>

                <div class="form-group">
                  <label for="lastName" class="col-sm-2 control-label">Last name(*)</label>

                  <div class="col-sm-4">
                    <input type="text" name="LastName"  class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Gender(*)</label>
                  <div class="col-sm-2">
                    <select name="GenderID"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_gender; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Birthday(*)</label>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="Birthday"  class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-4">
                    <input type="email" name="Email"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="contactNp" class="col-sm-2 control-label">Contact number</label>

                  <div class="col-sm-4">
                    <input type="number" name="ContactNo"  class="form-control" >
                  </div>
                </div>

                <!-- NEW ADDRESS PART -->
                <div class="form-group">
                  <label for="st" class="col-sm-2 control-label">Street(*)</label>

                  <div class="col-sm-8">
                    <input type="text" name="Street"  class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label for="brgy" class="col-sm-2 control-label">Barangay(*)</label>

                  <div class="col-sm-8">
                    <input type="text" name="Barangay"  class="form-control" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">City(*)</label>
                  <div class="col-sm-4">
                    <select name="cityid"  class="form-control" required>
                      <option>
                        </option>
                        <?php echo $list_city; ?>
                        </select>     
                  </div>
                </div>

                <div class="form-group">
                  <label for="momFirstName" class="col-sm-2 control-label">Mother's first name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherFirstName"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="momLastName" class="col-sm-2 control-label">Mother's last name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherLastName"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="momOccupation" class="col-sm-2 control-label">Mother's occupation</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherOccupation"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadaFirstName" class="col-sm-2 control-label">Father's first name</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherFirstName"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadLastName" class="col-sm-2 control-label">Father's last name</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherLastName"  class="form-control" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadOccupation" class="col-sm-2 control-label">Father's occupation</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherOccupation"  class="form-control" >
                  </div>
                </div>


                <div class="form-group">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Picture </label>
                  <div class="col-sm-4">
                    <input type="file" name="picture" accept="image/gif, image/jpg, image/jpeg, image/png">
                  </div>
                </div>


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