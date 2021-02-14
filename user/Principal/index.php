<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validatePrincipal();

?>
     <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Approvals</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="approvedsections.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Sections</span></a></li>
            <li><a href="approvedfacultylist.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Faculty List</span></a></li>
            <li><a href="approvedstudentlist.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Student List</span></a></li>
            <li class="header">Pending</li>
            <li><a href="psections.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Sections</span></a></li>
            <li><a href="pfacultylist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Faculty List(s)</span></a></li>
            <li><a href="pclasslist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Class List(s)</span></a></li>
            <li class="header">Pending ( Summer )</li>
            <li><a href="psummersection.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Summer Sections</span></a></li>
            <li><a href="psummerfacultylist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Summer Faculty List(s)</span></a></li>
            <li><a href="psummerclasslist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Summer Class List(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View Activity Logs</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
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