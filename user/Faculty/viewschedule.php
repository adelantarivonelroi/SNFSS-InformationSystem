<?php 
    	$page_title="Sto. Nino Formation and Science ";
        include_once('../../includes/header.php');
        //include ('../../config.php');

      validateAccess();
      validateFaculty();

      $sql_schoolyear = "SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC";
      $result_schoolyear = $con->query($sql_schoolyear) or die(mysqli_error($con));
      while ( $row = mysqli_fetch_array($result_schoolyear))
      {
        $defsystart = $row['SchoolYearStart'];
        $defsyed = $row['SchoolYearEnd'];
      }

      $sql_nameuser = "SELECT FirstName, MiddleName, LastName FROM user WHERE UserID = $uid";
      $result_nameuser = $con->query($sql_nameuser) or die(mysqli_error($con));
      while ( $row = mysqli_fetch_array($result_nameuser))
      {
        $ufn = $row['FirstName'];
        $umn = $row['MiddleName'];
        $uln = $row['LastName'];
      }

      $result_schoolyear = $con->query($sql_schoolyear) or die(mysqli_error($con));
      while ( $row = mysqli_fetch_array($result_schoolyear))
      {
        $defsystart = $row['SchoolYearStart'];
        $defsyed = $row['SchoolYearEnd'];
      }

      $sql_getsections = "SELECT s.SectionID, s.SectionName, l.LevelID, sy.SchoolYearStart, sy.SchoolYearEnd, s.SectionID, u.FirstName, u.MiddleName, u.LastName, ts.TimeForm, ts.TimeCode FROM facultylist fl 
      INNER JOIN schoolyear sy 
      ON fl.SchoolYearID = sy.SchoolYearID
      INNER JOIN level l 
      ON fl.LevelID = l.LevelID
      INNER JOIN section s 
      ON fl.SectionID = s.SectionID
      INNER JOIN timeslot ts
      ON fl.TimeSlotID = ts.TimeSlotID
      INNER JOIN teacher t 
      ON fl.TeacherID = t.TeacherID 
      INNER JOIN user u 
      ON t.UserID = u.UserID
      WHERE t.UserID = $uid AND fl.Status = 'Approved' ORDER BY ts.TimeCode ASC";

      $listtime = "";
      $result_getsections = $con->query($sql_getsections) or die(mysqli_query($con));

      if ( mysqli_num_rows($result_getsections) > 0)
      {
        while ( $row = mysqli_fetch_array($result_getsections)) 
        {
          $systart = $row['SchoolYearStart'];
          $syend = $row['SchoolYearEnd'];
          $level = $row['LevelID'];
          $section = $row['SectionName'];
          $sectionid = $row['SectionID'];
          $ffn = $row['FirstName'];
          $fmn = $row['MiddleName'];
          $fln = $row['LastName'];
          $tform = $row['TimeForm'];

          $listtime .= "
            <tr>
              <td>$level - $section</td>
              <td>$tform</td>
            </tr>
          ";
        }      
      }
      else
      {
          $listtime .= "
            <tr>
              <td>No assigned section yet.</td>
              <td>No assigned section yet.</td>
            </tr>
          ";
      }
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">

            <li class="header">Index</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Enrollment</li>
            <li><a href="enrollment/entrance/index.php"><i class="fa fa-circle-o text-red"></i> <span>Grade Entrance Exam</span></a></li>
            <li class="header">Faculty Record</li>
            <li><a href="viewschedule.php"><i class="fa fa-circle-o text-red"></i> <span>View Schedule</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="encodeindex.php"><i class="fa fa-circle-o text-red"></i> <span>Encode Grade</span></a></li>

          </ul>
          </section>
          <!-- /.sidebar -->
        </aside> 
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Schedule
        <small>faculty</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
              <h3 class="box-title">Schedule</h3>
            </div>

            <div class=box-body>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <p class="control-label col-sm-2">Faculty name</p>
                          <div class="col-sm-6">
                            <label class="control-label col-sm-6"><?php echo "$uln, $ufn $umn" ?></label>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-7">
                        <div class="form-group">
                          <p class="control-label col-sm-2">School Year</p>
                          <div class="col-sm-8">
                            <label class="control-label col-sm-4"><?php echo $defsystart . ' - ' . $defsyed ?></label>
                          </div>
                        </div>
                      </div>
                  </div>

            <!-- /.box-header -->
            <div class="box-body">
             <table id="table1" class="text-center table table-bordered table-striped">
                <thead>
                    <th>Section</th>
                    <th>Time</th>
                  </thead>
                   <tbody>
                    <?php
                      echo $listtime;
                    ?>
                </tbody>
              </table>
            </div>

            
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