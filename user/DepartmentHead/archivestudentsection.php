<?php 
  include_once( '../../includes/header.php');
  # checks if record is selected
  if (isset($_SESSION['archivesectionid']))
  {
    if (ctype_digit($_SESSION['archivesectionid']))
    {
        $page_title="Sto. Nino Formation and Science ";
          //include ('../../config.php');
        validateAccess();
        validateDepartmentHead();

        $id = $_SESSION['archivesectionid'];

        # displays list of students
        $sql_viewsl = "SELECT sl.StudentListID, sl.LevelID, sl.DateCreated, sl.Status, s.SectionName, sy.SchoolYearStart, sy.SchoolYearEnd, l.LevelName, st.FirstName, st.MiddleName, st.LastName
        FROM studentlist sl
        INNER JOIN schoolyear sy
        ON sl.SchoolYearID = sy.SchoolYearID 
        INNER JOIN level l 
        ON sl.LevelID = l.LevelID 
        INNER JOIN section s
        ON sl.SectionID = s.SectionID
        INNER JOIN students st
        ON sl.StudentID = st.StudentID

        WHERE sl.SectionID = '$id' AND sl.Status = 'Approved'"; 

        $result_sl = $con->query($sql_viewsl) or die(mysqli_error($con));

        $message = "";
        $error = "";
        if ( isset($_POST['archive']))
        {
        	if(isset($_POST['tradio']) && !empty($_POST['tradio']) )
        	{
        		if(!empty($_POST['reason']))
        		{
        			$radioselect = mysqli_real_escape_string($con, $_POST['tradio']);
        			$reason = clean_input($_POST['reason']);

              if ( $reason != "")
              {
                if(!preg_match('/^[a-zA-z]+$/i', $reason)) {
                  $error .= "<script type='text/javascript'>alert('Reason input is in incorrect format')</script>";
                }
                else 
                {
                  $sql_archive = "UPDATE studentlist SET Status = 'Archived', ArchiveReason = '$reason' WHERE StudentListID = $radioselect";
                  $con->query($sql_archive) or die(mysqli_error($con));

                  header('location: archivestudentsection.php');
                }
              }
              else
              {
                $error .= "<script type='text/javascript'>alert('Must not be blank')</script>";
              }
              if ($error)
              {
                echo $error;
              }
        		}
        		else
        		{
        			$message = "Please type a reason for archiving.";
        		}
        	}
        	else
        	{
        		$message = "Please select a student to archive.";
        	}
        }

        if(isset($_POST['back'])) {
          header('location:index.php');
        }
    }
      
  } 
  else 
  {
    header ('location: archiveviewsection.php');
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
              <h3 class="box-title">Student list</h3>
            </div>

           <div class="box-body">
                <div class="col-md-12">
                  <label>Archive A Student In A Section</label>
                  <p><?php echo $message ?></p>

                  <label>Reason for Archive</label>
                  <textarea class="form-control" name="reason" rows="3" placeholder="Please type a reason.."></textarea>
                </div>
              </div>
            </div>
            </div>
            <div class="box-body">
              <!-- /.box-body -->
            <div class="box-footer">
                <button name="archive" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Archive
                </button>
              </div>
            </div>
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student list</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example3" class="text-center table table-bordered table-striped">
                <thead>
                  <th></th>
                  <th>Student List ID</th>
                  <th>School Year</th>
                  <th>Level</th>
                  <th>Section</th>
                  <th>Student name</th>
                  <th>Date Submitted</th>
                  <th>Status</th>
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



                      echo "
                        <tr>
                          <td><input type='radio' name='tradio' value='$slid' /></td>
                          <td>$slid</td>
                          <td>$sys - $sye</td>
                          <td>$ln</td>
                          <td>$lid - $sn</td>
                          <td>$sln, $sfn $smn</td>
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
    </section>
  </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>