<?php 

	$page_title="Sto. Nino Formation and Science ";
  include_once('../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateRegistrar();
  $displaymessage = "";
  if (isset($_POST['search']))
  { 
    $_SESSION['name'] = clean_input($_POST['searchname']);
    if (isset($_SESSION['name']) && !empty($_SESSION['name']))
    {
      header('location: updateclearancesearchresult.php');
    }
    else 
    {
      $displaymessage = "Must not be empty.";
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
        Student record
        <small>Manage student record</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Student record</a></li>
        <li class="active">Manage student record</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12 ">
          <!-- general form elements -->
          <div class="box box-primary ">
            <div class="box-header with-border">
              <h3 class="box-title">Search student</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <p class="col-sm-2 control-label">Student name</p>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="searchname">
                  </div>
                  <button name="search" type="submit" class="btn btn-primary">
                    Search
                  </button>
                  <?php echo $displaymessage ?>
                </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
    </section>


<?php
    include_once('../../includes/footer.php');
?>