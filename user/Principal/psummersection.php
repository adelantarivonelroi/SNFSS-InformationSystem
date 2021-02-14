<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validatePrincipal();

  # displays list of sections  
  $sql_result = "SELECT s.*, sy.*, l.*, sub.SubjectName FROM summersection s
  INNER JOIN schoolyear sy
  ON s.SchoolYearID = sy.SchoolYearID 
  INNER JOIN level l 
  ON s.LevelID = l.LevelID 
  INNER JOIN subject sub 
  ON s.SubjectID = sub.SubjectID 
  WHERE Status = 'Pending'";
  $result_sql = $con->query($sql_result);

  if(isset($_POST['back'])) {
    header('location:index.php');
  }
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
        Approvals
        <small>manage approvals</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Approvals</a></li>
        <li class="active">Manage approvals</li>
      </ol>
    </section>

    <!-- Main content -->
    <form method="post">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pending sections approval</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="text-center table table-bordered table-striped">
                <thead>
                  <th>Summer Section ID</th>
                  <th>School Year</th>
                  <th>Level</th>
                  <th>Section</th>
                  <th>Subject</th>
                  <th>Date Submitted</th>
                  <th>Date Approved/Disapproved</th>
                  <th>Status</th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_sql))
                    {
                      $sid = $row['SummerSectionID'];
                      $sys = $row['SchoolYearStart'];
                      $sye = $row['SchoolYearEnd'];
                      $lid = $row['LevelID'];
                      $ln = $row['LevelName'];
                      $sn = $row['SectionName'];
                      $sub = $row['SubjectName'];
                      $dc = $row['DateCreated'];
                      $da = $row['DateApproved'];
                      $sstat = $row['Status'];
                      $sub = $row['SubjectName'];



                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$sys - $sye</td>
                          <td>$ln</td>
                          <td>$lid - $sn</td>
                          <td>$sub</td>
                          <td>$dc</td>
                          <td>$da</td>
                          <td>$sstat</td>
                          <td>
                          <a href='psummersectionapprove.php?id=$sid' class='btn btn-xs btn-success'>
                            Approve
                          </a>
                          </td>
                          <td>
                          <a href='psummersectiondisapprove.php?id=$sid' class='btn btn-xs btn-danger'>
                            Disapprove
                          </a>
                          </td>

                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>

            
          </div>
          <div class="box-footer text-center">
              <button name="back" type="submit" class="btn btn-default pull-left">Back</button>
          </div>



        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>