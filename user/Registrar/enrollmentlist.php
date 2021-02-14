
<?php 
    include_once('../../includes/header.php');
    validateAccess();
    validateRegistrar();

    $sql_select = "SELECT ss.StatusName, e.EnrollmentStatus, e.DateEnroll, l.LevelName, g.GenderName, s.FirstName AS StuFirstName, s.MiddleName AS StuMiddleName, s.LastName AS StuLastName, s.Birthday, s.Email, s.ContactNo, s.Address, s.MotherFirstName, s.MotherLastName, s.MotherOccupation, s.FatherFirstName, s.FatherLastName, s.FatherOccupation, s.DateAdded, s.DateModified FROM students s 
    INNER JOIN statusstudent ss 
    ON s.StatusStudentID = ss.StatusStudentID
    INNER JOIN enrollment e
    ON s.StudentID = e.StudentID
    INNER JOIN level l 
    ON s.LevelID = l.LevelID
    INNER JOIN gender g
    ON s.GenderID = g.GenderID
    WHERE e.DateEnroll = (SELECT MAX(DateEnroll) FROM enrollment)";

    $result_student = $con->query($sql_select) or die(mysqli_error($con));

    $student_num_rows = mysqli_num_rows($result_student);


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
        Enrollment Process
        <small>Check Enrollee Requirements</small>
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
              <h3 class="box-title">Student Requirements</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <?php 
                    if ( mysqli_num_rows($result_search) > 0 ) 
                    {
                      echo "<label>Click the 'View' button beside the row to view.</label></br>
                            <a href='enrollmentsearch.php'>Click here to search again.</a>";

                    } 
                    else 
                    {
                      echo "<b>No record(s) found.</b> Create new? <a href='enrollmentcreate.php'>Click here.</a></br>
                            <a href='enrollmentsearch.php'>Click here to search again.</a>";
                    }
                    
                    ?>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Search result</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <th>Student ID</th>
                  <th>Type of student</th>
                  <th>Enrollment Status</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_search))
                    {
                      $sid = $row['StudentID'];
                      $status = $row['StatusName'];
                      $estatus = $row['EnrollmentStatus'];
                      $fn = $row['FirstName'];
                      $mn = $row['MiddleName'];
                      $ln = $row['LastName'];
                      $bday = $row['Birthday'];
                      $gender = $row['GenderName'];
                      $address = $row['Address'];


                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$status</td>
                          <td>$estatus</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$gender</td>
                          <td>$address</td>
                          <td>
                              <a href='enrollmentviewselected.php?id=$sid' class='btn btn-sm btn-info'>
                                  View
                              </a>
                          </td>
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
    <!-- /.content -->

  <!-- /.content-wrapper -->
<?php
    include_once('../../includes/footer.php');
?>