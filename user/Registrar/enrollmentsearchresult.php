<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateRegistrar();

  # retrieve search result

  $search = $_SESSION['name'];
  $string = '%' . $search . '%';

  $sql_search = $con->prepare("SELECT s.StudentID, s.FirstName, s.MiddleName, s.LastName, s.Birthday, g.GenderName, a.Street, a.Barangay, c.CityName, ss.StatusName, e.EnrollmentStatus
        FROM students s 
        INNER JOIN gender g 
        ON s.GenderID = g.GenderID 
        INNER JOIN statusstudent ss 
        ON s.StatusStudentID = ss.StatusStudentID
        INNER JOIN  enrollment e 
        ON s.StudentID = e.StudentID
        INNER JOIN  address a 
        ON s.AddressID = a.AddressID
        INNER JOIN  city c 
        ON a.CityID = c.CityID
        WHERE FirstName LIKE ? OR LastName LIKE ? ORDER BY e.DateEnroll DESC LIMIT 1");

  $sql_search->bind_param('ss', $string, $string);
  $sql_search->execute();
  $result_search = $sql_search->get_result();
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
              <h3 class="box-title">Student requirements</h3>
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
             <table id="example1" class="table table-bordered table-striped">
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
                      
                      $street = decrypt($row['Street']);
                      $brgy = decrypt($row['Barangay']);
                      $city = $row['CityName'];


                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$status</td>
                          <td>$estatus</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$gender</td>
                          <td>$street, $brgy, $city</td>
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