<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateRegistrar();

  # retrieve search result

  $search = $_SESSION['name'];
  $string = '%' . $search . '%';

  $sql_search = $con->prepare("SELECT c.ClearanceID, c.StudentID, c.ClearanceStatus, s.FirstName AS StuFirstName, s.MiddleName AS StuMiddleName, s.LastName AS StuLastName
        FROM clearance c
        INNER JOIN students s
        ON c.StudentID = s.StudentID 
        WHERE s.FirstName LIKE ? OR s.LastName LIKE ?");
  $sql_search->bind_param('ss', $string, $string);
  $sql_search->execute();
  $result_search = $sql_search->get_result();

  if(isset($_POST['select']))
  {
    $_SESSION['studentid'] = $sid;
    header('location : updateclearancestatus.php ');
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
        <small>Check enrollee requirements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirements</li>
      </ol>
    </section>

    <!-- Main content -->
    <form method="POST">
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
                      echo "<label>Click on a record below to view.</label>";
                    } 
                    else 
                    {
                      echo "No record(s) found.</a>";
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
                  <th>Clearance ID</th>
                  <th>Full name</th>
                  <th>Clearance Status</th>
                  <th></th>

                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_search))
                    {
                      $sid = $row['StudentID'];
                      $cstat = $row['ClearanceStatus'];
                      $fn = $row['StuFirstName'];
                      $mn = $row['StuMiddleName'];
                      $ln = $row['StuLastName'];

                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$cstat</td>
                          <td>$ln, $fn $mn</td>
                          <td>
                              <button name='select' type='submit' class='btn btn-primary'>View</button>
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
  </form>
    <!-- /.content -->
  <!-- /.content-wrapper -->
<?php
    include_once('../../includes/footer.php');
?>