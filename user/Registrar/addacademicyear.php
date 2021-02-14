<?php 

      $page_title="Sto. Nino Formation and Science ";
      include_once('../../includes/header.php');

      validateAccess();
      validateRegistrar();

      $displaymessage = "";

      $sql_sy = "SELECT DISTINCT SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
      $result_sy = $con->query($sql_sy) or die(mysqli_error($con));

      while ( $row = mysqli_fetch_array($result_sy))
      {
        $systart = $row['SchoolYearStart'];
        $syend = $row['SchoolYearEnd'];
      }

      if(isset($_POST['update']))
      {
        $start = mysqli_real_escape_string($con, $_POST['start']);
        $end = mysqli_real_escape_string($con, $_POST['end']);

        $sql_addyear = "INSERT INTO schoolyear ( SchoolYearStart, SchoolYearEnd ) VALUES ( $start, $end )";
        $con->query($sql_addyear) or die(mysqli_error($con));

        $string = "added a new school year " . $start . " - " . $end;
        #audit add student
        $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
        $con->query($sql_audit) or die (mysqli_error($con));

        $displaymessage = "Successfully updated the current school year.";
        header('location: addacademicyear.php');

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
        Student Record
        <small>Encode Feature</small>
      </h1>
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
                <h3 class="box-title">Manage academic year</h3>
              </div>

              <div class="box-body">
                <div class="col-md-4">
                  <i class="control-label">Update the current academic year.</p>
                  <i class="control-label">Current academic year is <b><?php echo $systart . ' - ' . $syend ?></b></p>
                  <?php echo $displaymessage ?>
                  <hr>
                </div>
              </div>

              <div class=box-body>
                  <div class="col-sm-7 ">
                    <div class="form-group">
                      <p class="control-label col-sm-3">Input the new academic year</p>
                      <div class="col-sm-2">
                        <input type="number" name="start"  class="form-control" required>
                      </div>   
                      <div class="col-sm-2">
                        <input type="number" name="end"  class="form-control" required>
                      </div>    
                      <div class="col-sm-3">
                        <button name="update" type="submit" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                </div>
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