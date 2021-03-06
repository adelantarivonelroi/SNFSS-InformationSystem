<?php 
  
        $page_title="Sto. Nino Formation and Science ";
        include_once( '../../includes/header.php');
          //include ('../../config.php');
        validateAccess();
        validateDepartmentHead();


        # displays list of students
        $sql_viewsl = "SELECT sl.StudentListID, sl.LevelID, sl.DateCreated, sl.Status, s.SectionName, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, st.FirstName, st.MiddleName, st.LastName, sl.ArchiveReason
        FROM studentlist sl
        INNER JOIN schoolyear sy
        ON sl.SchoolYearID = sy.SchoolYearID 
        INNER JOIN level l 
        ON sl.LevelID = l.LevelID 
        INNER JOIN section s
        ON sl.SectionID = s.SectionID
        INNER JOIN students st
        ON sl.StudentID = st.StudentID

        WHERE sl.Status = 'Archived'"; 

        $result_sl = $con->query($sql_viewsl) or die(mysqli_error($con));


        if(isset($_POST['back'])) {
          header('location:index.php');
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
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Section
        <small>manage section</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">section</a></li>
        <li class="active">Manage section</li>
      </ol>
    </section>

    <!-- Main content -->
    <form method ="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Archived Student</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="text-center table table-bordered table-striped">
                <thead>
                  <th>Student List ID</th>
                  <th>School Year</th>
                  <th>Level</th>
                  <th>Section</th>
                  <th>Student name</th>
                  <th>Status</th>
                  <th>Reason for Archive</th>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_sl))
                    {
                      $slid = $row['StudentListID'];
                      $sys = $row['SchoolYearStart'];
                      $sye = $row['SchoolYearEnd'];
                      $lid = $row['LevelID'];
                      $ln = $row['LevelName'];
                      $sn = $row['SectionName'];
                      $sfn = $row['FirstName'];
                      $smn = $row['MiddleName'];
                      $sln = $row['LastName'];
                      $dc = $row['DateCreated'];
                      $stat = $row['Status'];
                      $reasonarchive = $row['ArchiveReason'];

                      echo "
                        <tr>
                          <td>$slid</td>
                          <td>$sys - $sye</td>
                          <td>$ln</td>
                          <td>$lid - $sn</td>
                          <td>$sln, $sfn $smn</td>
                          <td>$stat</td>
                          <td>$reasonarchive</td>
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
  </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>