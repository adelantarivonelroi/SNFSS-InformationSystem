<?php
  $page_title = "Home Page";
  include_once('includes/header.php');
  include_once('email/verify.php');
  include_once('email/PHPMailerAutoload.php');
  validateAccess();

   if (isset($_POST['back']))
  {   
    $usertype = $_SESSION['usertype'];
    if ($usertype == 'Principal')
    {
      header('location:'.app_path.'user/Principal/index.php');
    }
    if ($usertype == 'Parents')
    {
      header('location:'.app_path.'user/Parents/index.php');
    }
    if ($usertype == 'Student Services Officer')
    {
      header('location:'.app_path.'user/StudentServicesOfficer/index.php');
    }
        if ($usertype == 'Faculty')
    {
      header('location:'.app_path.'user/Faculty/index.php');
    }
    if ($usertype == 'Registrar')
    {
      header('location:'.app_path.'user/Registrar/index.php');
    }
    if ($usertype == 'IT Personnel')
    {
      header('location:'.app_path.'user/ITPersonnel/index.php');
    }
    if ($usertype == 'DepartmentHead')
    {
      header('location:'.app_path.'user/DepartmentHead/index.php');
    }
  }

  $usertype = $_SESSION['usertype'];
  if ($usertype == 'Principal')
  {
    $link = 'user/Principal/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Parents')
  {
    $link ='user/Parents/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Faculty')
  {
    $link ='user/Faculty/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Student Services Officer')
  {
    $link ='user/StudentServicesOfficer/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Registrar')
  {
    $link ='user/Registrar/index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if($usertype == 'ITPersonnel')
    {
      $link ='user/ITPersonnel/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

    if($usertype == 'DepartmentHead')
    {
      $link ='user/DepartmentHead/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }


    if (isset($_POST['submit']))
    { 
      if ( isset($_SESSION['userid']) && !empty($_SESSION['userid']))
      {
        //Retrieve muna new password inputs.
        $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
        $newpasswordretype = mysqli_real_escape_string($con, $_POST['newpasswordretype']);
        //If same then execute below code, else echo nalang ng error message.
        if ( $newpassword == $newpasswordretype) 
        {

          //Either works, $newpassword or $newpasswordretype. Since namagkaparehas naman sila.
          //I hashed it here so that, it displays a hashed value in the link. 
          $changepassword = hash('sha256', mysqli_real_escape_string($con, $newpasswordretype)); 

          $useridsession = $_SESSION['userid'];

          //Kukunin naman natin mga pang fill up sa message part ng email natin and forms. ( By forms, I mean yung mga i-necho na user information dito sa page. ) 
          $sql_check = "SELECT UserID, FirstName, LastName, Email FROM user u 
            WHERE UserID = $useridsession";


          $sql_updatepass = "UPDATE user SET Password = $changepassword WHERE UserID = $useridsession";
          //This is to retrieve values from the selected row.  
          $con->query($sql_updatepass) or die(mysqli_error($con)); 
        }
      }
      else
      {
        header('index.php');
      }
    }


/*    $sql_users = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, 
    u.Email, u.ContactNo, u.Address, u.Status, u.DateAdded, u.DateModified
    from user u 
    INNER JOIN type t ON u.TypeID = t.TypeID  WHERE u.Status != 'Archive'";
    $result_users = $con->query($sql_users);
    while ($row = mysqli_fetch_array($result_users))
    {
      $uid = $row['UserID'];
      $utype = $row['TypeName'];
      $uname = $row['UserName'];
      $fn = $row['FirstName'];
      $mn = $row['MiddleName'];
      $ln = $row['LastName'];
      $email = $row['Email']; 
      $gender = $row['Gender'];
      $bday = $row['Birthday'];
      $contact = $row['ContactNo'];
      $address = $row['Address'];
      $status = $row['Status'];
    }*/
  ?>


  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <section class="sidebar">
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="<?php echo $link ?>"><i class="fa fa-circle-o text-red"></i> <span><?php echo $Home ?></span></a></li>
          </section>
          <!-- /.sidebar -->
        </aside>
    </section>

    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
       <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profile Page - <?php echo $fn ." ". $ln ?> </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
              <div class="box-body">
              </div>
            <div class="box-header with-border">
              <p class="box-title">Change Password</p>
            </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Enter new password</label>
                  <input type="password" class="form-control" value="" name="newpassword">
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Re-enter new password</label>
                  <input type="password" class="form-control" value="" name="newpasswordretype">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="form-group">
                  <div class="col-lg-offset-4 col-lg-10">
                    <button name="submit" onclick="return confirm('Are you sure?')" type="submit" class="btn btn-success">
                      Change
                    </button>
                    <a href="viewprofile.php" class="btn btn-default">
                      Cancel
                    </a>
                  </div>
                </div>

              </div>
            </form>
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include_once('includes/footer.php');
?>
