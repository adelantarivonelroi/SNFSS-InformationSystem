<?php 

	$page_title="Sto. Nino Formation and Science ";
    include_once('includes/header-visitor.php');
    //include ('../../config.php');
  validateAccess();

 
    if (isset($_POST['back']))
  {   
    $usertype = $_SESSION['usertype'];
    if ($usertype == 'Principal')
    {
      header('location:'.app_path.'user/Principal/index.php');
    }
    if ($usertype == 'Parents')
    {
      header('location:'.app_path.'user/Parents/index.php');
    }
    if ($usertype == 'Student Services Officer')
    {
      header('location:'.app_path.'user/StudentServicesOfficer/index.php');
    }
        if ($usertype == 'Faculty')
    {
      header('location:'.app_path.'user/Faculty/index.php');
    }
    if ($usertype == 'Registrar')
    {
      header('location:'.app_path.'user/Registrar/index.php');
    }
    if ($usertype == 'IT Personnel')
    {
      header('location:'.app_path.'user/ITPersonnel/index.php');
    }
    if ($usertype == 'Department Head')
    {
      header('location:'.app_path.'user/DepartmentHead/index.php');
    }
  }

  $usertype = $_SESSION['usertype'];
  if ($usertype == 'Principal')
  {
    $link = 'user/Principal/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Parents')
  {
    $link ='user/Parents/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Faculty')
  {
    $link ='user/Faculty/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Student Services Officer')
  {
    $link ='user/StudentServicesOfficer/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Registrar')
  {
    $link ='user/Registrar/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if($usertype == 'IT Personnel')
    {
      $link ='user/ITPersonnel/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

    if($usertype == 'Department Head')
    {
      $link ='user/DepartmentHead/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

?>
  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <section class="sidebar">
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="<?php echo $link ?>"><i class="fa fa-circle-o text-red"></i> <span><?php echo $Home ?></span></a></li>
          </section>
          <!-- /.sidebar -->
        </aside>
    </section> 
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invalid
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Unauthorized Access</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <label>You do not have authorized access to view this page.</label>
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
    include_once('includes/footer.php');
?>