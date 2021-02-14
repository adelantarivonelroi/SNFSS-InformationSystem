<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validatePrincipal();

  $sql_log = $con->prepare("SELECT * FROM audit");
  $sql_log->execute();
  $result_log = $sql_log->get_result();
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
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View Activity Logs</span></a></li>
          </ul>
          </section>
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enrollment
        <small>Check enrollee requirements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirements</li>
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
              <h3 class="box-title">Viewing all enrollees</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <th>Audit ID</th>
                  <th>UserID</th>
                  <th>Description</th>
                  <th>LogDate</th>

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