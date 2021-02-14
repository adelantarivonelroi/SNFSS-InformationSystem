<?php 

	$page_title="Sto. Nino Formation and Science ";
    include_once('../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateRegistrar();

  $displaymessage = "";
  $passworddisplay = "";
  if(isset($_SESSION['parentstudent']) && !empty($_SESSION['parentstudent']))
  {
    $psid = $_SESSION['parentstudent'];

    $sql_selectrelation = "SELECT UserID, StudentID FROM parent WHERE ParentID = $psid";
    $result_selectrelation = $con->QUery($sql_selectrelation) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result_selectrelation))
    {
      $pid = $row['UserID'];
      $sid = $row['StudentID'];
    }
    $sql_selectparentacc = "SELECT UserName, Password FROM user WHERE UserID = $pid";
    $result_selectparentacc = $con->QUery($sql_selectparentacc) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result_selectparentacc))
    {
      $user = $row['UserName'];
      $pass = $row['Password'];
      if ($pass = 'changeme')
      {
        $passworddisplay = 'changeme';
      } 
      else
      {
        $passworddisplay = 'Password is changed. Report to IT Personnel.';
      }
    }

    $sql_selectstudentname = "SELECT FirstName AS StuFirstName, MiddleName AS StuMiddleName, LastName AS StuLastName FROM students WHERE StudentID = $sid";
    $result_selectstudentname = $con->QUery($sql_selectstudentname) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result_selectstudentname))
    {
      $sfn = $row['StuFirstName'];
      $smn = $row['StuMiddleName'];
      $sln = $row['StuLastName'];
    }

    unset($_SESSION['parenstudent']);
  }
  else 
  {
    $displaymessage = "You have not yet created a record. <a href='enrollmentsearch'>Click here to return.</a>";
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
        Home
        <small>registrar</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
              <h3 class="box-title">Home</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <?php echo $displaymessage ?>
                    <p>Successfully created a student record for <label><?php echo $sfn ." ". $smn ." ".$sln ?></label></p>
                    <hr>
                    <p>Created a parent account</p>
                    <p>Username: <label><?php echo $user ?></label></p>
                    <p>Password: <label><?php echo $passworddisplay ?></label></p>
                    <hr>
                    <p>Process another enrollee</p><a href='enrollmentsearch.php'>Click here.</a>

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