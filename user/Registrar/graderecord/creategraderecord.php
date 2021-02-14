<?php 
  $page_title="Sto. Nino Formation and Science ";
  include_once('../../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateRegistrar();
   # checks if record is selected
    if (isset($_REQUEST['id']))
    {
        # checks if selected record is an ID value
        if (ctype_digit($_REQUEST['id']))
        {
          $sid = $_REQUEST['id'];
          # list of school year
          $sql_level = "SELECT SchoolYearStart, SchoolYearEnd, SchoolYearID FROM schoolyear ORDER BY SchoolYearEnd DESC";
          $result_level =$con->query($sql_level);

          $list_sy = "";
          while($row = mysqli_fetch_array($result_level))
          {
              $syid= $row['SchoolYearID'];
              $sys= $row['SchoolYearStart'];
              $sye= $row['SchoolYearEnd'];
              $list_sy .="<option value='$syid'>$sys - $sye</option>";
          }

          # list of level
          $sql_level = "SELECT LevelName, LevelID FROM level ORDER BY LevelID DESC";
          $result_level =$con->query($sql_level);

          $list_level = "";
          while($row = mysqli_fetch_array($result_level))
          {
              $LevelID= $row['LevelID'];
              $LevelName= $row['LevelName'];
              $list_level .="<option value='$LevelID'>$LevelName</option>";
          }

          $sql_getstudentname = "SELECT FirstName, MiddleName, LastName FROM students WHERE StudentID = $sid";
          $result_getstudentname = $con->query($sql_getstudentname) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_getstudentname))
          {
              $sfn = $row['FirstName'];
              $smn = $row['MiddleName'];
              $sln = $row['LastName'];
          }

          # list of gradetype
          $sql_pr1 = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = '1st Grading'";
          $result_pr1 = $con->query($sql_pr1) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_pr1))
          {
              $idpr1 = $row['GradeTypeID'];
          }
          $sql_pr2 = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = '2nd Grading'";
          $result_pr2 = $con->query($sql_pr2) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_pr2))
          {
              $idpr2 = $row['GradeTypeID'];
          }
          $sql_pr3 = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = '3rd Grading'";
          $result_pr3 = $con->query($sql_pr3) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_pr3))
          {
              $idpr3 = $row['GradeTypeID'];
          }
          $sql_pr4 = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = '4th Grading'";
          $result_pr4 = $con->query($sql_pr4) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_pr4))
          {
              $idpr4 = $row['GradeTypeID'];
          }
          $sql_fg = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = 'Final Grade'";
          $result_fg = $con->query($sql_fg) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_fg))
          {
              $idfg = $row['GradeTypeID'];
          }
          $sql_avg = "SELECT GradeTypeID FROM gradetype WHERE GradeTypeName = 'Average Grade'";
          $result_avg= $con->query($sql_avg) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_avg))
          {
              $idavg = $row['GradeTypeID'];
          }

          # select subjects
          $sql_filipino = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Filipino'";
          $result_filipino = $con->query($sql_filipino) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_filipino))
          {
              $filipinosubid = $row['SubjectID'];
              $filipinosub = $row['SubjectName'];
          }
          $sql_english = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'English'";
          $result_english = $con->query($sql_english) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_english))
          {
              $englishsubid = $row['SubjectID'];
              $englishsub = $row['SubjectName'];
          }
          $sql_science = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Science'";
          $result_science = $con->query($sql_science) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_science))
          {
              $sciencesubid = $row['SubjectID'];
              $sciencesub = $row['SubjectName'];
          }
          $sql_math = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Mathematics'";
          $result_math = $con->query($sql_math) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_math))
          {
              $mathsubid = $row['SubjectID'];
              $mathsub = $row['SubjectName'];
          }
          $sql_ap = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Araling Panlipunan'";
          $result_ap = $con->query($sql_ap) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_ap))
          {
              $apsubid = $row['SubjectID'];
              $apsub = $row['SubjectName'];
          }
          $sql_esp = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Edukasyon sa Pagpapakatao'";
          $result_esp = $con->query($sql_esp) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_esp))
          {
              $espsubid = $row['SubjectID'];
              $espsub = $row['SubjectName'];
          }
          $sql_tle = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'Technology and Livelihood Education'";
          $result_tle = $con->query($sql_tle) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_tle))
          {
              $tlesubid = $row['SubjectID'];
              $tlesub = $row['SubjectName'];
          }
          $sql_mapeh = "SELECT SubjectID, SubjectName FROM subject WHERE SubjectName = 'MAPEH'";
          $result_mapeh = $con->query($sql_mapeh) or die(mysqli_error($con));
          while ($row = mysqli_fetch_array($result_mapeh))
          {
              $mapehsubid = $row['SubjectID'];
              $mapehsub = $row['SubjectName'];
          }

          $message = "";

          if ( isset($_POST['set'])) 
          {

            $sy = mysqli_real_escape_string($con, $_POST['schoolyear']);
            $yl = mysqli_real_escape_string($con, $_POST['yearlevel']);
            $avgfra = mysqli_real_escape_string($con, $_POST['fra']);

            $s1g1 = mysqli_real_escape_string($con, $_POST['s1g1']);
            $s1g2 = mysqli_real_escape_string($con, $_POST['s1g2']);
            $s1g3 = mysqli_real_escape_string($con, $_POST['s1g3']);
            $s1g4 = mysqli_real_escape_string($con, $_POST['s1g4']);
            $s1gf = mysqli_real_escape_string($con, $_POST['s1gf']);
            //$s1r = mysqli_real_escape_string($con, $_POST['s1remark']);

            $s2g1 = mysqli_real_escape_string($con, $_POST['s2g1']);
            $s2g2 = mysqli_real_escape_string($con, $_POST['s2g2']);
            $s2g3 = mysqli_real_escape_string($con, $_POST['s2g3']);
            $s2g4 = mysqli_real_escape_string($con, $_POST['s2g4']);
            $s2gf = mysqli_real_escape_string($con, $_POST['s2gf']);
            //$s2r = mysqli_real_escape_string($con, $_POST['s2remark']);

            $s3g1 = mysqli_real_escape_string($con, $_POST['s3g1']);
            $s3g2 = mysqli_real_escape_string($con, $_POST['s3g2']);
            $s3g3 = mysqli_real_escape_string($con, $_POST['s3g3']);
            $s3g4 = mysqli_real_escape_string($con, $_POST['s3g4']);
            $s3gf = mysqli_real_escape_string($con, $_POST['s3gf']);
            //$s3gr = mysqli_real_escape_string($con, $_POST['s3remark']);

            $s4g1 = mysqli_real_escape_string($con, $_POST['s4g1']);
            $s4g2 = mysqli_real_escape_string($con, $_POST['s4g2']);
            $s4g3 = mysqli_real_escape_string($con, $_POST['s4g3']);
            $s4g4 = mysqli_real_escape_string($con, $_POST['s4g4']);
            $s4gf = mysqli_real_escape_string($con, $_POST['s4gf']);
            //$s4r = mysqli_real_escape_string($con, $_POST['s4remark']);

            $s5g1 = mysqli_real_escape_string($con, $_POST['s5g1']);
            $s5g2 = mysqli_real_escape_string($con, $_POST['s5g2']);
            $s5g3 = mysqli_real_escape_string($con, $_POST['s5g3']);
            $s5g4 = mysqli_real_escape_string($con, $_POST['s5g4']);
            $s5gf = mysqli_real_escape_string($con, $_POST['s5gf']);
            //$s5r = mysqli_real_escape_string($con, $_POST['s5remark']);

            $s6g1 = mysqli_real_escape_string($con, $_POST['s6g1']);
            $s6g2 = mysqli_real_escape_string($con, $_POST['s6g2']);
            $s6g3 = mysqli_real_escape_string($con, $_POST['s6g3']);
            $s6g4 = mysqli_real_escape_string($con, $_POST['s6g4']);
            $s6gf = mysqli_real_escape_string($con, $_POST['s6gf']);
            //$s6r = mysqli_real_escape_string($con, $_POST['s6remark']);

            $s7g1 = mysqli_real_escape_string($con, $_POST['s7g1']);
            $s7g2 = mysqli_real_escape_string($con, $_POST['s7g2']);
            $s7g3 = mysqli_real_escape_string($con, $_POST['s7g3']);
            $s7g4 = mysqli_real_escape_string($con, $_POST['s7g4']);
            $s7gf = mysqli_real_escape_string($con, $_POST['s7gf']);
            //$s7r = mysqli_real_escape_string($con, $_POST['s7remark']);

            $s8g1 = mysqli_real_escape_string($con, $_POST['s8g1']);
            $s8g2 = mysqli_real_escape_string($con, $_POST['s8g2']);
            $s8g3 = mysqli_real_escape_string($con, $_POST['s8g3']);
            $s8g4 = mysqli_real_escape_string($con, $_POST['s8g4']);
            $s8gf = mysqli_real_escape_string($con, $_POST['s8gf']);
            //$s8r = mysqli_real_escape_string($con, $_POST['s8remark']);

            $sql_subject1 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $filipinosubid, '$s1g1', '$s1g2', '$s1g3', '$s1g4', '$s1gf' )";

            $sql_subject2 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $englishsubid, '$s2g1', '$s2g2', '$s2g3', '$s2g4', '$s2gf' )";
            $sql_subject3 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $sciencesubid, '$s3g1', '$s3g2', '$s3g3', '$s3g4', '$s3gf' )";
            $sql_subject4 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $mathsubid, '$s4g1', '$s4g2', '$s4g3', '$s4g4', '$s4gf' )";
            $sql_subject5 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $apsubid, '$s5g1', '$s5g2', '$s5g3', '$s5g4', '$s5gf' )";
            $sql_subject6 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $espsubid, '$s6g1', '$s6g2', '$s6g3', '$s6g4', '$s6gf' )";
            $sql_subject7 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $tlesubid, '$s7g1', '$s7g2', '$s7g3', '$s7g4', '$s7gf' )";
            $sql_subject8 = "INSERT INTO graderec ( StudentID, SchoolYearID, LevelID, SubjectID, pr1, pr2, pr3, pr4, pfr  ) 
            VALUES ( $sid, $sy, $yl, $mapehsubid, '$s8g1', '$s8g2', '$s8g3', '$s8g4', '$s8gf' )"; 

            $sql_fra = "INSERT INTO gradeaverage ( SchoolYearID, StudentID, GradeTypeID, Grade  ) VALUES ( $syid, $sid, $idavg, '$avgfra' )";

            $sql_checkduplicate = "SELECT * FROM graderec WHERE StudentID = $sid AND SchoolYearID = $sy AND LevelID = $yl";
            $result_check = $con->query($sql_checkduplicate) or die(mysqli_error($con));

              if ( mysqli_num_rows($result_check) > 0) 
              {
                $message = "There is already an existing record for this.";
              }
              else 
              {
                $con->query($sql_fra) or die(mysqli_error($con)); 
                $con->query($sql_subject1) or die(mysqli_error($con));
                $con->query($sql_subject2) or die(mysqli_error($con));
                $con->query($sql_subject3) or die(mysqli_error($con));
                $con->query($sql_subject4) or die(mysqli_error($con));
                $con->query($sql_subject5) or die(mysqli_error($con));
                $con->query($sql_subject6) or die(mysqli_error($con));
                $con->query($sql_subject7) or die(mysqli_error($con));
                $con->query($sql_subject8) or die(mysqli_error($con)); 
                $message = "Successfully created grade record";
              } 
            } 

            if ( isset ($_POST['back']))
            {
              header('location: studentrecordmain.php');
            }
        }
   } 


?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Enrollment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="enrollmentsearch.php"><i class="fa fa-circle-o"></i> Process enrollment</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Student Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="encodefeature.php"><i class="fa fa-circle-o"></i>Manage encode feature</a></li>
                <li><a href="studentrecordmain.php"><i class="fa fa-circle-o"></i>Manage student record</a></li>
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
        Manage student record
        <small>student record</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="#">Student record</a></li>
        <li class="active">Manage student record</li>
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
              <h3 class="box-title">Student grade record</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" class="form-horizontal">
            <div class="box-body"> 
              <div class="form-group">
                  <label class="col-sm-2 control-label">School Year</label>
                  <div class="col-sm-2">
                    <select name="schoolyear"  class="form-control" required>
                      <?php echo $list_sy ?>
                    </select>     
                  </div>
                  <label class="col-sm-4 control-label">Final Rating Average</label>
                  <div class="col-sm-2">
                      <input type="text" name="fra"  class="form-control" value=''/>
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Year level</label>
                  <div class="col-sm-2">
                    <select name="yearlevel"  class="form-control" required>
                      <?php echo $list_level ?>
                    </select>     
                  </div>
                  <button name="set" type="submit" class="btn btn-primary">
                    Create
                  </button>
                  <button name="back" type="submit" class="btn btn-default">
                    Back
                  </button>
                  <label><?php echo $message ?></label>
                </div>
                 <div class="form-group">
                  <label class="col-sm-2 control-label">Full name</label>
                  <div class="col-sm-2">
                      <label class="col-sm-9 control-label"><?php echo $sln . ", " . $sfn . " " . $smn ?></label>   
                  </div>
                </div>
             <table id="graderec" class="table table-bordered table-striped">
                <thead>
                  <th>SUBJECT</th>
                  <th>1st Grading</th>
                  <th>2nd Grading</th>
                  <th>3rd Grading</th>
                  <th>4th Grading</th>
                  <th>FINAL RATING</th>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $filipinosub ?></td>
                    <td><input type="number" name="s1g1"  class="form-control" ></td>
                    <td><input type="number" name="s1g2"  class="form-control" ></td>
                    <td><input type="number" name="s1g3"  class="form-control" ></td>
                    <td><input type="number" name="s1g4"  class="form-control" ></td>
                    <td><input type="number" name="s1gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $englishsub ?></td>
                    <td><input type="number" name="s2g1"  class="form-control" ></td>
                    <td><input type="number" name="s2g2"  class="form-control" ></td>
                    <td><input type="number" name="s2g3"  class="form-control" ></td>
                    <td><input type="number" name="s2g4"  class="form-control" ></td>
                    <td><input type="number" name="s2gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $sciencesub ?></td>
                    <td><input type="number" name="s3g1"  class="form-control" ></td>
                    <td><input type="number" name="s3g2"  class="form-control" ></td>
                    <td><input type="number" name="s3g3"  class="form-control" ></td>
                    <td><input type="number" name="s3g4"  class="form-control" ></td>
                    <td><input type="number" name="s3gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $mathsub ?></td>
                    <td><input type="number" name="s4g1"  class="form-control" ></td>
                    <td><input type="number" name="s4g2"  class="form-control" ></td>
                    <td><input type="number" name="s4g3"  class="form-control" ></td>
                    <td><input type="number" name="s4g4"  class="form-control" ></td>
                    <td><input type="number" name="s4gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $apsub ?></td>
                    <td><input type="number" name="s5g1"  class="form-control" ></td>
                    <td><input type="number" name="s5g2"  class="form-control" ></td>
                    <td><input type="number" name="s5g3"  class="form-control" ></td>
                    <td><input type="number" name="s5g4"  class="form-control" ></td>
                    <td><input type="number" name="s5gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $espsub ?></td>
                    <td><input type="number" name="s6g1"  class="form-control" ></td>
                    <td><input type="number" name="s6g2"  class="form-control" ></td>
                    <td><input type="number" name="s6g3"  class="form-control" ></td>
                    <td><input type="number" name="s6g4"  class="form-control" ></td>
                    <td><input type="number" name="s6gf"  class="form-control" ></td>
  
                  </tr>
                  <tr>
                    <td><?php echo $tlesub ?></td>
                    <td><input type="number" name="s7g1"  class="form-control" ></td>
                    <td><input type="number" name="s7g2"  class="form-control" ></td>
                    <td><input type="number" name="s7g3"  class="form-control" ></td>
                    <td><input type="number" name="s7g4"  class="form-control" ></td>
                    <td><input type="number" name="s7gf"  class="form-control" ></td>
                  </tr>
                  <tr>
                    <td><?php echo $mapehsub ?></td>
                    <td><input type="number" name="s8g1"  class="form-control" ></td>
                    <td><input type="number" name="s8g2"  class="form-control" ></td>
                    <td><input type="number" name="s8g3"  class="form-control" ></td>
                    <td><input type="number" name="s8g4"  class="form-control" ></td>
                    <td><input type="number" name="s8gf"  class="form-control" ></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
          </div>



        </div>
      </div>
    </section>

<?php
    include_once('../../../includes/footer.php');
?>
