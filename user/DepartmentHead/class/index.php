<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();
    # displays list of users
  # displays list of users

   $sql_flhistory = "SELECT fl.FacultyListID, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, s.SectionName, su.SubjectName, ts.TimeForm, u.FirstName, u.MiddleName, u.LastName, fl.Status
    FROM facultylist fl
    INNER JOIN schoolyear sy
    ON fl.SchoolYearID = sy.SchoolYearID
    INNER JOIN level l 
    ON fl.LevelID = l.LevelID
    INNER JOIN section s 
    ON fl.SectionID = s.SectionID
    INNER JOIN teacher t 
    ON fl.TeacherID = t.TeacherID
    INNER JOIN user u
    ON t.UserID = u.UserID
    INNER JOIN subject su
    ON t.SubjectID = su.SubjectID
    INNER JOIN timeslot ts
    ON fl.TimeSlotID = ts.TimeSlotID";

  $result_flhistory = $con->query($sql_flhistory) or die(mysqli_error($con));

   $sql_slhistory = "SELECT sl.StudentListID, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, sec.SectionName, s.FirstName, s.MiddleName, s.LastName, l.LevelName, ga.Grade, s.AssignStatus, sl.Status 
    FROM studentlist sl
    INNER JOIN schoolyear sy
    ON sl.SchoolYearID = sy.SchoolYearID
    INNER JOIN level l 
    ON sl.LevelID = l.LevelID
    INNER JOIN section sec 
    ON sl.SectionID = sec.SectionID
    INNER JOIN students s
    ON sl.StudentID = s.StudentID
    INNER JOIN gradeaverage ga 
    ON s.GradeAverageID = ga.GradeAverageID"; 

  $result_slhistory = $con->query($sql_slhistory) or die(mysqli_error($con));


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
                <li><a href="../section/index.php"><i class="fa fa-circle-o"></i> Manage section</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Assign class</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Manage lists</a></li>
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
        Assign class
        <small>manage list</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">assign class</a></li>
        <li class="active">Manage lists</li>
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
                    <label>Create faculty list.</label>
                  </div>
                  <div class="col-sm-2">
                    <a href="createfl.php">
                      <button type="button" class="btn btn-success">Create</button>
                    </a>
                  </div>
                </div>
                <div class="row2">
                  <div class="col-sm-2">
                    <label>Create student list.</label>
                  </div>
                  <div class="col-sm-2">
                    <a href="createsl.php">
                      <button type="button" class="btn btn-success">Create</button>
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
              <h3 class="box-title">Faculty list history</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="text-center table table-bordered table-striped">
               <thead>
                    <th>Faculty List ID</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Facult name</th>
                    <th>Subject</th>
                    <th>Time</th>
                    <th>Status</th>
                  </thead>
                  <tbody>
                    <?php
                        while ($row = mysqli_fetch_array($result_flhistory))
                        {
                          $hflid = $row['FacultyListID'];
                          $hfsn = $row['SubjectName'];
                          $hffn = $row['FirstName'];
                          $hfmn = $row['MiddleName'];
                          $hfln = $row['LastName'];
                          $hftf = $row['TimeForm'];
                          $hfstat = $row['Status'];
                          $hfsection = $row['SectionName'];
                          $hfsystart = $row['SchoolYearStart'];
                          $hfsyend = $row['SchoolYearEnd'];
                        

                          echo "
                            <tr>
                              <td>$hflid</td>
                              <td>$hfsystart - $hfsyend</td>
                              <td>$hfsection</td>
                              <td>$hfln, $hffn $hfmn</td>
                              <td>$hfsn</td>
                              <td>$hftf</td>
                              <td>$hfstat</td>
                            </tr>
                          ";
                        }
                    ?>
                </tbody>
              </table>
            </div>  
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student list history</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="text-center table table-bordered table-striped">
                <thead>
                    <th>Student List ID</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Student name</th>
                    <th>Average Grade</th>
                    <th>Status</th>

                  </thead>
                   <tbody>
                    <?php
                      while ($row = mysqli_fetch_array($result_slhistory))
                      {
                        $hslid = $row['StudentListID'];
                        $hslfn = $row['FirstName'];
                        $hslmn = $row['MiddleName'];
                        $hslln = $row['LastName'];
                        $hsllvln = $row['LevelName'];
                        $hslgrade = $row['Grade'];
                        $hslsection = $row['SectionName'];
                        $hslsystart = $row['SchoolYearStart'];
                        $hslsyend = $row['SchoolYearEnd'];
                        $hslstat = $row['Status'];

                        echo "
                          <tr>
                            <td>$hslid</td>
                            <td>$hslsystart - $hslsyend</td>
                            <td>$hslsection</td>
                            <td>$hslln, $hslfn $hslmn</td>
                            <td>$hslgrade</td>
                            <td>$hslstat</td>
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
    include_once('../../../includes/footer.php');
?>