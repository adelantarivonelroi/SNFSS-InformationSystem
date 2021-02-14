<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $sql_pendingsection = "SELECT s.*, sy.*, l.* FROM section s
  INNER JOIN schoolyear sy
  ON s.SchoolYearID = sy.SchoolYearID 
  INNER JOIN level l 
  ON s.LevelID = l.LevelID 
  WHERE SectionStatus = 'Pending'";

  $result_pendingsection = $con->query($sql_pendingsection) or die(mysqli_error($con));

  if (isset($_POST['back']))
  {
    header('location: sectionhome.php');
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
        Section
        <small>Manage sections</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Section</a></li>
        <li class="active">Manage sections</li>
      </ol>
    </section>

    <!-- Main content -->
    <form method="POST">
     <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View pending section proposals</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <th>Section ID</th>
                  <th>School Year</th>
                  <th>Level</th>
                  <th>Section</th>
                  <th>Date Submitted</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_pendingsection))
                    {
                      $sid = $row['SectionID'];
                      $sys = $row['SchoolYearStart'];
                      $sye = $row['SchoolYearEnd'];
                      $lid = $row['LevelID'];
                      $ln = $row['LevelName'];
                      $sn = $row['SectionName'];
                      $dc = $row['DateCreated'];
                      $da = $row['DateApproved'];
                      $sstat = $row['SectionStatus'];



                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$sys - $sye</td>
                          <td>$ln</td>
                          <td>$lid - $sn</td>
                          <td>$dc</td>
                          <td>$sstat</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
                  <button name="back" type="submit" class="btn btn-default pull-left">Back</button>
            </div>
            
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