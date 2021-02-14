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


          $sql_getsy = "SELECT gr.SchoolYearID, gr.StudentID, sy.SchoolYearStart, sy.SchoolYearEnd, gr.LevelID, l.LevelName, gr.SubjectID, sub.SubjectName, gr.pr1, gr.pr2, gr.pr3, gr.pr4, gr.pfr 
          FROM graderec gr 
          INNER JOIN level l 
          ON gr.LevelID = l.LevelID
          INNER JOIN schoolyear sy 
          ON gr.SchoolYearID = sy.SchoolYearID
          INNER JOIN subject sub 
          ON gr.SubjectID = sub.SubjectID
          WHERE gr.LevelID =  1 AND gr.StudentID = $sid";
          $result_getsy = $con->query($sql_getsy) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_getsy))
          {
            $syid = $row['SchoolYearID'];
            $sys = $row['SchoolYearStart'];
            $sye = $row['SchoolYearEnd'];
            $level = $row['LevelName'];
          }

          $sql_selectavg = "SELECT Grade FROM gradeaverage WHERE SchoolYearID = $syid AND StudentID = $sid";
          $result_selectavg = $con->query($sql_selectavg) or die(mysqli_error($con));
          while($row = mysqli_fetch_array($result_selectavg))
          {
            $avg = $row['Grade'];
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
                      <input type="text" class="form-control" value='<?php echo $avg ?>' >
                  </div>
                </div>
               <div class="form-group">
                  <label class="col-sm-2 control-label">Year level</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" value='<?php echo $level ?>' >   
                  </div>
                  <a href='updategrade1.php?id=<?php echo $sid ?>' class='btn btn-md btn-primary'>
                      Update
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
                      <?php

                        while ($row = mysqli_fetch_array($result_selectall))
                        {
                          $subname = $row['SubjectName'];
                          $g1 = $row['pr1'];
                          $g2 = $row['pr2'];
                          $g3 = $row['pr3'];
                          $g4 = $row['pr4'];
                          $gfr = $row['pfr']; 

                          echo "
                            <tr>
                              <td>$subname</td>
                              <td>$g1</td>
                              <td>$g2</td>
                              <td>$g3</td>
                              <td>$g4</td>
                              <td>$gfr</td>
                            </tr>
                          ";
                        }

                      ?>
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
