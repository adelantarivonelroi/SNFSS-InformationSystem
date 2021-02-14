<?php
  $page_title = "Home Page";
  include_once('includes/header.php');
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
    if ($usertype == 'Department Head')
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
    if($usertype == 'IT Personnel')
    {
      $link ='user/ITPersonnel/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

    if($usertype == 'Department Head')
    {
      $link ='user/DepartmentHead/index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }


    $sql_users = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, 
    u.Email, u.ContactNo, u.AddressID, u.Status, a.Street, a.Barangay, c.CityName, u.DateAdded, u.DateModified, u.Role
    from user u 
    INNER JOIN type t 
    ON u.TypeID = t.TypeID  
    INNER JOIN address a 
    ON u.AddressID = a.AddressID
    INNER JOIN city c 
    ON a.CityID = c.CityID
    WHERE u.UserID = $uid 
    AND u.Status != 'Archived'";
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
      $street = decrypt($row['Street']);
      $brgy = decrypt($row['Barangay']);
      $city = $row['CityName'];
      $role = $row['Role'];
      $status = $row['Status'];
    }
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
                <div class="col-md-4">
                  <label class="control-label">Username</label>
                  <input type="text" class="form-control" value="<?php echo $uname; ?>" name="uname" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Role</label>
                  <input type="text" class="form-control" value="<?php echo $role; ?>" name="role" readonly>
                </div>
              </div>
            <div class="box-header with-border">
              <p class="box-title">Personal Information</p>
            </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">First Name</label>
                  <input type="text" class="form-control" value="<?php echo $fn; ?>" name="fn" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Middle Name</label>
                   <input type="text" class="form-control" value="<?php echo $mn; ?>" name="mn" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Last Name</label>
                   <input type="text" class="form-control" value="<?php echo $ln; ?>" name="ln" readonly>
                </div>
              </div>
               <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Gender</label>
                  <input type="text" class="form-control" value="<?php echo $gender; ?>" name="gender" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Birthday</label>
                  <input type="date" class="form-control" value="<?php echo $bday; ?>" name="bday" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" value="<?php echo $email; ?>" name="email" readonly>
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Contact No.</label>
                    <input type="text" class="form-control" value="<?php echo $contact; ?>" name="contact" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Address</label>
                   <input type="text" class="form-control" value="<?php echo $street . ', ' . $brgy . ', ' . $city; ?>" name="address" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">User Type</label>
                   <input type="text" class="form-control" value="<?php echo $utype; ?>" name="utype" readonly>
                </div>
              </div>
              <div class="box-body">
              
              <!-- /.box-body -->

              <div class="box-footer">
                <a href="changepassword.php" class="btn btn-success">
                  Change Password
                </a>
                <button name="back" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Back
                </button>
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
