<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateRegistrar();

  # retrieve search result

  $search = $_SESSION['name'];
  $string = '%' . $search . '%';

  $sql_search = $con->prepare("SELECT s.StudentID, s.FirstName, s.MiddleName, s.LastName, s.Birthday, g.GenderName , s.AddressID, ss.StatusName, e.EnrollmentStatus
        FROM students s 
        INNER JOIN gender g 
        ON s.GenderID = g.GenderID 
        INNER JOIN statusstudent ss 
        ON s.StatusStudentID = ss.StatusStudentID
        INNER JOIN  enrollment e 
        ON s.StudentID = e.StudentID
        WHERE s.FirstName LIKE ? OR s.LastName LIKE ? ORDER BY e.DateEnroll DESC LIMIT 1");

  $sql_search->bind_param('ss', $string, $string);
  $sql_search->execute();
  $result_search = $sql_search->get_result();

  if (isset($_POST['view']))
  {
    if (isset($_POST['tradio']) && !empty($_POST['tradio']))
    {
      $radioselect = mysqli_real_escape_string($con, $_POST['tradio']);
      $_SESSION['clearancestudentid'] = $radioselect;
      header('location: updateclearancestatus.php');
    }
    else
    {
      echo "Select a student record first.";
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
        Clearance
        <small>update clearance status</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">clearance</a></li>
        <li class="active">Update clearance status</li>
      </ol>
    </section>

    <!-- Main content -->
    <form class="form-horizontal" method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student requirements</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <?php 
                    if ( mysqli_num_rows($result_search) > 0 ) 
                    {
                      echo "<label>Click the 'View' button beside the row to view.</label></br>
                            <a href='updateclearancesearch.php'>Click here to search again.</a>";

                    } 
                    else 
                    {
                      echo "<b>No record(s) found.</a></br>
                            <a href='updateclearancesearch.php'>Click here to search again.</a>";
                    }
                    
                    ?>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Search result</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="text-center">
              <button name='view' type='submit' class='btn btn-primary'>View</button>
             </div>
             <table id="example2" class="table table-bordered table-striped text-center">
                <thead>
                  <th></th>
                  <th>Student ID</th>
                  <th>Type of student</th>
                  <th>Enrollment Status</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Gender</th>
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
                      //$address = $row['AddressID'];


                      echo "
                        <tr>
                          <td><input type='radio' name='tradio' value='$sid' /></td>
                          <td>$sid</td>
                          <td>$status</td>
                          <td>$estatus</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$gender</td>
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