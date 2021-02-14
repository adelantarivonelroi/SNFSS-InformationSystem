<?php
  $page_title = "Home Page";
  include_once('includes/header.php');
 //validateAccess();
  //validateAdmin();
  ?>

  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>[Name of User]</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview menu-open">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>User Management</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="registeruser.php"><i class="fa fa-circle-o"></i>User Registration</a></li>
                <li><a href="viewuser.php"><i class="fa fa-circle-o"></i>View Users</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>[Page Name]</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
              </ul>
            </li>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        [Dashboard]
        <small>Welcome [Name / User Type]</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">View Users</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <form method="POST" class="form-horizontal">
                    <div class="col-lg-12">
                      <?php
                        $sql_users = "SELECT u.userID, u.typeID, t.typeName, u.userName, u.firstName, u.middleName, u.lastName, u.gender, u.bday, 
                          u.email, u.contact, u.address, u.status, u.dateAdded, u.dateModified
                        from user u 
                        INNER JOIN type t ON u.typeID = t.typeID  WHERE u.status != 'Archive'";
                        $result_users = $con->query($sql_users);
                      ?>

                      <table id="user" class="table table-hover">
                        <thead>
                          <th>User ID</th>
                          <th>User Type</th>
                          <th>Username</th>
                          <th>Full Name</th>
                          <th>Gender</th>
                          <th>Birthday</th>
                          <th>Email Address</th>
                          <th>Contact Number</th>
                          <th>Address</th>
                          <th>Status</th>
                          <th>---</th>
                        </thead>
                        <tbody>
                          <?php
                            while ($row = mysqli_fetch_array($result_users))
                            {
                              $uid = $row['userID'];
                              $utype = $row['userType'];
                              $uname = $row['userName'];
                              $fn = $row['firstName'];
                              $ln = $row['lastName'];
                              $email = $row['email']; 
                              $gender = $row['gender'];
                              $bday = $row['bday'];
                              $contact = $row['contact'];
                              $address = $row['address'];
                              $status = $row['status'];

                              echo
                              "<tr>
                                <td>$uid</td>
                                <td>$utype</td>
                                <td>$uname</td>
                                <td>$ln, $fn</td>
                                <td>$email</td>
                                <td>$gender</td>
                                <td>$bday</td>
                                <td>$contact</td>
                                <td>$address</td>
                                <td>$status</td>
                              </tr>";
                            }
                          ?>
                        </tbody>
                      </table>                
                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <!-- /.box -->
          <script>
            $(document).ready(function(){
              $('#user').DataTable();
            });
          </script>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include_once('includes/footer.php');
?>
