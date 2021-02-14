<?php 

	$page_title="Sto. Nino Formation and Science ";
  include_once('../../../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateFaculty();
  if (isset($_POST['search']))
  { 
    $_SESSION['name'] = $_POST['searchname'];
    header('location: searchresult.php');
  }

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="../../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Enrollment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../enrollment/entrance/index.php"><i class="fa fa-circle-o"></i>Entrance exam grade</a></li>
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Verify enrollee status</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Faculty Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../viewschedule.php"><i class="fa fa-circle-o"></i>View schedule</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Student Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../student/grade/index.php"><i class="fa fa-circle-o"></i>Encode grade</a></li>
              </ul>
            </li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>
                
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enrollment
        <small>check enrollee requirement</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirement</li>
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
              <h3 class="box-title">Search enrollee</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Enrollee name</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="searchname">
                  </div>
                  <button name="search" type="submit" class="btn btn-success">
                    Search
                  </button>
                </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
    </section>


<?php
    include_once('../../../../includes/footer.php');
?>