<?php 

	$page_title="Sto. Nino Formation and Science ";
    include_once('../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateFaculty();

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Faculty Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="viewschedule.php"><i class="fa fa-circle-o"></i>View schedule</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Student Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="encodeindex.php"><i class="fa fa-circle-o"></i>Encode grade</a></li>
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
        Home
        <small>faculty</small>
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
                    <label>Select a task from the side bar.</label>
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