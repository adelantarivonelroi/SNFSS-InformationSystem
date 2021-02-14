<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  //include ('../../config.php');

  validateAccess();
  validateDepartmentHead();

  $disabled = "disabled"; //for section dropdown and button
  $displaymessage = "";
  $displaysubject = "";
  
  $message = "";

  #get school year
  $sql_sy = $con->prepare("SELECT SchoolYearID, SchoolYearStart, SchoolYearEnd FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1");
  $sql_sy->execute();
  $result_sy = $sql_sy->get_result();
  $list_sy = "";
  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $systart = $row['SchoolYearStart'];
    $syend = $row['SchoolYearEnd'];
  }

  #get section
  $sql_section = $con->prepare("SELECT SummerSectionID, LevelID, SectionName FROM summersection WHERE Status = 'Approved' ORDER BY LevelID");
  $sql_section->execute();
  $result_section = $sql_section->get_result();

  $list_section = "";
  while ($row = mysqli_fetch_array($result_section))
  {
    $secid = $row['SummerSectionID'];
    $seclevelid = $row['LevelID'];
    $secnumber = $row['SectionName'];
    $list_section .= "<option value='$secid'>$seclevelid - $secnumber</option>";
  }

  if (isset($_SESSION['sectionid']) && !empty($_SESSION['sectionid']) && isset($_SESSION['levelid']) && !empty($_SESSION['levelid']) && isset($_SESSION['sectionno']) && !empty($_SESSION['sectionno']) && isset($_SESSION['subjectinfo']) && !empty($_SESSION['subjectinfo']) )
  {
    $csid = $_SESSION['sectionid'];
    $lvlses = $_SESSION['levelid'];
    $snses = $_SESSION['sectionno'];
    $subinfo = $_SESSION['subjectinfo'];

    $sql_viewselected = "SELECT fl.SummerFacultyListID, fl.SummerSectionID, fl.LevelID, s.SectionName, fl.Status, su.SubjectName, u.FirstName, u.MiddleName, u.LastName
    FROM summerfacultylist fl
    INNER JOIN schoolyear sy
    ON fl.SchoolYearID = sy.SchoolYearID
    INNER JOIN level l 
    ON fl.LevelID = l.LevelID
    INNER JOIN summersection s 
    ON fl.SummerSectionID = s.SummerSectionID
    INNER JOIN teacher t 
    ON fl.TeacherID = t.TeacherID
    INNER JOIN user u
    ON t.UserID = u.UserID
    INNER JOIN subject su
    ON t.SubjectID = su.SubjectID
    WHERE fl.Status = 'Temporary' AND fl.SummerSectionID = $csid";
    $result_templistselect = $con->query($sql_viewselected) or die(mysqli_error($con));

    $displaymessage = "Currently assigning faculty to section " . $lvlses . "-" . $snses;
    $displaysubject = "Subject this section is set to : " . $subinfo;
  }
  else
  {
    #TEMP LIST
    $sql_templist = $con->prepare("SELECT fl.SummerFacultyListID, fl.SummerSectionID, fl.LevelID, s.SectionName, fl.Status, su.SubjectName, u.FirstName, u.MiddleName, u.LastName
    FROM summerfacultylist fl
    INNER JOIN schoolyear sy
    ON fl.SchoolYearID = sy.SchoolYearID
    INNER JOIN level l 
    ON fl.LevelID = l.LevelID
    INNER JOIN summersection s 
    ON fl.SummerSectionID = s.SummerSectionID
    INNER JOIN teacher t 
    ON fl.TeacherID = t.TeacherID
    INNER JOIN user u
    ON t.UserID = u.UserID
    INNER JOIN subject su
    ON t.SubjectID = su.SubjectID
    WHERE fl.Status = 'Temporary'");
    $sql_templist->execute();
    $result_templistselect = $sql_templist->get_result();
    $displaymessage = "Currently viewing all assigned faculties";
  }
  

  if ( isset($_SESSION['subjectidfaculty']) && !empty($_SESSION['subjectidfaculty']))
  {
      $idsubject = $_SESSION['subjectidfaculty'];
      #get faculty available
      $sql_teacherlist = "SELECT t.TeacherID, u.FirstName AS teaFirstName, u.MiddleName AS teaMiddleName, u.LastName AS teaLastName, s.SubjectName 
      FROM teacher t 
      INNER JOIN user u 
      ON t.UserID = u.UserID 
      INNER JOIN subject s 
      ON t.SubjectID = s.SubjectID 
      WHERE u.Status = 'Active' AND t.SubjectID = $idsubject";
      $result_teacher = $con->query($sql_teacherlist) or die(mysqli_error($con));
     
  }
  else
  {
    #get faculty available
      $sql_teacherlist = $con->prepare("SELECT t.TeacherID, u.FirstName AS teaFirstName, u.MiddleName AS teaMiddleName, u.LastName AS teaLastName, s.SubjectName 
      FROM teacher t 
      INNER JOIN user u 
      ON t.UserID = u.UserID 
      INNER JOIN subject s 
      ON t.SubjectID = s.SubjectID 
      WHERE u.Status = 'Active'");
      $sql_teacherlist->execute();
      $result_teacher = $sql_teacherlist->get_result(); 
  }
  


  if ( isset($_POST['viewsectionfl']))
  {

    $selectsec = mysqli_real_escape_string($con, $_POST['listsection']);

    $_SESSION['sectionid'] = $selectsec;

    $sql_getsection = $con->prepare("SELECT ss.LevelID, ss.SectionName, ss.SubjectID, s.SubjectName 
      FROM summersection ss 
      INNER JOIN subject s 
      ON ss.SubjectID  = s.SubjectID
      WHERE SummerSectionID = ?");
    $sql_getsection->bind_param('i', $selectsec);
    $sql_getsection->execute();
    $result_getsection = $sql_getsection->get_result();

    while ( $row = mysqli_fetch_array($result_getsection))
    {
      $lvl = $row['LevelID'];
      $sno = $row['SectionName'];
      $detail = $row['SubjectName'];
      $subid = $row['SubjectID'];

      $_SESSION['levelid'] = $lvl;
      $_SESSION['sectionno'] = $sno;
      $_SESSION['subjectinfo'] = $detail;
      $_SESSION['subjectidfaculty'] = $subid;
    }

    $sql_view = $con->prepare("SELECT fl.SummerFacultyListID, fl.SummerSectionID, fl.LevelID, s.SectionName, fl.Status, su.SubjectName, u.FirstName, u.MiddleName, u.LastName
    FROM summerfacultylist fl
    INNER JOIN schoolyear sy
    ON fl.SchoolYearID = sy.SchoolYearID
    INNER JOIN level l 
    ON fl.LevelID = l.LevelID
    INNER JOIN summersection s 
    ON fl.SummerSectionID = s.SummerSectionID
    INNER JOIN teacher t 
    ON fl.TeacherID = t.TeacherID
    INNER JOIN user u
    ON t.UserID = u.UserID
    INNER JOIN subject su
    ON t.SubjectID = su.SubjectID
    WHERE fl.Status = 'Temporary' AND fl.SummerSectionID = ?");
    $sql_view->bind_param('i', $selectsec);
    $sql_view->execute();
    $result_templistselect = $sql_view->get_result();

    $displaymessage = "Currently assigning faculty to section " . $lvl . "-" . $sno;
    header('location: summerfacultylistcreate.php');
  }

  if ( isset ($_POST['assign']))
  {
    if (isset($_SESSION['sectionid']) && !empty($_SESSION['sectionid']))
    {
      if (isset($_POST['tradio']) && !empty($_POST['tradio']))
      {
        $radioselect = mysqli_real_escape_string($con, $_POST['tradio']);
        $section = $_SESSION['sectionid'];
        $level = $_SESSION['levelid'];

        $sql_checkdouble = $con->prepare("SELECT * FROM summerfacultylist WHERE TeacherID = ?");
        $sql_checkdouble->bind_param('i', $radioselect);
        $sql_checkdouble->execute();
        $result_checkdouble = $sql_checkdouble->get_result();
        
        if ( mysqli_num_rows($result_checkdouble) > 0 )
        {
          $message = "Faculty is already assigned select another.";
        }
        else 
        {
          $sql_addtemp = $con->prepare("INSERT INTO  summerfacultylist ( SchoolYearID, LevelID, SummerSectionID, TeacherID, Status ) VALUES ( $syid, $level, $section, $radioselect, 'Temporary')");  
          $sql_addtemp->bind_param('iiii', $syid, $level, $section, $radioselect);
          $sql_addtemp->execute();
          $message = "Successfully added faculty to temporary list";
          echo "<script type='text/javascript'>alert('$message');</script>";
          header('location: summerfacultylistcreate.php');
        }
      }
      else
      {
        $message = "Please select a faculty to assign.";
      }
    }
    else 
    {
      $message = "Please select a section to assign first.";
    }
  }

  if ( isset ($_POST['remove']))
  {
    $fcheckboxes = isset($_POST['fcheck_box']) ? $_POST['fcheck_box'] : array();
    if(!empty($fcheckboxes)) 
    {
      foreach ($fcheckboxes as $fselected) 
      {
        $sql_delete = $con->prepare("DELETE FROM summerfacultylist WHERE SummerFacultyListID = ?");
        $sql_delete->bind_param('i', $fselected);
        $sql_delete->execute();
        $message = "Successfully removed from the list";
        header('location: summerfacultylistcreate.php');
      }
    }
    else
    {
      $message = "Please select an assigned faculty first to remove.";
    }
  }

  if (isset($_POST['propose'])) 
  {
      while ($row = mysqli_fetch_array($result_templistselect)) 
      {
        $sql_propose = $con->prepare("UPDATE summerfacultylist SET DateCreated = NOW(), Status = 'Pending' WHERE Status = 'Temporary'");
        $sql_propose->execute();
        $message = "Successfully submitted to be approved.";
        header('location: summerfacultylistsuccess.php');
      }
  }

  if (isset($_POST['back'])) 
  {
    header('location: summerfacultylistcreate.php');
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
            <li class="header">Summer class</li>
            <li><a href="summerclasshome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Summer Class</span></a></li>
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
                    <div class="col-sm-2">
                      <button name='back' type='submit' class='btn btn-default'>
                        Back
                      </button>
                    </div>
                  </div>

                  <div class="form-group">
                    <p class="col-sm-2 control-label">Select section</p>
                    <div class="col-sm-2">
                      <select name="listsection" class="form-control">
                        <?php echo $list_section; ?>
                      </select>
                    </div>
                    <div class="col-sm-2">
                      <button name='viewsectionfl' type='submit' class='btn btn-primary'>
                        Select
                      </button>
                    </div>
                  </div>

                  <hr>

                  <div class="form-group">
                    <p class="col-sm-2 control-label"></p>
                    <div class="col-sm-3">
                      <button name='assign' type='submit' class='btn btn-primary'>
                        Assign
                      </button>
                      <button name='remove' type='submit' class='btn btn-danger'>
                        Remove
                      </button>
                      <button name='propose' type='submit' class='btn btn-success'>
                        Submit
                      </button>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-3 control-label">
                      <?php echo $displaymessage ?>
                    </label>
                    <label class="col-sm-3 control-label">
                    <?php echo  $displaysubject ?>
                    </label>
                    <label class="col-sm-3 control-label">
                      <?php echo $message ?>
                    </label>
                  </div>
                </div>
            </div>
           
	          <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Faculty List</h3>
              </div>
              <!-- /.box-header -->
                <div class="box-body with-border">
                   <table id="example3" class="text-center table table-bordered table-striped">
                      <thead>
                        <th></th>
                        <th>Section</th>
                        <th>Faculty name</th>
                        <th>Subject</th>
                      </thead>
                      <tbody>
                        <?php
    	                      while ($row = mysqli_fetch_array($result_templistselect))
    	                      {
    	                        $tmptid = $row['SummerFacultyListID'];
                              $tmplevel = $row['LevelID'];
                              $tmpsection = $row['SectionName'];
    	                        $tmpsn = $row['SubjectName'];
    	                        $tmpfn = $row['FirstName'];
    	                        $tmptmn = $row['MiddleName'];
    	                        $tmptln = $row['LastName'];

    	                        echo "
    	                          <tr>
                                  <td><input type='checkbox' name='fcheck_box[]' value='$tmptid' /></td>
                                  <td>$tmplevel - $tmpsection</td>
    	                            <td>$tmptln, $tmpfn $tmptmn</td>
    	                            <td>$tmpsn</td>
    	                          </tr>
    	                        ";
    	                      }
                        ?>
                      </tbody>
                    </table>
            	</div>
            </div>
          	  
	        <div class="box box-primary">
              <div class="box-header with-border border-bottom">
                <h3 class="box-title">Faculty available</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body with-border">
                 <table id="example3" class="text-center table table-bordered table-striped">
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
  	                        $tfn = $row['teaFirstName'];
  	                        $tmn = $row['teaMiddleName'];
  	                        $tln = $row['teaLastName'];

  	                        echo "
  	                          <tr>
                                <td><input type='radio' name='tradio' value='$tid' /></td>
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
    include_once('../../includes/footer.php');
?>