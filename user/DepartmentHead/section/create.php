<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();
  # retrieve number of student per year level to display
  $sql_grade1 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=1 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade2 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=2 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade3 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=3 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade4 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=4 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade5 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=5 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade6 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=6 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade7 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=7 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_grade8 = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=8 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_freshman = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=9 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_sophomore = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=10 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_junior = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=11 AND e.EnrollmentStatus = 'Enrolled'";
  $sql_senior = "SELECT * FROM students s INNER JOIN enrollment e ON s.StudentID = e.StudentID WHERE s.LevelID=12 AND e.EnrollmentStatus = 'Enrolled'";


  $result_grade1 = $con->query($sql_grade1) or die(mysqli_error($con));
  $result_grade2 = $con->query($sql_grade2) or die(mysqli_error($con));
  $result_grade3 = $con->query($sql_grade3) or die(mysqli_error($con));
  $result_grade4 = $con->query($sql_grade4) or die(mysqli_error($con));
  $result_grade5 = $con->query($sql_grade5) or die(mysqli_error($con));
  $result_grade6 = $con->query($sql_grade6) or die(mysqli_error($con));
  $result_grade7 = $con->query($sql_grade7) or die(mysqli_error($con));
  $result_grade8 = $con->query($sql_grade8) or die(mysqli_error($con));
  $result_freshman = $con->query($sql_freshman) or die(mysqli_error($con));
  $result_sophomore = $con->query($sql_sophomore) or die(mysqli_error($con));
  $result_junior = $con->query($sql_junior) or die(mysqli_error($con));
  $result_senior = $con->query($sql_senior) or die(mysqli_error($con));

  $num_grade1 = mysqli_num_rows($result_grade1);
  $num_grade2 = mysqli_num_rows($result_grade2);
  $num_grade3 = mysqli_num_rows($result_grade3);
  $num_grade4 = mysqli_num_rows($result_grade4);
  $num_grade5 = mysqli_num_rows($result_grade5);
  $num_grade6 = mysqli_num_rows($result_grade6);
  $num_grade7 = mysqli_num_rows($result_grade7);
  $num_grade8 = mysqli_num_rows($result_grade8);
  $num_freshman = mysqli_num_rows($result_freshman);
  $num_sophomore = mysqli_num_rows($result_sophomore);
  $num_junior = mysqli_num_rows($result_junior);
  $num_senior = mysqli_num_rows($result_senior);

  $nosection1 = "";
  $nosection2 = "";
  $nosection3 = "";
  $nosection4 = "";
  $nosection5 = "";
  $nosection6 = "";
  $nosection7 = "";
  $nosection8 = "";
  $nosection9 = "";
  $nosection10 = "";
  $nosection11 = "";
  $nosection12 = "";

  $chkbox1 = "";
  $chkbox2 = "";
  $chkbox3 = "";
  $chkbox4 = "";
  $chkbox5 = "";
  $chkbox6 = "";
  $chkbox7 = "";
  $chkbox8 = "";
  $chkbox9 = "";
  $chkbox10 = "";
  $chkbox11 = "";
  $chkbox12 = "";

  $message = "";


  if(isset($_POST['generate'])) {
    $checkboxes = isset($_POST['check_list']) ? $_POST['check_list'] : array();
    if(!empty($checkboxes)) {
      foreach ($checkboxes as $selected) {
        #if statement for each year level
        #loop statement for how many times to insert 
        #increment section formula
        if ($selected == 1) {
          $nosection1 = ceil( $num_grade1 / 25 );
          $chkbox1 = "checked='checked'";
        }
        if ($selected == 2) {
          $nosection2 = ceil( $num_grade2 / 25 );
          $chkbox2 = "checked='checked'";
        }
        if ($selected == 3) {
          $nosection3 = ceil( $num_grade3 / 25 );
          $chkbox3 = "checked='checked'";
        }
        if ($selected == 4) {
          $nosection4 = ceil( $num_grade4 / 25 );
          $chkbox4 = "checked='checked'";
        }
        if ($selected == 5) {
          $nosection5 = ceil( $num_grade5 / 25 );
          $chkbox5 = "checked='checked'";
        }
        if ($selected == 6) {
          $nosection6 = ceil( $num_grade6 / 25 );
          $chkbox6 = "checked='checked'";
        }
        if ($selected == 7) {
          $nosection7 = ceil( $num_grade7 / 25 );
          $chkbox7 = "checked='checked'";
        }
        if ($selected == 8) {
          $nosection8 = ceil( $num_grade8 / 25 );
          $chkbox8 = "checked='checked'";
        }
        if ($selected == 9) {
          $nosection9 = ceil( $num_freshman / 25 );
          $chkbox9 = "checked='checked'";
        }
        if ($selected == 10) {
          $nosection10 = ceil( $num_sophomore / 25 );
          $chkbox10 = "checked='checked'";
        }
        if ($selected == 11) {
          $nosection11 = ceil( $num_junior / 25 );
          $chkbox11 = "checked='checked'";
        }
        if ($selected == 12) {
          $nosection12 = ceil( $num_senior / 25 );
          $chkbox12 = "checked='checked'";
        }
      }
      $message = "Generated sections. See below for result.";
    } 
  }

  if (isset($_POST['propose'])) {
    #make checkbox selected to find out which to insert
    $checkboxes = isset($_POST['check_list']) ? $_POST['check_list'] : array();
    if(!empty($checkboxes)) {
      foreach ($checkboxes as $selected) {

        if ( $selected == 1 ) {
          $num_grade0 = $num_grade1;
        } elseif ( $selected == 2 ) {
        $num_grade0 = $num_grade2;
        } elseif ( $selected == 3 ) {
        $num_grade0 = $num_grade3;
        } elseif ( $selected == 4 ) {
        $num_grade0 = $num_grade4;
        } elseif ( $selected == 5 ) {
        $num_grade0 = $num_grade5;
        } elseif ( $selected == 6 ) {
        $num_grade0 = $num_grade6;
        } elseif ( $selected == 7 ) {
        $num_grade0 = $num_grade7;
        } elseif ( $selected == 8 ) {
        $num_grade0 = $num_grade8;
        } elseif ( $selected == 9 ) {
        $num_grade0 = $num_freshman;
        } elseif ( $selected == 10 ) {
        $num_grade0 = $num_sophomore;
        } elseif ( $selected == 11 ) {
        $num_grade0 = $num_junior;
        } elseif ( $selected == 12 ) {
        $num_grade0 = $num_senior;
        } 

      $numsection = 1;
      $countsection = ceil( $num_grade0 / 25 );
      $count = 0;

      for ( $i = 0; $i < $countsection; $i++ ) {

      $sql_insert = "INSERT INTO section ( LevelID, SectionName, DateCreated, SectionStatus ) VALUES ( $selected, '$numsection', NOW(), 'Pending')";
        $con->query($sql_insert) or die(mysqli_error($con));
        $numsection++; 
        echo "Inserted";
      }
      $message = "Sections submitted for approval.";
    }
  }
  }
?>

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
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
        <small>Manage sections</small>
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
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Section creation</h3>
              </div>
              <form method="POST">
                <div class="row-label">
                <div class="col-md-6">
                  <div class="box-header with-border">
                  <label>Check year level to generate section. </label>
                  <button name="generate" type="submit" class="btn btn-info">Generate</button>
                  <button name="propose" type="submit" class="btn btn-success">Submit</button>
                  <?php echo $message ?>
                </div>
            </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-hover text-center">
                    <tr>
                      <th style="width: 10px"><input type="checkbox" name="chk_boxall"></th>
                      <th style="width: 200px">Year Level</th>
                      <th style="width: 200px">Number of enrollees</th>
                      <th style="width: 200px">Number of created sections</th>
                      <th></th>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="12" <?php if(isset($_POST['generate'])) echo $chkbox12; ?> /></td>
                      <td>Senior</td>
                      <td><?php echo $num_senior ?></td>
                      <td><?php echo $nosection12 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="11" <?php if(isset($_POST['generate'])) echo $chkbox11; ?> /></td>
                      <td>Junior</td>
                      <td><?php echo $num_junior ?></td>
                      <td><?php echo $nosection11 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="10" <?php if(isset($_POST['generate'])) echo $chkbox10; ?> /></td>
                      <td>Sophomore</td>
                      <td><?php echo $num_sophomore ?></td>
                      <td><?php echo $nosection10 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="9" <?php if(isset($_POST['generate'])) echo $chkbox9; ?> /></td>
                      <td>Freshman</td>
                      <td><?php echo $num_freshman ?></td>
                      <td><?php echo $nosection9 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="8" <?php if(isset($_POST['generate'])) echo $chkbox8; ?> /></td>
                      <td>Grade 8</td>
                      <td><?php echo $num_grade8 ?></td>
                      <td><?php echo $nosection8 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="7" <?php if(isset($_POST['generate'])) echo $chkbox7; ?> /></td>
                      <td>Grade 7</td>
                      <td><?php echo $num_grade7 ?></td>
                      <td><?php echo $nosection7 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="6" <?php if(isset($_POST['generate'])) echo $chkbox6; ?> /></td>
                      <td>Grade 6</td>
                      <td><?php echo $num_grade6 ?></td>
                      <td><?php echo $nosection6 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="5" <?php if(isset($_POST['generate'])) echo $chkbox5; ?> /></td>
                      <td>Grade 5</td>
                      <td><?php echo $num_grade5 ?></td>
                      <td><?php echo $nosection5 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="4" <?php if(isset($_POST['generate'])) echo $chkbox4; ?> /></td>
                      <td>Grade 4</td>
                      <td><?php echo $num_grade4 ?></td>
                      <td><?php echo $nosection4 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="3" <?php if(isset($_POST['generate'])) echo $chkbox3; ?> /></td>
                      <td>Grade 3</td>
                      <td><?php echo $num_grade3 ?></td>
                      <td><?php echo $nosection3 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="2" <?php if(isset($_POST['generate'])) echo $chkbox2; ?> /></td>
                      <td>Grade 2</td>
                      <td><?php echo $num_grade2 ?></td>
                      <td><?php echo $nosection2 ?></td>
                    </tr>
                    <tr>
                      <td><input type="checkbox" name="check_list[]" value="1" <?php if(isset($_POST['generate'])) echo $chkbox1; ?> /></td>
                      <td>Grade 1</td>
                      <td><?php echo $num_grade1 ?></td>
                      <td><?php echo $nosection1 ?></td>
                    </tr>
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  <button onclick="history.go(-1);">Back </button>
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
              </div>
            </form>
          </div>
        </div>  
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../../includes/footer.php');
?>