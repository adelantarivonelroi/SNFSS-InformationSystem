<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validatePrincipal();

  # displays list of users
  $sql_pendingfl = "SELECT fl.FacultyListID, fl.LevelID, fl.DateCreated, fl.Status, s.SectionName, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, sub.SubjectName, u.FirstName, u.MiddleName, u.LastName, ts.TimeForm, fl.DateApproved
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

  WHERE fl.Status = 'Pending'";
  $result_pendingfl = $con->query($sql_pendingfl);

  if(isset($_POST['back'])) {
    header('location:index.php');
  }

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
        Approvals
        <small>manage approvals</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Approvals</a></li>
        <li class="active">Manage approvals</li>
      </ol>
    </section>

    <!-- Main content -->
    <form method="post">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Pending faculty list approval</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <table id="example3" class="text-center table table-bordered table-striped">
                  <thead>
                    <th>Faculty List ID</th>
                    <th>School Year</th>
                    <th>Level</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>Faculty</th>
                    <th>Date Submitted</th>
                    <th>Date Approved</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                  </thead>
                  <tbody>
                    <?php
                      while ($row = mysqli_fetch_array($result_pendingfl))
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
                          $da = $row['DateApproved'];
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
                            <td>$da</td>
                            <td>$stat</td>
                            <td>
                            <a href='pfacultylistapprove.php?id=$flid' class='btn btn-xs btn-success'>
                              Approve
                            </a>
                          </td>
                          <td>
                            <a href='pfacultylistdisapprove.php?id=$flid' class='btn btn-xs btn-danger'>
                              Disapprove
                            </a>
                          </td>
                          </tr>
                        ";
                      }

                    ?>
                  </tbody>
                </table>
              </div>
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