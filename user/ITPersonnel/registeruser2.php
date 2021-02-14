<?php
  $page_title = "Register User";
  include_once('../../includes/header.php');
  validateAccess();
  validateITPersonnel();

  $sql_subject = "SELECT SubjectName, SubjectID FROM subject";
  $result_subject =$con->query($sql_subject);
  $list_subject="";
  while($row = mysqli_fetch_array($result_subject))
  {
    $subjectid= $row['SubjectID'];
    $subjectname= $row['SubjectName'];
    $list_subject .= "<option value='$subjectid'>$subjectname</option>";
  }

    if (isset($_POST['add']))
    {

      $uname = clean_input($_POST['uname']);
      $fn = clean_input($_POST['fn']);
      $mn = clean_input($_POST['mn']);
      $ln = clean_input($_POST['ln']);
      $pw = hash('sha256', clean_input($_POST['pw']));
      $rpw = hash('sha256', clean_input($_POST['rpw']));
      $contact = clean_input($_POST['contact']);
      $email = clean_input($_POST['email']);
      $address = clean_input($_POST['address']);
      $gender = clean_input($_POST['gender']);
      $bday = clean_input($_POST['bday']);
      $typeid = clean_input($_POST['typeid']);

      $subjectselect = clean_input($_POST['subjectselect']);

      $sql_search = "SELECT * FROM user WHERE UserName = '$uname'";
      $result_search = $con->query($sql_search) or die(mysqli_error($con));

      if(mysqli_num_rows($result_search) == 0)
      {
        if($pw == $rpw)
        {
          if($typeid == 4)
          {
            $sql_add = "INSERT INTO user VALUES ('', '$typeid', '$uname', '$fn', '$mn', '$ln', '$gender','$bday','$email', '$contact','$address', '$pw', Now(), Now(), 'Active')";
            $con->query($sql_add) or die (mysqli_error($con));
            
            $tid = $con->insert_id;
  /*        #Create Teacher Account
            $sql_addteacheracc = "INSERT INTO user ( TypeID, UserName, Password, DateAdded, Status ) VALUES (4, $sid, '$hashedteacherpass', NOW(), 'Active')";
            $con->query($sql_addparentacc) or die(mysqli_error($con));
            $pid = $con->insert_id;
            $hashedteacherpass = hash('sha256', mysqli_real_escape_string($con, 'changeme'));*/


            #Connect Teacher to Subject
            $sql_connectteacher = "INSERT INTO teacher (UserID, SubjectID ) VALUES ('$tid', $subjectselect)";
            $con->query($sql_connectteacher) or die(mysqli_error($con));
          }
          else
          {
            $sql_add = "INSERT INTO user VALUES ('', '$typeid', '$uname', '$fn', '$mn', '$ln', '$gender','$bday','$email', '$contact','$address', '$pw', Now(), Now(), 'Active')";
            $con->query($sql_add) or die (mysqli_error($con));
          }
          header('location: viewuser.php');
        }
        else {
          echo "<script type='text/javascript'>alert('Password Does Not Match, Please Re-Type!')</script>";

        }
      }
      else
      {
        echo "<script type='text/javascript'>alert('User Name Exist, Please Change!')</script>";
      }  
    }
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">User Management</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="registeruser.php"><i class="fa fa-circle-o text-red"></i> <span>Add new user</span></a></li>
            <li><a href="viewuser.php"><i class="fa fa-circle-o text-red"></i> <span>Manage user(s)</span></a></li>
            <li><a href="viewarchiveuser.php"><i class="fa fa-circle-o text-red"></i> <span>View archived user(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View activity logs</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">User Registration</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Username</label>
                  <input type="text" class="form-control" value="" name="uname" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Password</label>
                   <input type="password" class="form-control" value="" name="pw" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Re-Type Password</label>
                  <input type="password" class="form-control" value="" name="rpw" required>
                </div>
              </div>

            <div class="box-header with-border">
              <p class="box-title">Personal Information</p>
            </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" value="" name="fn" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Middle Name</label>
                   <input type="text" class="form-control" value="" name="mn" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Last Name</label>
                   <input type="text" class="form-control" value="" name="ln" required>
                </div>
              </div>
               <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Gender</label>
                  <input type="text" class="form-control" value="" name="gender" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Birthday</label>
                  <input type="date" class="form-control" value="" name="bday" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" value="" name="email" required>
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Contact No.</label>
                    <input type="text" class="form-control" value="" name="contact" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Address</label>
                   <input type="text" class="form-control" value="" name="address" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">User Type</label>
                  <select name="typeid" value="" class="form-control" required>
                    <option value="1"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="1"){echo "selected='selected'";}?>>Principal</option>
                    <option value="2"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="2"){echo "selected='selected'";}?>>Department Head</option>
                    <option value="3"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="3"){echo "selected='selected'";}?>>Parents</option>
                    <option value="4"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="4"){echo "selected='selected'";}?>>Faculty</option>
                    <option value="5"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="5"){echo "selected='selected'";}?>>Student Services Officer</option>
                    <option value="6"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="6"){echo "selected='selected'";}?>>Registrar</option>
                    <option value="7"<?php if(isset($_POST['typeid']) && $_POST['typeid']=="7"){echo "selected='selected'";}?>>IT Personnel</option>
                  </select>
                </div>
              </div>
              
              <div class="box-header with-border">
                <p class="box-title">For Faculty</p>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Subject</label>
                  <select name="subjectselect" value="" class="form-control">
                    <option>
                    </option>
                    <?php echo $list_subject; ?>
                  </select>
                </div>
              <div class="box-footer">
                <button name="add" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Submit
                </button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>
