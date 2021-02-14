<?php
    $page_title = "Register a User";
    include_once( '../../includes/header.php');
    validateAccess();
    validateDepartmentHead();
    
    # checks if record is selected
    if (isset($_REQUEST['id']))
    {
        # checks if selected record is an ID value
        if (ctype_digit($_REQUEST['id']))
        {
          $id = $_REQUEST['id'];
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

          $sql_selectstudentrecord = "SELECT ss.StatusName, et.EnrollmentTypeName, st.StudentTypeName, e.EnrollmentStatus, e.DateEnroll, l.LevelName, g.GenderName, s.FirstName AS StuFirstName, s.MiddleName AS StuMiddleName, s.LastName AS StuLastName, s.Picture, s.Birthday, s.Email, s.ContactNo, a.Street, a.Barangay, cc.CityName, s.MotherFirstName, s.MotherLastName, s.MotherOccupation, s.FatherFirstName, s.FatherLastName, s.FatherOccupation, s.DateAdded, s.DateModified FROM students s 
            INNER JOIN statusstudent ss 
            ON s.StatusStudentID = ss.StatusStudentID
            INNER JOIN enrollment e
            ON s.StudentID = e.StudentID
            INNER JOIN enrollmenttype et
            ON e.EnrollmentTypeID = et.EnrollmentTypeID
            INNER JOIN studenttype st 
            ON s.StudentTypeID = st.StudentTypeID
            INNER JOIN level l 
            ON s.LevelID = l.LevelID
            INNER JOIN gender g
            ON s.GenderID = g.GenderID
            INNER JOIN  address a 
            ON s.AddressID = a.AddressID
            INNER JOIN  city cc 
            ON a.CityID = cc.CityID
            WHERE s.StudentID = $id";


          $result_selectrecord = $con->query($sql_selectstudentrecord) or die(mysqli_error($con));

          while ( $row = mysqli_fetch_array($result_selectrecord))
          {
            $statusname = $row['StatusName'];
            $enrollstatus = $row['EnrollmentStatus'];

            $enrollmenttype = $row['EnrollmentTypeName'];
            $studenttype = $row['StudentTypeName'];

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
            
            $street = decrypt($row['Street']);
            $brgy = decrypt($row['Barangay']);
            $city = $row['CityName'];

            $mfn = $row['MotherFirstName'];
            $mln = $row['MotherLastName'];
            $mo = $row['MotherOccupation'];
            $ffn = $row['FatherFirstName'];
            $fln = $row['FatherLastName'];
            $fo = $row['FatherOccupation'];
            $da = $row['DateAdded'];
            $dm = $row['DateModified'];
          }

          if ( isset($_POST['return']))
          {
            header('location: studentrecordsearchresult.php');
          }
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
        Student record
        <small>manage student record</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manage student record</a></li>
        <li class="active">View student record</li>
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
              <h3 class="box-title">View student record</h3></h2>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <p class="col-sm-2 control-label">Type of student</p>
                  <div class="col-sm-2">
                    <input type="text" name="sn"  class="form-control" value='<?php echo $statusname; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Student classification</p>
                  <div class="col-sm-2">
                    <input type="text" name="sc"  class="form-control" value='<?php echo $studenttype; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Enrollment status</p>
                  <div class="col-sm-2">
                    <input type="text" name="es"  class="form-control" value='<?php echo $enrollstatus; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Enrollment type</p>
                  <div class="col-sm-2">
                    <input type="text" name="et"  class="form-control" value='<?php echo $enrollmenttype; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Date enrolled</p>

                  <div class="col-sm-2">
                    <div class="input-group">
                      <input type="date" name="enrolldate"  class="form-control" value='<?php echo $enrolldate; ?>' readonly>
                    </div>
                  </div>
                </div>

                

                <div class="form-group">
                  <p for="firstName" class="col-sm-2 control-label">First name</p>

                  <div class="col-sm-4">
                    <input type="text" name="FirstName"  class="form-control" value='<?php echo $sfn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="middleName" class="col-sm-2 control-label">Middle name</p>

                  <div class="col-sm-4">
                    <input type="text" name="MiddleName"  class="form-control" value='<?php echo $smn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="lastName" class="col-sm-2 control-label">Last name</p>

                  <div class="col-sm-4">
                    <input type="text" name="LastName"  class="form-control" value='<?php echo $sln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Gender</p>
                  <div class="col-sm-2">
                    <input type="text" name="LastName"  class="form-control" value='<?php echo $gname; ?>' readonly>  
                  </div>
                </div>

                <div class="form-group">
                  <p class="col-sm-2 control-label">Birthday</p>

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
                  <p for="email" class="col-sm-2 control-label">Email</p>

                  <div class="col-sm-4">
                    <input type="email" name="Email"  class="form-control" value='<?php echo $email; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="contactNp" class="col-sm-2 control-label">Contact number</p>

                  <div class="col-sm-4">
                    <input type="number" name="ContactNo"  class="form-control" value='<?php echo $contactno; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="address" class="col-sm-2 control-label">Address</p>

                  <div class="col-sm-4">
                    <input type="text" name="Address"  class="form-control" value='<?php echo $street . ", " . $brgy . ", " . $city ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="momFirstName" class="col-sm-2 control-label">Mother's first name</p>

                  <div class="col-sm-4">
                    <input type="text" name="MotherFirstName"  class="form-control" value='<?php echo $mfn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="momLastName" class="col-sm-2 control-label">Mother's last name</p>

                  <div class="col-sm-4">
                    <input type="text" name="MotherLastName"  class="form-control" value='<?php echo $mln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="momOccupation" class="col-sm-2 control-label">Mother's occupation</p>

                  <div class="col-sm-4">
                    <input type="text" name="MotherOccupation"  class="form-control" value='<?php echo $mo; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="dadaFirstName" class="col-sm-2 control-label">Father's first name</p>

                  <div class="col-sm-4">
                    <input type="text" name="FatherFirstName"  class="form-control" value='<?php echo $ffn; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="dadLastName" class="col-sm-2 control-label">Father's last name</p>

                  <div class="col-sm-4">
                    <input type="text" name="FatherLastName"  class="form-control" value='<?php echo $fln; ?>' readonly>
                  </div>
                </div>

                <div class="form-group">
                  <p for="dadOccupation" class="col-sm-2 control-label">Father's occupation</p>

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
                  <button name="return" type="submit" class="btn btn-default">
                    Back
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