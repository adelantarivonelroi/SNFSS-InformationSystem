<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateITPersonnel();

  $sql_log = $con->prepare("SELECT * FROM audit");
  $sql_log->execute();
  $result_log = $sql_log->get_result();
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">User Management</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="registeruser.php"><i class="fa fa-circle-o text-red"></i> <span>Add new user</span></a></li>
            <li><a href="addroles.php"><i class="fa fa-circle-o text-red"></i> <span>Add new role</span></a></li>
            <li><a href="viewuser.php"><i class="fa fa-circle-o text-red"></i> <span>Manage user(s)</span></a></li>
            <li><a href="viewarchiveuser.php"><i class="fa fa-circle-o text-red"></i> <span>View archived user(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View activity logs</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Audit
        <small>view audit log</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">audit</a></li>
        <li class="active">View audit log</li>
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
              <h3 class="box-title">Viewing all activity logs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="table3" class="table table-bordered table-striped">
                <thead>
                  <th>Audit ID</th>
                  <th>UserID</th>
                  <th>Description</th>
                  <th>LogDate</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_log))
                    {
                      $aid = $row['AuditID'];
                      $user = $row['UserID'];
                      $desc = $row['Description'];
                      $log = $row['LogDate'];

                      echo "
                        <tr>
                          <td>$aid</td>
                          <td>$user</td>
                          <td>$desc</td>
                          <td>$log</td>
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
    include_once('../../includes/footer.php');
?>