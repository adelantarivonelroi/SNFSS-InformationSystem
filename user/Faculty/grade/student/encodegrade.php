<?php 

  if (isset($_REQUEST['id']))
    {
      # checks if selected record is an ID value
      if (ctype_digit($_REQUEST['id']))
      {
        $id = $_REQUEST['id'];
      	$page_title="Sto. Nino Formation and Science ";
          include_once('../../../../includes/header.php');
          //include ('../../config.php');

        validateAccess();
        validateFaculty();

        #get subject section
        $sql_getsections = "SELECT DISTINCT s.SectionID, s.SectionName, l.LevelID, sy.SchoolYearStart, sy.SchoolYearEnd, s.SectionID, u.FirstName, u.MiddleName, u.LastName, su.SubjectID, su.SubjectName FROM facultylist fl 
        INNER JOIN schoolyear sy 
        ON fl.SchoolYearID = sy.SchoolYearID
        INNER JOIN level l 
        ON fl.LevelID = l.LevelID
        INNER JOIN section s 
        ON fl.SectionID = s.SectionID
        INNER JOIN teacher t 
        ON fl.TeacherID = t.TeacherID 
        INNER JOIN subject su 
        ON t.SubjectID = su.SubjectID
        INNER JOIN user u 
        ON t.UserID = u.UserID
        WHERE t.UserID = $uid AND fl.Status = 'Approved'";

        $result_getsections = $con->query($sql_getsections) or die(mysqli_query($con));
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
          $subjectid = $row['SubjectID'];
          $subjectname = $row['SubjectName'];
        }

        #student
        $sql_getstudent = "SELECT sl.StudentListID, s.FirstName, s.MiddleName, s.LastName FROM studentlist sl 
        INNER JOIN section sec 
        ON sl.SectionID = sec.SectionID
        INNER JOIN students s
        ON sl.StudentID = s.StudentID
        INNER JOIN enrollment e
        ON s.StudentID = e.StudentID
        WHERE e.EnrollmentStatus = 'Enrolled' AND sl.SectionID = $id AND sl.Status = 'Approved'";

        $liststudents = "";
        $result_getstudents = $con->query($sql_getstudent) or die(mysqli_query($con));
        while ( $row = mysqli_fetch_array($result_getstudents)) 
        {
          $slid = $row['StudentListID'];
          $sfn = $row['FirstName'];
          $smn = $row['MiddleName'];
          $sln = $row['LastName'];;

          $liststudents .= "
            <tr>
              <td>$sln, $sfn $smn</td>
              <th><input type='number' name='text_box[]'/></td>
            </tr>
          ";
        }

        $sql_getgradestatus = "SELECT GradeStatusID FROM gradestatus ORDER BY GradeStatusID DESC LIMIT 1";
        $result_getgradestatus = $con->query($sql_getgradestatus) or die(mysqli_query($con));
        while ( $row = mysqli_fetch_array($result_getgradestatus)) 
        {
          $gsid = $row['GradeStatusID'];
        }

        if (isset($_POST['encode'])) 
        {
          $txtboxes = isset($_POST['text_box']) ? $_POST['text_box'] : array();
           if(!empty($txtboxes)) {
              foreach ($txtboxes as $inputgrade) {
                   $sql_addgrade = "INSERT INTO grade ( StudentListID, SubjectID, GradeStatusID, Grade ) VALUES ( $slid, $subjectid, $gsid, $inputgrade )";
                   $con->query($sql_addgrade) or die(mysqli_error($con));
              }
              header('location: encodesuccess.php');
          } 
        }
      }else
    {
      header('location: viewsections.php');
    }
  }else
  {
    header('location: viewsections.php');
  }

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">

            <li class="header">Index</li>
            <li><a href="../../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Enrollment</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Grade Entrance Exam</span></a></li>
            <li class="header">Faculty Record</li>
            <li><a href="../../viewschedule.php"><i class="fa fa-circle-o text-red"></i> <span>View Schedule</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="../../encodeindex.php"><i class="fa fa-circle-o text-red"></i> <span>Encode Grade</span></a></li>

          </ul>
          </section>
          <!-- /.sidebar -->
        </aside> 
  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>department head</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <h3 class="box-title">Home</h3>
              </div>

              <div class=box-body>
                        <div class="col-sm-7">
                          <div class="form-group">
                            <p class="control-label col-sm-2">Faculty name</p>
                            <div class="col-sm-8">
                              <label class="control-label col-sm-8"><?php echo "$fln, $ffn $fmn ( $subjectname )" ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <div class="form-group">
                            <p class="control-label col-sm-2">School Year</p>
                            <div class="col-sm-8">
                              <label class="control-label col-sm-4"><?php echo $systart . ' - ' . $syend ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <div class="form-group">
                            <p class="control-label col-sm-2">Year Level</p>
                            <div class="col-sm-3">
                              <label class="control-label col-sm-4"><?php echo $level ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <div class="form-group">
                            <p class="control-label col-sm-2">Section</p>
                            <div class="col-sm-3">
                              <label class="control-label col-sm-4"><?php echo "$level - $section" ?></label>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-7">
                          <div class="form-group">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-3">
                              <button name="encode" type="submit" class="btn btn-success">Submit</button>
                            </div>
                          </div>
                        </div>
                    </div>

              <!-- /.box-header -->
              <div class="box-body">
               <table id="example1" class="text-center table table-bordered table-striped">
                  <thead>
                      <th>Student Name</th>
                      <th>Grade</th>
                    </thead>
                     <tbody>
                      <?php
                        echo $liststudents;
                      ?>
                  </tbody>
                </table>
              </div>

              
            </div>
            </div>
          </div>
        </div>
      </section>
    </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../../../includes/footer.php');
?>