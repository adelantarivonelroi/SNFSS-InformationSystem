<?php 

      $page_title="Sto. Nino Formation and Science ";
      include_once('../../includes/header.php');

      validateAccess();
      validateRegistrar();

      $displaymessage = "";

      $messageprdetails= "";
      $messagestatus = "";
      $sql_gettype = "SELECT gs.GradeTypeID, gt.GradeTypeName
      FROM gradestatus gs
      INNER JOIN gradetype gt
      ON gt.GradeTypeID = gt.GradeTypeID WHERE gs.GradeStatusID = 1";

      $result_gettype = $con->query($sql_gettype) or die(mysqli_error($con));

      while($row = mysqlI_fetch_array($result_gettype))
      {
          $gtid = $row['GradeTypeID'];
          $gtn = $row['GradeTypeName'];

      }
      $messageprdetails = "Current periodic rating is ". $gtn;

      if(isset($_POST['update']))
      {
        $switch = mysqli_real_escape_string($con, $_POST['switchselect']);



        $sql_switch = "UPDATE gradestatus SET `GradeTypeID` = '$switch' WHERE `GradeStatusID` = 1";
        $con->query($sql_switch) or die(mysqli_error($con));

        $string = "Updated periodic rating to " . $switch;
        #audit add student
        $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
        $con->query($sql_audit) or die (mysqli_error($con));
         $messageprdetails = "Successfully updated periodic rating to ". $switch;

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
        Update periodic rating
        <small>grading period</small>
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
                <h3 class="box-title">Update periodic rating</h3>
              </div>

              <div class="box-body">
                <div class="col-md-4">
                  <i class="control-label">Set the current periodic rating.</i>
                  <?php echo $messageprdetails ?>
                  <hr>
                </div>
              </div>

              <div class=box-body>
                  <div class="col-sm-7 ">
                    <div class="form-group">
                      <p class="control-label col-sm-3">Switch grade encode feature</p>
                      <div class="col-sm-3">
                        <select name="switchselect"  class="form-control" required>
                          <option value='1'>Periodic Rating 1</option>
                          <option value='2'>Periodic Rating 2</option>
                          <option value='3'>Periodic Rating 3</option>
                          <option value='4'>Periodic Rating 4</option>
                          <option value='5'>Final Rating</option>
                        </select>    
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