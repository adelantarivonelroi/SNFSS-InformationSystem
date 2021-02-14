<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateFaculty();
  # displays list of users
  $sql_result = "SELECT eeID, examineeFirstName, examineeMiddleName, examineeLastName,
    birthday, yearLevel, scoreEnglish, scoreMath, scoreScience, dateTaken 
  FROM entranceexam";
  $result_sql = $con->query($sql_result);

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
                <li><a href="index.php"><i class="fa fa-circle-o"></i>Entrance exam grade</a></li>
                <li><a href="../../enrollment/verify/index.php"><i class="fa fa-circle-o"></i> Verify enrollee status</a></li>
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
        <small>manage entrance exam</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Manage entrance exam</li>
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
                  <div class="col-sm-2">
                    <label>Record extrance exam grade/s</label>
                  </div>
                  <div class="col-sm-2">
                    <a href="create.php">
                      <button type="button" class="btn btn-success">Record grade</button>
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
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>Exam ID</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Year level</th>
                  <th>English </th>
                  <th>Math</th>
                  <th>Science</th>
                  <th>Date taken</th>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_sql))
                    {
                      $eeid = $row['eeID'];
                      $fn = $row['examineeFirstName'];
                      $mn = $row['examineeMiddleName'];
                      $ln = $row['examineeLastName'];
                      $bday = $row['birthday'];
                      $yl = $row['yearLevel'];
                      $se = $row['scoreEnglish'];
                      $sm = $row['scoreMath'];
                      $ss = $row['scoreScience'];
                      $dt = $row['dateTaken'];

                      echo "
                        <tr>
                          <td>$eeid</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$yl</td>
                          <td>$se</td>
                          <td>$sm</td>
                          <td>$ss</td>
                          <td>$dt</td>
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
    include_once('../../../../includes/footer.php');
?>