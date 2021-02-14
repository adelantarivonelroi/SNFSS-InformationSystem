<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validatePrincipal();
  # displays list of users
  $sql_result = "SELECT *
  FROM section WHERE sectionStatus = 'Approved'";
  $result_sql = $con->query($sql_result) or die(mysqli_error($con));

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
    ON fl.TimeSlotID = ts.TimeSlotID
    WHERE fl.Status = 'Approved'";

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
    ON s.StudentID = ga.StudentID

    WHERE sl.Status = 'Approved'"; 

  $result_slhistory = $con->query($sql_slhistory) or die(mysqli_error($con));

?>

     <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Approvals</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="approvedsections.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Sections</span></a></li>
            <li><a href="approvedfacultylist.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Faculty List</span></a></li>
            <li><a href="approvedstudentlist.php"><i class="fa fa-circle-o text-red"></i> <span>Approved Student List</span></a></li>
            <li class="header">Pending</li>
            <li><a href="psections.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Sections</span></a></li>
            <li><a href="pfacultylist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Faculty List(s)</span></a></li>
            <li><a href="pclasslist.php"><i class="fa fa-circle-o text-red"></i> <span>Pending Class List(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View Activity Logs</span></a></li>
          </ul>
          </section>
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Approved Sections
      </h1>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List of Approved Sections</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="text-center table table-bordered table-striped">
                <thead>
                  <th>Section ID</th>
                  <th>Level Name</th>
                  <th>Section Number</th>
                  <th>Date Created</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_sql))
                    {
                      $sid = $row['SectionID'];
                      $lid = $row['LevelID'];
                      $sn = $row['SectionName'];
                      $stat = $row['SectionStatus'];
                      $dc = $row['DateCreated'];


                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$lid</td>
                          <td>$sn</td>
                          <td>$dc</td>
                          <td>$stat</td>
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
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>