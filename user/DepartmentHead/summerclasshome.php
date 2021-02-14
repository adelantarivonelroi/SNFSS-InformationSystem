<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();
    # displays list of users
  # displays list of users
  $sql_result = "SELECT *
  FROM pendingsection";
  $result_sql = $con->query($sql_result);

  if (isset($_POST['createsummersection']))
  {
    header('location: summersectioncreate.php');
  }
  if (isset($_POST['createsummerfacultylist']))
  {
    header('location: summerfacultylistcreate.php');
  }
  if (isset($_POST['createsummerstudentlist']))
  {
    header('location: summerstudentlistcreate.php');
  }
  if (isset($_POST['viewapproved']))
  {
    header('location: sectionviewapproved.php');
  }
  if (isset($_POST['viewpending']))
  {
    header('location: sectionviewpending.php');
  }
  if (isset($_POST['archivestudent']))
  {
    header('location: archiveviewsection.php');
  }
  if (isset($_POST['archivestudentview']))
  {
    header('location: archivestudentviewall.php');
  }
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Index</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Faculty list</li>
            <li><a href="facultylisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Faculty list</span></a></li>
            <li class="header">Student list</li>
            <li><a href="studentlisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student list</span></a></li>
            <li class="header">Sections</li>
            <li><a href="sectionhome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Sections</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="studentrecordsearch.php"><i class="fa fa-circle-o text-red"></i> <span>View Student Record</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>   
                

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Summer class
        <small>manage summer ckass</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Section</a></li>
        <li class="active">Manage summer class</li>
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
              <h3 class="box-title">Manage summer class</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST">
              <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Summer class features</label>
                    </div>
                    <div class="form-group">
                        <p class="col-sm-2 control-label">Create summer class section</p>
                        <div class="col-sm-2">
                          <button name="createsummersection" type="submit" class="btn btn-primary">
                            Click here
                          </button>
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <p class="col-sm-2 control-label">Create summer class faculty list</p>
                        <div class="col-sm-2">
                          <button name="createsummerfacultylist" type="submit" class="btn btn-primary">
                            Click here
                          </button>
                        </div>

                    </div>
                    <div class="form-group">
                        <p class="col-sm-2 control-label">Create summer class student list</p>
                        <div class="col-sm-2">
                          <button name="summerstudentlistcreate" type="submit" class="btn btn-primary">
                            Click here
                          </button>
                        </div>
                        
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