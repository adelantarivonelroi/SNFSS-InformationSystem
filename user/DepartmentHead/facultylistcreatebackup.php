<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $disabled = "disabled"; //for section dropdown and button
  $displaymessage = "";
  #SCHOOL YEAR
  $sql_sy = "SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_sy) or die(mysqli_error($con));
  $list_sy = "";
  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $systart = $row['SchoolYearStart'];
    $syend = $row['SchoolYearEnd'];
  }

  #TIME
  $sql_time = "SELECT TimeSlotID, TimeCode, TimeForm FROM timeslot ORDER BY TimeCode ASC";
  $result_time = $con->query($sql_time) or die(mysqli_error($con));
  $list_time = "";
  while ($row = mysqli_fetch_array($result_time))
  {
    $timeid= $row['TimeSlotID'];
    $timeform = $row['TimeForm'];
    $list_time .= "<option value='$timeid'>$timeform</option>";
  }

  #TEACHER
  $sql_teacherlist = "SELECT t.TeacherID, u.FirstName AS teaFirstName, u.MiddleName AS teaMiddleName, u.LastName AS teaLastName, s.SubjectName 
  FROM teacher t 
  INNER JOIN user u 
  ON t.UserID = u.UserID 
  INNER JOIN subject s 
  ON t.SubjectID = s.SubjectID 
  WHERE u.Status = 'Active'";
  $result_teacher = $con->query($sql_teacherlist) or die(mysqli_error($con)); 

  #TEMP LIST
  $sql_templist = "SELECT fl.FacultyListID, su.SubjectName, ts.TimeForm, u.FirstName, u.MiddleName, u.LastName
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

	  WHERE fl.Status = 'Temporary'";
  $result_templistselect = $con->query($sql_templist) or die(mysqli_error($con));

  # section
  $sql_section = "SELECT SectionID, SchoolYearID, LevelID, SectionName FROM section";
  $result_section = $con->query($sql_section) or die(mysqli_error($con));

  $list_section = "";
  while ($row = mysqli_fetch_array($result_section))
  {
    $secid = $row['SectionID'];
    $seclevelid = $row['LevelID'];
    $secnumber = $row['SectionName'];
    $list_section .= "<option value='$secid'>$seclevelid - $secnumber</option>";
  }

  #View faculty list of selected section
  if (isset($_POST['viewsectionfl'])) {
  	$selectedsection = mysqli_real_escape_string($con, $_POST['listsection']);

    #get section for display
    $sql_assignsection = "SELECT SectionID, SchoolYearID, LevelID, SectionName FROM section WHERE SectionID = $selectedsection";
    $result_assignsection = $con->query($sql_assignsection) or die(mysqli_error($con));

    $list_section = "";
    while ($row = mysqli_fetch_array($result_assignsection))
    {
      $secid = $row['SectionID'];
      $seclevelid = $row['LevelID'];
      $secnumber = $row['SectionName'];
    }

  	$sql_templistselect = "SELECT fl.FacultyListID, su.SubjectName, ts.TimeForm, u.FirstName AS facFirstName, u.MiddleName AS facMiddleName, u.LastName AS facLastName
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

	  WHERE fl.Status = 'Temporary' AND fl.SectionID = $selectedsection";
  	$result_templistselect = $con->query($sql_templistselect) or die(mysqli_error($con));

    $displaymessage = "Currently assigning faculty for" . $seclevelid . " - " . $secnumber;

  }

  #ADD TEACHER
  if (isset($_POST['add'])) {
    $schoolyear = mysqli_real_escape_string($con, $syid);
    $listyearlevel = mysqli_real_escape_string($con,  $_POST['listyearlevel']);
    $listsection = mysqli_real_escape_string($con,  $_POST['listsection']);
    $timeslot = mysqli_real_escape_string($con, $_POST['listtime']);
    $tcheckboxes = isset($_POST['tcheck_list']) ? $_POST['tcheck_list'] : array();

    if(!empty($tcheckboxes)) {
      foreach ($tcheckboxes as $tselected) {
        $sql_addtemp = "INSERT INTO  facultylist ( SchoolYearID, LevelID, SectionID, TeacherID, TimeSlotID, Status ) VALUES ( $schoolyear, $listyearlevel, $listsection, $tselected, $timeslot, 'Temporary')";  
        $con->query($sql_addtemp) or die(mysqli_error($con));
        $message = "Successfully added faculty to temporary list";
        header('location: facultylistcreate.php');
      }
    }
  }

  #REMOVE TEADHER 
  if (isset($_POST['remove'])) {
    $tmpcheckboxes = isset($_POST['tmpcheck_list']) ? $_POST['tmpcheck_list'] : array();

     if(!empty($tmpcheckboxes)) {
      foreach ($tmpcheckboxes as $tmpselected) {
	        $sql_delete = "DELETE FROM facultylist WHERE FacultyListID = $tmpselected";
	        $con->query($sql_delete) or die(mysqli_error($con));
	        $message = "Successfully removed from the list";
	        header('location: facultylistcreate.php');


	    }
      }
    }

  #SUBMIT
  if (isset($_POST['propose'])) {
    while ($row = mysqli_fetch_array($result_templistselect)) {
    $sy = $row['SchoolYearID'];
    $lyl = $row['LevelID'];
    $ls = $row['SectionID'];
    $tid = $row['TeacherID'];
    $ts = $row['TimeSlotID'];


    $sql_propose = "UPDATE facultylist SET DateCreated = NOW(), Status = 'Pending' WHERE Status = 'Temporary'";
    //echo "<meta http-equiv='refresh' content='0'>";
      $con->query($sql_propose);
      $message = "Successfully submitted to be approved.";
     header('location: facultylistcreate.php');
    }
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
                

<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create faculty list
        <small>assign class</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Assign class</a></li>
        <li class="active">create faculty list</li>
      </ol>
    </section>



    <!-- Main content -->
    <form method="POST" class="form-horizontal">
    <section class="content">
      <div class="row">
        <!-- left column -->
          <div class="col-md-12">


	          <div class="box box-primary">
	              <div class="box-header">
                  <h3 class="box-title">Functions</h3>
                </div>

                <div class="box-body with-border border-bottom">

                  <div class="form-group">
                    <p class="col-sm-2 control-label">School year</p>
                    <div class="col-sm-2">
                      <label class="form-control"><?php echo $systart . " - " . $syend ?></label>
                    </div>
                  </div>

                  <div class="form-group">
                    <p class="col-sm-2 control-label">Select section</p>
                    <div class="col-sm-2">
                      <select name="listsection" class="form-control">
                        <option value="">Select one...</option>
                        <?php echo $list_section; ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button name='viewsectionfl' type='submit' class='btn btn-primary'>
                        View
                      </button>
                    </div>
                  </div>

                  <hr>

                  <div class="form-group">
                    <p class="col-sm-2 control-label">Select time slot to assign</p>

                    <div class="col-sm-2">
                      <div class="input-group">
                        <select name="listsection" class="form-control">
                          <option value="">Select one...</option>
                          <?php echo $list_time; ?>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <?php echo $displaymessage ?>
                  </div>
                </div>
            </div>
           
	          <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Faculty List</h3>
              </div>
              <!-- /.box-header -->
                <div class="box-body with-border">
                   <table id="example2" class="text-center table table-bordered table-striped">
                      <thead>
                        <th>Facult name</th>
                        <th>Subject</th>
                        <th>Time</th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php
    	                      while ($row = mysqli_fetch_array($result_templistselect))
    	                      {
    	                        $tmptid = $row['FacultyListID'];
    	                        $tmpsn = $row['SubjectName'];
    	                        $tmpfn = $row['FirstName'];
    	                        $tmptmn = $row['MiddleName'];
    	                        $tmptln = $row['LastName'];
    	                        $tmptf = $row['TimeForm'];

    	                        echo "
    	                          <tr>
    	                            <td>$tmptln, $tmpfn $tmptmn</td>
    	                            <td>$tmpsn</td>
    	                            <td>$tmptf</td>
                                  <td>
                                    <button name='remove' type='submit' class='btn-sm btn-danger'>
                                      Remove
                                    </button>
                                  </td>
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
                <h3 class="box-title">Faculty available</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                 <table id="example2" class="text-center table table-bordered table-striped">
                    <thead>
                      <th>Subject</th>
                      <th>Faculty name</th>
                      <th></th>

                    </thead>
                     <tbody>
                      <?php
  	                      while ($row = mysqli_fetch_array($result_teacher))
  	                      {
  	                        $tid = $row['TeacherID'];
  	                        $sn = $row['SubjectName'];
  	                        $tfn = $row['teaFirstName'];
  	                        $tmn = $row['teaMiddleName'];
  	                        $tln = $row['teaLastName'];

  	                        echo "
  	                          <tr>
  	                            <td>$sn</td>
  	                            <td>$tln, $tfn $tmn</td>
                                <td>
                                  <button name='add' type='submit' class='btn-sm btn-success'>
                                    Add
                                  </button>
                                </td>
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