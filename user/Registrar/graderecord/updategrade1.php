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

          $sql_getstudentname = "SELECT FirstName, MiddleName, LastName FROM students WHERE StudentID = $sid";
          $result_getstudentname = $con->query($sql_getstudentname) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_getstudentname))
          {
              $sfn = $row['FirstName'];
              $smn = $row['MiddleName'];
              $sln = $row['LastName'];
          }

          $message = "";
          $avg = "";
          $sql_selectall = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_selectall = $con->query($sql_selectall) or die(mysqli_error($con));


          $sql_getmisc = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.LevelID =  1 AND gr.StudentID = $sid";
          $getmisc = $con->query($sql_getmisc) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($getmisc))
          {
            $syid = $row['SchoolYearID'];
            $sys = $row['SchoolYearStart'];
            $sye = $row['SchoolYearEnd'];
            $level = $row['LevelName'];
          }

          #subject1
          $sql_subject1 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 4 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject1 = $con->query($sql_subject1) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject1))
          {
            $asubname = $row['SubjectName'];
            $ag1 = $row['pr1'];
            $ag2 = $row['pr2'];
            $ag3 = $row['pr3'];
            $ag4 = $row['pr4'];
            $agfr = $row['pfr']; 
          }

          #subject2
          $sql_subject2 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 5 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject2 = $con->query($sql_subject2) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject2))
          {
            $bsubname = $row['SubjectName'];
            $bg1 = $row['pr1'];
            $bg2 = $row['pr2'];
            $bg3 = $row['pr3'];
            $bg4 = $row['pr4'];
            $bgfr = $row['pfr']; 
          }

          #subject3
          $sql_subject3 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 6 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject3 = $con->query($sql_subject3) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject3))
          {
            $csubname = $row['SubjectName'];
            $cg1 = $row['pr1'];
            $cg2 = $row['pr2'];
            $cg3 = $row['pr3'];
            $cg4 = $row['pr4'];
            $cgfr = $row['pfr']; 
          }

          #subject4
          $sql_subject4 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 7 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject4= $con->query($sql_subject4) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject4))
          {
            $dsubname = $row['SubjectName'];
            $dg1 = $row['pr1'];
            $dg2 = $row['pr2'];
            $dg3 = $row['pr3'];
            $dg4 = $row['pr4'];
            $dgfr = $row['pfr']; 
          }

          #subject5
          $sql_subject5 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 8 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject5= $con->query($sql_subject5) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject5))
          {
            $esubname = $row['SubjectName'];
            $eg1 = $row['pr1'];
            $eg2 = $row['pr2'];
            $eg3 = $row['pr3'];
            $eg4 = $row['pr4'];
            $egfr = $row['pfr']; 
          }

          #subject6
          $sql_subject6 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 9 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject6= $con->query($sql_subject6) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject6))
          {
            $fsubname = $row['SubjectName'];
            $fg1 = $row['pr1'];
            $fg2 = $row['pr2'];
            $fg3 = $row['pr3'];
            $fg4 = $row['pr4'];
            $fgfr = $row['pfr']; 
          }

          #subject7
          $sql_subject7 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 10 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject7 = $con->query($sql_subject7) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject7))
          {
            $gsubname = $row['SubjectName'];
            $gg1 = $row['pr1'];
            $gg2 = $row['pr2'];
            $gg3 = $row['pr3'];
            $gg4 = $row['pr4'];
            $ggfr = $row['pfr']; 
          }

          #subject8
          $sql_subject8 = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.SubjectID = 11 AND gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_subject8 = $con->query($sql_subject8) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_subject8))
          {
            $hsubname = $row['SubjectName'];
            $hg1 = $row['pr1'];
            $hg2 = $row['pr2'];
            $hg3 = $row['pr3'];
            $hg4 = $row['pr4'];
            $hgfr = $row['pfr']; 
          }

          $sql_selectavg = "SELECT Grade FROM gradeaverage WHERE SchoolYearID = $syid AND StudentID = $sid";
          $result_selectavg = $con->query($sql_selectavg) or die(mysqli_error($con));

          while($row = mysqli_fetch_array($result_selectavg))
          {
            $avg = $row['Grade'];
          }

          if (isset($_POST['save']))
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

            $sql_updatesub1 = "UPDATE graderec 
            SET 
            pr1 = $s1g1,
            pr2 = $s1g2,
            pr3 = $s1g3,
            pr4 = $s1g4,
            pfr = $s1gf
            WHERE SubjectID = 4";

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
                    <input type="text" class="form-control" value='<?php echo $sys . ' - ' .  $sye ?>' >       
                  </div>
                  <label class="col-sm-4 control-label">Final Rating Average</label>
                  <div class="col-sm-2">
                      <input type="text" name="fra" class="form-control" value='<?php echo $avg ?>' >
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Year level</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" value='<?php echo $level ?>' >   
                  </div>
                  <a href='enrollmentviewselected.php?id=$sid' class='btn btn-sm btn-info'>
                      View
                  </a>
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
                 <table id="table2" class="table table-bordered table-striped">
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
                    <td><?php echo $asubname ?></td>
                    <td><input type="number" name="s1g1"  class="form-control" value="<?php echo $ag1 ?>"></td>
                    <td><input type="number" name="s1g2"  class="form-control" value="<?php echo $ag2 ?>"></td>
                    <td><input type="number" name="s1g3"  class="form-control" value="<?php echo $ag3 ?>"></td>
                    <td><input type="number" name="s1g4"  class="form-control" value="<?php echo $ag4 ?>"></td>
                    <td><input type="number" name="s1gf"  class="form-control" value="<?php echo $agfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $bsubname ?></td>
                    <td><input type="number" name="s2g1"  class="form-control" value="<?php echo $bg1 ?>"></td>
                    <td><input type="number" name="s2g2"  class="form-control" value="<?php echo $bg2 ?>"></td>
                    <td><input type="number" name="s2g3"  class="form-control" value="<?php echo $bg3 ?>"></td>
                    <td><input type="number" name="s2g4"  class="form-control" value="<?php echo $bg4 ?>"></td>
                    <td><input type="number" name="s2gf"  class="form-control" value="<?php echo $bgfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $csubname ?></td>
                    <td><input type="number" name="s3g1"  class="form-control" value="<?php echo $cg1 ?>"></td>
                    <td><input type="number" name="s3g2"  class="form-control" value="<?php echo $cg2 ?>"></td>
                    <td><input type="number" name="s3g3"  class="form-control" value="<?php echo $cg3 ?>"></td>
                    <td><input type="number" name="s3g4"  class="form-control" value="<?php echo $cg4 ?>"></td>
                    <td><input type="number" name="s3gf"  class="form-control" value="<?php echo $cgfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $dsubname ?></td>
                    <td><input type="number" name="s4g1"  class="form-control" value="<?php echo $dg1 ?>"></td>
                    <td><input type="number" name="s4g2"  class="form-control" value="<?php echo $dg2 ?>"></td>
                    <td><input type="number" name="s4g3"  class="form-control" value="<?php echo $dg3 ?>"></td>
                    <td><input type="number" name="s4g4"  class="form-control" value="<?php echo $dg4 ?>"></td>
                    <td><input type="number" name="s4gf"  class="form-control" value="<?php echo $dgfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $esubname ?></td>
                    <td><input type="number" name="s5g1"  class="form-control" value="<?php echo $eg1 ?>"></td>
                    <td><input type="number" name="s5g2"  class="form-control" value="<?php echo $eg2 ?>"></td>
                    <td><input type="number" name="s5g3"  class="form-control" value="<?php echo $eg3 ?>"></td>
                    <td><input type="number" name="s5g4"  class="form-control" value="<?php echo $eg4 ?>"></td>
                    <td><input type="number" name="s5gf"  class="form-control" value="<?php echo $egfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $fsubname ?></td>
                    <td><input type="number" name="s6g1"  class="form-control" value="<?php echo $fg1 ?>"></td>
                    <td><input type="number" name="s6g2"  class="form-control" value="<?php echo $fg2 ?>"></td>
                    <td><input type="number" name="s6g3"  class="form-control" value="<?php echo $fg3 ?>"></td>
                    <td><input type="number" name="s6g4"  class="form-control" value="<?php echo $fg4 ?>"></td>
                    <td><input type="number" name="s6gf"  class="form-control" value="<?php echo $fgfr ?>"></td>
  
                  </tr>
                  <tr>
                    <td><?php echo $gsubname ?></td>
                    <td><input type="number" name="s7g1"  class="form-control" value="<?php echo $gg1 ?>"></td>
                    <td><input type="number" name="s7g2"  class="form-control" value="<?php echo $gg2 ?>"></td>
                    <td><input type="number" name="s7g3"  class="form-control" value="<?php echo $gg3 ?>"></td>
                    <td><input type="number" name="s7g4"  class="form-control" value="<?php echo $gg4 ?>"></td>
                    <td><input type="number" name="s7gf"  class="form-control" value="<?php echo $ggfr ?>"></td>
                  </tr>
                  <tr>
                    <td><?php echo $hsubname ?></td>
                    <td><input type="number" name="s8g1"  class="form-control" value="<?php echo $hg1 ?>"></td>
                    <td><input type="number" name="s8g2"  class="form-control" value="<?php echo $hg2 ?>"></td>
                    <td><input type="number" name="s8g3"  class="form-control" value="<?php echo $hg3 ?>"></td>
                    <td><input type="number" name="s8g4"  class="form-control" value="<?php echo $hg4 ?>"></td>
                    <td><input type="number" name="s8gf"  class="form-control" value="<?php echo $hgfr ?>"></td>
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
