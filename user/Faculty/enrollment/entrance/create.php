<?php 

	$page_title="Sto. Nino Formation and Science ";
  include_once( '../../../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateFaculty();
  if (isset($_POST['add']))
  {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $mname = mysqli_real_escape_string($con, $_POST['mname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    //date returned not included
    $bday = mysqli_real_escape_string($con, $_POST['bday']);
    $ylevel = mysqli_real_escape_string($con, $_POST['yearlevel']);
    $escore = mysqli_real_escape_string($con, $_POST['scoreeng']);
    $mscore = mysqli_real_escape_string($con, $_POST['scoremath']);
    $sscore = mysqli_real_escape_string($con, $_POST['scoresci']);

    //owner null
    $sql_add = "INSERT INTO entranceexam VALUES ('', '$fname', '$mname', '$lname',
      '$bday', '$ylevel', '$escore', '$mscore', '$sscore', NOW() )";
    $con->query($sql_add) or die(mysqli_error($con));
    header('location: index.php');
  }

  if (isset($_POST['cancel']))
  {
    header('location: index.php');
  }

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
        <li><a href="#">Manage entrance exam</a></li>
        <li class="active">Record exam grade</li>
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
              <h3 class="box-title">Examinee's record</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" class="form-horizontal">
              <div class="box-body">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Year level</label>
                  <div class="col-sm-4">
                    <select class="form-control" name="yearlevel">
                      <option value="12">Senior High</option>
                      <option value="11">Junior High</option>
                      <option value="10">Fourth Year</option>
                      <option value="11">Third Year</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">First name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="fname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Middle name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="mname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Last name</label>

                  <div class="col-sm-4">
                    <input type="text" class="form-control" name="lname">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Birthday</label>

                  <div class="col-sm-4">
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control" name="bday" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">English score</label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="scoreeng">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Math score</label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="scoremath">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label">Science score</label>

                  <div class="col-sm-4">
                    <input type="number" class="form-control" name="scoresci">
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="cancel" type="submit" class="btn btn-default">
                  Cancel
                </button>
                <button name="add" type="submit" class="btn btn-success pull-right">
                  Create
                </button>
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
    include_once('../../../../includes/footer.php');
?>