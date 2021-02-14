<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();
    # displays list of users
  # displays list of users
  $sql_result = "SELECT *
  FROM pendingsection";
  $result_sql = $con->query($sql_result);

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="
            ../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Section</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Manage section</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Assign class</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../class/index.php"><i class="fa fa-circle-o"></i> Manage lists</a></li>
              </ul>
            </li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>    
                

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Section
        <small>manage sections</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Section</a></li>
        <li class="active">Manage sections</li>
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
              <h3 class="box-title">What would you like to do?</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <label>Create sections to be approved.</label>
                  </div>
                  <div class="col-sm-4
                  ">
                    <a href="create.php">
                      <button type="button" class="btn btn-success">Create sections</button>
                    </a>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Record history</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="text-center table table-bordered table-striped">
                <thead>
                  <th>Section ID</th>
                  <th>Level ID</th>
                  <th>Section Number</th>
                  <th>Status</th>

                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_sql))
                    {
                      $sid = $row['pendingSectionID'];
                      $lid = $row['LevelID'];
                      $sn = $row['SectionName'];
                      $stat = $row['Status'];

                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$lid</td>
                          <td>$sn</td>
                          <td>$stat</td>
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
    <!-- /.content -->
  <!-- /.content-wrapper -->

<?php
    include_once('../../../includes/footer.php');
?>