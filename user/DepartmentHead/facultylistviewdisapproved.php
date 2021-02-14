<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $sql_disapprovedfacultylist = "SELECT fl.FacultyListID, fl.LevelID, fl.DateCreated, fl.Status, s.SectionName, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, sub.SubjectName, u.FirstName, u.MiddleName, u.LastName, ts.TimeForm
  FROM facultylist fl
  INNER JOIN schoolyear sy
  ON fl.SchoolYearID = sy.SchoolYearID 
  INNER JOIN level l 
  ON fl.LevelID = l.LevelID 
  INNER JOIN section s
  ON fl.SectionID = s.SectionID
  INNER JOIN teacher t
  ON fl.TeacherID = t.TeacherID
  INNER JOIN timeslot ts
  ON fl.TimeSlotID = ts.TimeSlotID
  INNER JOIN subject sub
  ON t.SubjectID = sub.SubjectID
  INNER JOIN user u
  ON t.UserID = u.UserID

  WHERE fl.Status = 'Disapproved'";

  $result_disapprovedfacultylist = $con->query($sql_disapprovedfacultylist) or die(mysqli_error($con));

  if (isset($_POST['back']))
  {
    header('location: facultylisthome.php');
  }
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Index</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Faculty list</li>
            <li><a href="facultylisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Faculty list</span></a></li>
            <li class="header">Student list</li>
            <li><a href="studentlisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student list</span></a></li>
            <li class="header">Sections</li>
            <li><a href="sectionhome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Sections</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="studentrecordsearch.php"><i class="fa fa-circle-o text-red"></i> <span>View Student Record</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside> 
                

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Faculty Lists
        <small>Manage faculty lists</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">faculty list</a></li>
        <li class="active">Manage faculty lists</li>
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
              <h3 class="box-title">View disapproved faculty list proposals</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="table table-bordered table-striped">
                <thead>
                  <th>Faculty List ID</th>
                  <th>School Year</th>
                  <th>Level</th>
                  <th>Section</th>
                  <th>Subject</th>
                  <th>Faculty</th>
                  <th>Date Submitted</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_disapprovedfacultylist))
                    {
                      $flid = $row['FacultyListID'];
                      $sys = $row['SchoolYearStart'];
                      $sye = $row['SchoolYearEnd'];
                      $lid = $row['LevelID'];
                      $ln = $row['LevelName'];
                      $sn = $row['SectionName'];
                      $subname = $row['SubjectName'];
                      $tfn = $row['FirstName'];
                      $tmn = $row['MiddleName'];
                      $tln = $row['LastName'];
                      $tf = $row['TimeForm'];
                      $dc = $row['DateCreated'];
                      $stat = $row['Status'];



                      echo "
                        <tr>
                          <td>$flid</td>
                          <td>$sys - $sye</td>
                          <td>$ln</td>
                          <td>$lid - $sn</td>
                          <td>$subname</td>
                          <td>$tln, $tfn $tmn</td>
                          <td>$dc</td>
                          <td>$stat</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
            <div class="box-footer text-center">
                  <button name="back" type="submit" class="btn btn-default pull-left">Back</button>
            </div>
            
          </div>



        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>