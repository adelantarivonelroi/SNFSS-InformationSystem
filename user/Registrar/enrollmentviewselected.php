
<?php 
    # checks if record is selected
    if (isset($_REQUEST['id']))
    {
        # checks if selected record is an ID value
        if (ctype_digit($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            include_once('../../includes/header.php');
            validateAccess();
            validateRegistrar();

            $label1 = "";
            $label2 = "";
            $label3 = "";
            $label4 = "";
            $req1 = "";
            $req2 = "";
            $req3 = "";
            $statustext = "";
            $enrollmentstatustext = "";

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

             # list of enrollment type for selection
            $sql_enrolltype = "SELECT EnrollmentTypeID, EnrollmentTypeName FROM enrollmenttype";
             $result_enrolltype =$con->query($sql_enrolltype);

             $list_enrolltype = "";
             while($row = mysqli_fetch_array($result_enrolltype))
             {
                $entypeid= $row['EnrollmentTypeID'];
                $entypename= $row['EnrollmentTypeName'];
                $list_enrolltype .="<option value='$entypeid'>$entypename</option>";
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

             # get enrollment status
            $sql_enrollmentstat = "SELECT e.EnrollmentStatus, et.EnrollmentTypeName
                FROM students s 
                INNER JOIN enrollment e 
                ON s.StudentID = e.StudentID 
                INNER JOIN enrollmenttype et
                ON e.EnrollmentTypeID = et.EnrollmentTypeID 
                WHERE s.StudentID=$id ORDER BY e.EnrollmentID DESC LIMIT 1";

            $result_enrollmentstat = $con->query($sql_enrollmentstat) or die(mysqli_error($con));

            while ($row = mysqli_fetch_array($result_enrollmentstat))
            {
                $statusenroll = $row['EnrollmentStatus'];
                $typeenroll = $row['EnrollmentTypeName'];
            }

            # get selected record
            $sql_selectedsearch = "SELECT s.StudentID, st.StudentTypeName, s.FirstName, s.MiddleName, s.LastName, s.Birthday, g.GenderName, a.Street, a.Barangay, cc.CityName, ss.StatusName, c.ClearanceStatus
                FROM students s 
                INNER JOIN studenttype st 
                ON s.StudentTypeID = st.StudentTypeID
                INNER JOIN gender g 
                ON s.GenderID = g.GenderID 
                INNER JOIN statusstudent ss 
                ON s.StatusStudentID = ss.StatusStudentID
                INNER JOIN clearance c
                ON s.StudentID = c.StudentID
                INNER JOIN  address a 
                ON s.AddressID = a.AddressID
                INNER JOIN  city cc 
                ON a.CityID = cc.CityID
                WHERE s.StudentID=$id";

            $result_search = $con->query($sql_selectedsearch) or die(mysqli_error($con));
            
             # checks if record is not existing
            if (mysqli_num_rows($result_search) == 0)
            {
                header('location: index.php');
            }

            while ($row = mysqli_fetch_array($result_search))
            {
                $studid = $row['StudentID'];
                $typestudent = $row['StudentTypeName'];
                $status = $row['StatusName'];
                $clearance = $row['ClearanceStatus'];
                $fname = $row['FirstName'];
                $mname = $row['MiddleName'];
                $lname = $row['LastName'];
                $bday = $row['Birthday'];
                $gender = $row['GenderName'];

                $street = decrypt($row['Street']);
                $brgy = decrypt($row['Barangay']);
                $city = $row['CityName'];
            }

            if ( $statusenroll == "Not Enrolled") {
                $label4 = "<p class='col-sm-2 control-label'>List of requirements</p>";

                $req1 = "<label class='col-sm-5 control-label'>Requirement number one.</label>";
                $req2 = "<label class='col-sm-5 control-label'>Requirement number two.</label>";
                $req3 = "<label class='col-sm-5 control-label'>Requirement number two.</label>";

                $statustext = "<span> $status </span>";
                $enrollmentstatustext = "<span style='color:red'> $statusenroll </span>";

            } else {
                $label1 = "<label>Type of student</label>";
                $label2 = "<label>Enrollment Status</label>";
                $label3 = "<label>Full name</label>";
                $statustext = "<span> $status </span>";
                $enrollmentstatustext = "<span style='color:green'> $statusenroll </span>";
            }

            # updates type of student
            if (isset($_POST['updatestatustype']))
            {
                $typestat = mysqli_real_escape_string($con, $_POST['statstudentid']);

                $sql_updatetype = "UPDATE students SET StatusStudentID = $typestat WHERE StudentID = $id";

                $string = "Updated type of the student id " . $id . ", $typestat";
                #audit add student
                $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
                $con->query($sql_audit) or die (mysqli_error($con));

                $con->query($sql_updatetype) or die(mysqli_error($con));
                header('location: enrollmentviewselected.php?id='.$id);
                
            }
            # updates enrollment status of student
            if (isset($_POST['updatestatusenroll']))
            {
                $enrollstat = mysqli_real_escape_string($con, $_POST['EnrollmentStatus']);
                $typeenrollinp = mysqli_real_escape_string($con, $_POST['typeenrollment']);

                $sql_enroll = "INSERT INTO enrollment ( StudentID, EnrollmentStatus, EnrollmentTypeID, DateEnroll ) VALUES ( $id, '$enrollstat', $typeenrollinp, NOW() )";

                $string = "Updated enrollment status of student id " . $id . ", $enrollstat, $typeenrollinp";
                #audit add student
                $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
                $con->query($sql_audit) or die (mysqli_error($con));

                $con->query($sql_enroll) or die(mysqli_error($con));
                header('location: enrollmentviewselected.php?id='.$id);
            }

            # updates type of student
            if (isset($_POST['updatestudentclass']))
            {
                $typestudentinp = mysqli_real_escape_string($con, $_POST['typestudent']);

                $sql_updatetype = "UPDATE students SET StudentTypeID = $typestudentinp WHERE StudentID = $id";

                $string = "Updated type of the student id " . $id . ", $typestudentinp";
                #audit add student
                $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
                $con->query($sql_audit) or die (mysqli_error($con));

                $con->query($sql_updatetype) or die(mysqli_error($con));
                header('location: enrollmentviewselected.php?id='.$id);
                
            }

             # go back to search
            if (isset($_POST['viewstudentrecord']))
            {
              header('location: enrollmentviewselectedstudentrecord.php?id='.$id);

              $string = "Viewed student record of student id " . $id;
              #audit add student
              $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
              $con->query($sql_audit) or die (mysqli_error($con));
            }

            # go back to search
            if (isset($_POST['searchanother']))
            {
              header('location: enrollmentsearch.php');
            }
        }
        else
        {
            header('location: enrollmentsearch.php');
        }
    }
    else
    {
        header('location: enrollmentsearch.php');
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
        Enrollment
        <small>Check enrollee requirements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirements</li>
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
              <h3 class="box-title">Student Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
              <div class="box-body">
                <div class="row">
                  
                


                <div class="form-group">
                    <p class="col-sm-2 control-label">Type of student</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $status ?></label>  
                    </div>

                    <div class="form-group">
                      <p class="col-sm-1 control-label">Type of student</p>
                      <div class="col-sm-2">
                         <select name="statstudentid"  class="form-control" required>
                            <?php echo $list_status; ?>
                        </select>      
                      </div>
                      <button name="updatestatustype" type="submit" class="btn btn-primary">
                        Update
                      </button>
                    </div>

                    <p class="col-sm-2 control-label">Student classification</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $typestudent ?></label>
                    </div>

                    <div class="form-group">
                      <p class="col-sm-1 control-label">Student classification</p>
                      <div class="col-sm-2">
                         <select name="typestudent"  class="form-control" required>
                            <?php echo $list_stutype; ?>
                        </select>      
                      </div>
                      <button name="updatestudentclass" type="submit" class="btn btn-primary">
                        Update
                      </button>
                    </div>

                    <p class="col-sm-2 control-label">Enrollment status</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $enrollmentstatustext ?></label>
                    </div>

                    <div class="form-group">
                      <p class="col-sm-1 control-label">Enrollment status</p>
                      <div class="col-sm-2">
                         <select name="EnrollmentStatus"  class="form-control" required>
                          <option value='Not Enrolled'>Not Enrolled</option>
                          <option value='Enrolled'>Enrolled</option>
                        </select>    
                      </div>
                    </div>

                    <p class="col-sm-2 control-label">Enrollment type</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $typeenroll ?></label>
                    </div>

                    <div class="form-group">
                      <p class="col-sm-1 control-label">Enrollment type</p>
                      <div class="col-sm-2">
                          <select name="typeenrollment"  class="form-control" required>
                            <?php echo $list_enrolltype; ?>
                        </select>   
                      </div>
                      <button name="updatestatusenroll" type="submit" class="btn btn-primary">
                        Update
                      </button>
                    </div>

                    <p class="col-sm-2 control-label">Clearance</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $clearance ?></label> 
                    </div>

                    <div class="form-group">
                      <p class="col-sm-2 control-label">View full student record.</p>
                      <div class="col-sm-2">
                        <button name="viewstudentrecord" type="submit" class="btn btn-primary">
                          Click here
                        </button>
                      </div>
                    </div>

                    <p class="col-sm-2 control-label">Gender</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $gender ?></label> 
                    </div>
                
                    <div class="form-group">
                      <p class="col-sm-2 control-label">Search another student record.</p>
                      <div class="col-sm-2">
                        <button name="searchanother" type="submit" class="btn btn-default">
                          Click here
                        </button>
                      </div>
                    </div>
                    <p class="col-sm-2 control-label">Birthday</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $bday ?></label>  
                    </div>

                    <p class="col-sm-2 control-label">Street</p>
                    <div class="col-sm-4">
                      <label class="col-sm-5 control-label"><?php echo $street . ", " . $brgy . ", " . $city ?></label>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                     <?php echo $label4 ?>
                     <div class="col-sm-4">
                      <?php echo $req1 ?>
                    </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2">
                    <?php echo "" ?>
                  </div>
                  <div class="col-sm-4">
                    <?php echo $req2 ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-2">
                    <?php echo "" ?>
                  </div>
                  <div class="col-sm-4">
                    <?php echo $req3 ?>
                  </div>
                </div>               
                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->
<?php
    include_once('../../includes/footer.php');
?>