<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $disabled = "disabled"; //for section dropdown and button

  #SCHOOL YEAR
  $sql_sy = "SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_sy);
  $list_sy = "";
  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $systart = $row['SchoolYearStart'];
    $syend = $row['SchoolYearEnd'];
  }

  #LEVEL
  $sql_level = "SELECT LevelID, LevelName FROM level ORDER BY LevelID";
  $result_level = $con->query($sql_level);
  $list_level = "";
  while ($row = mysqli_fetch_array($result_level))
  {
    $lvlid = $row['LevelID'];
    $lvln = $row['LevelName'];
    $list_level .= "<option value='$lvlid'>$lvln</option>";
  }
  #TIME
  $sql_time = "SELECT TimeSlotID, TimeCode, TimeForm FROM timeslot ORDER BY TimeCode ASC";
  $result_time = $con->query($sql_time);
  $list_time = "";
  while ($row = mysqli_fetch_array($result_time))
  {
    $timeid= $row['TimeSlotID'];
    $timeform = $row['TimeForm'];
    $list_time .= "<option value='$timeid'>$timeform</option>";
  }

  #TEACHER
  $sql_teacherlist = "SELECT t.TeacherID, u.FirstName, u.MiddleName, u.LastName, s.SubjectName 
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

  #SELECT YEAR LEVEL
  if (isset($_POST['selectyl'])) {
  	  $selectedyl = mysqli_real_escape_string($con, $_POST['listyearlevel']);
  	  $sql_section = "SELECT SectionID, LevelID, SectionName FROM section WHERE LevelID = $selectedyl";
	  $result_section = $con->query($sql_section);

	  $list_section = "";

	    #LEVEL
	  while ($row = mysqli_fetch_array($result_section))
	  {
	    $secid = $row['SectionID'];
	    $seclevelid = $row['LevelID'];
	    $secnumber = $row['SectionName'];
	    $list_section .= "<option value='$secid'>$seclevelid - $secnumber</option>";
	  }
	  $disabled = "";
  }

  #SELECT SECTION
  if (isset($_POST['selectsection'])) {
  	$selectedsection = mysqli_real_escape_string($con, $_POST['listsection']);

  	$sql_templistselect = "SELECT fl.FacultyListID, su.SubjectName, ts.TimeForm, u.FirstName, u.MiddleName, u.LastName
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
        header('location: createfl.php');
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
	        header('location: createfl.php');


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
     header('location: createfl.php');
    }
  }
?>

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
    <form method="POST">
    <section class="content">
      <div class="row">
        <!-- left column -->
          <div class="col-md-12">


	          <div class="box box-primary">
	              <div class="box-header with-border">
	                <h3 class="box-title">Functions</h3>
	              </div>
	              <!-- /.box-header -->
		              <div class=box-body>
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
			                      <select name="listyearlevel" class="form-control" required>
			                        <option value="">Select one...</option>
			                        <?php echo $list_level; ?>
			                      </select>
		                      </div>
		                      <div class="col-sm-3">
			                      <button name="selectyl" type="submit" class="btn btn-success">
			                          Select
			                      </button>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="col-sm-7">
		                    <div class="form-group">
		                      <p class="control-label col-sm-2">Section</p>
		                      <div class="col-sm-3">
			                      <select name="listsection" class="form-control" <?php echo $disabled ?>>
			                        <option value="">Select one...</option>
			                        <?php echo $list_section; ?>
			                      </select>
		                      </div>
		                      <div class="col-sm-3">
			                      <button name="selectsection" type="submit" class="btn btn-success" <?php echo $disabled ?>>
			                          View
			                      </button>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="col-sm-7">
		                    <div class="form-group">
		                      <p class="control-label col-sm-2">Time slot</p>
		                      <div class="col-sm-3">
			                      <select name="listtime" class="form-control" <?php echo $disabled ?>>
			                        <option value="">Select one...</option>
			                        <?php echo $list_time; ?>
			                      </select>
		                      </div>
		                      <div class="col-sm-3">
			                      <button name="add" type="submit" class="btn btn-success" <?php echo $disabled ?>>
			                          Add
			                      </button>
		                      </div>
		                    </div>
		                  </div>
		                  <div class="col-sm-4">
		                    <div class="form-group">
		                      <div class="col-sm-8">
		                        <button name="remove" type="submit" class="btn btn-danger">
		                          Remove
		                        </button>
		                        <button name="propose" type="submit" class="btn btn-info">
		                          Submit
		                        </button>
		                        <a href="index.php" class="btn btn-default">
		                          Back to View
		                        </a>
		                      </div> 
		                    </div>
		                  </div>
		              </div>
	          </div>

	        <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Faculty List</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body with-border">
               <table id="example1" class="text-center table table-bordered table-striped">
                  <thead>
                    <th></th>
                    <th>Facult name</th>
                    <th>Subject</th>
                    <th>Time</th>
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
	                            <td>
	                            <input type='checkbox' name='tmpcheck_list[]' value='$tmptid' />
	                            </td>
	                            <td>$tmptln, $tmpfn $tmptmn</td>
	                            <td>$tmpsn</td>
	                            <td>$tmptf</td>
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
                    <th></th>
                    <th>Subject</th>
                    <th>Faculty name</th>

                  </thead>
                   <tbody>
                    <?php
	                      while ($row = mysqli_fetch_array($result_teacher))
	                      {
	                        $tid = $row['TeacherID'];
	                        $sn = $row['SubjectName'];
	                        $tfn = $row['FirstName'];
	                        $tmn = $row['MiddleName'];
	                        $tln = $row['LastName'];

	                        echo "
	                          <tr>
	                            <td>
	                            <input type='checkbox' name='tcheck_list[]' value='$tid' />
	                            </td>
	                            <td>$sn</td>
	                            <td>$tln, $tfn $tmn</td>
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
    include_once('../../../includes/footer.php');
?>