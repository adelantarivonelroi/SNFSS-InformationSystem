<?php
    $page_title = "Register a User";
    include_once( '../../includes/header.php');
    validateAccess();
    validateRegistrar();
    
    if(isset($_SESSION['sid']) && !empty($_SESSION['sid']))
    {
        $id = $_SESSION['sid'];
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

        $sql_selectstudentrecord = "SELECT ss.StatusName, e.EnrollmentStatus, e.DateEnroll, l.LevelName, g.GenderName, s.FirstName AS StuFirstName, s.MiddleName AS StuMiddleName, s.LastName AS StuLastName, s.Picture, s.Birthday, s.Email, s.ContactNo, s.Address, s.MotherFirstName, s.MotherLastName, s.MotherOccupation, s.FatherFirstName, s.FatherLastName, s.FatherOccupation, s.DateAdded, s.DateModified FROM students s 
          INNER JOIN statusstudent ss 
          ON s.StatusStudentID = ss.StatusStudentID
          INNER JOIN enrollment e
          ON s.StudentID = e.StudentID
          INNER JOIN level l 
          ON s.LevelID = l.LevelID
          INNER JOIN gender g
          ON s.GenderID = g.GenderID
          WHERE s.StudentID = $id";

          $result_selectrecord = $con->query($sql_selectstudentrecord) or die(mysqli_error($con));

          while ( $row = mysqli_fetch_array($result_selectrecord))
          {
            $statusname = $row['StatusName'];
            $enrollstatus = $row['EnrollmentStatus'];
            $enrolldate = $row['DateEnroll'];
            $lvlname = $row['LevelName'];
            $gname = $row['GenderName'];
            $sfn = $row['StuFirstName'];
            $smn = $row['StuMiddleName'];
            $sln = $row['StuLastName'];
            $img = $row['Picture'];
            $bday = $row['Birthday'];
            $email = $row['Email'];
            $contactno = $row['ContactNo'];
            $address = $row['Address'];
            $mfn = $row['MotherFirstName'];
            $mln = $row['MotherLastName'];
            $mo = $row['MotherOccupation'];
            $ffn = $row['FatherFirstName'];
            $fln = $row['FatherLastName'];
            $fo = $row['FatherOccupation'];
            $da = $row['DateAdded'];
            $dm = $row['DateModified'];
          }

        # add a student
        if (isset($_POST['update']))
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

          $sql_addenrollment = "INSERT INTO clearance ( StudentID, ClearanceStatus ) VALUES ( $sid, 'Uncleared')";

          $con->query($sql_addenrollment) or die(mysqli_error($con));

          $displaymessage = "Successfully created a new record.";
          # edit location  
          header('location:updatestudentrecord.php.php');
        }

    } else 
    {
      header('location: searchstudentrecordresult.php');
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
        Student Record(s)
        <small>Manage Student Records</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View student record</h3></h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Type of student</label>
                  <div class="col-sm-2">
                    <input type="text" name="sn"  class="form-control" value='<?php echo $statusname; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Enrollment status</label>
                  <div class="col-sm-2">
                    <input type="text" name="es"  class="form-control" value='<?php echo $enrollstatus; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Date enrolled</label>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="enrolldate"  class="form-control" value='<?php echo $enrolldate; ?>' readonly>
                    </div>
                  </div>
                </div>

                

                <div class="form-group">
                  <label for="firstName" class="col-sm-2 control-label">First name</label>

                  <div class="col-sm-4">
                    <input type="text" name="FirstName"  class="form-control" value='<?php echo $sfn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="middleName" class="col-sm-2 control-label">Middle name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MiddleName"  class="form-control" value='<?php echo $smn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="lastName" class="col-sm-2 control-label">Last name</label>

                  <div class="col-sm-4">
                    <input type="text" name="LastName"  class="form-control" value='<?php echo $sln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Gender</label>
                  <div class="col-sm-2">
                    <input type="text" name="LastName"  class="form-control" value='<?php echo $gname; ?>' readonly>  
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Birthday</label>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="date" name="Birthday"  class="form-control" value='<?php echo $bday; ?>' readonly>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">Email</label>

                  <div class="col-sm-4">
                    <input type="email" name="Email"  class="form-control" value='<?php echo $email; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="contactNp" class="col-sm-2 control-label">Contact number</label>

                  <div class="col-sm-4">
                    <input type="number" name="ContactNo"  class="form-control" value='<?php echo $contactno; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="address" class="col-sm-2 control-label">Address</label>

                  <div class="col-sm-4">
                    <input type="text" name="Address"  class="form-control" value='<?php echo $address; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="momFirstName" class="col-sm-2 control-label">Mother's first name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherFirstName"  class="form-control" value='<?php echo $mfn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="momLastName" class="col-sm-2 control-label">Mother's last name</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherLastName"  class="form-control" value='<?php echo $mln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="momOccupation" class="col-sm-2 control-label">Mother's occupation</label>

                  <div class="col-sm-4">
                    <input type="text" name="MotherOccupation"  class="form-control" value='<?php echo $mo; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadaFirstName" class="col-sm-2 control-label">Father's first name</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherFirstName"  class="form-control" value='<?php echo $ffn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadLastName" class="col-sm-2 control-label">Father's last name</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherLastName"  class="form-control" value='<?php echo $fln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="dadOccupation" class="col-sm-2 control-label">Father's occupation</label>

                  <div class="col-sm-4">
                    <input type="text" name="FatherOccupation"  class="form-control" value='<?php echo $fo; ?>' readonly>
                  </div>
                </div>

                <!--
                <div class="form-group">
                  <label for="exampleInputFile" class="col-sm-2 control-label">Picture </label>
                  <div class="col-sm-4">
                    <input type="file" name="Picture"  id="exampleInputFile" >
                  </div>
                </div>
                -->


                <!-- /.input group -->
              </div>
              <!-- /.box-body -->
              <div class="form-group">
                <div class="col-lg-offset-4 col-lg-8">
                  <button name="update" type="submit" class="btn btn-success">
                    Update
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