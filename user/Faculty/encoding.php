 
<?php
$page_title = "Register User";
include_once('../../includes/header.php');
validateAccess();
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
      <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
      <li><a href="encoding.php"><i class="fa fa-circle-o text-red"></i> <span>Encoding</span></a></li>
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
          <h3 class="box-title">List of Sections</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
          <div class="box-body">
            <form method="POST" class="form-horizontal">
              <div class="col-lg-12">
                <?php
                $sql_users = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, 
                u.Email, u.ContactNo, u.Address, u.Status, u.DateAdded, u.DateModified
                from user u 
                INNER JOIN type t ON u.TypeID = t.TypeID  WHERE u.Status != 'Archive'";
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
                    <th>Update</th>
                    <th>Archive</th>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result_users))
                    {
                      $uid = $row['UserID'];
                      $utype = $row['TypeName'];
                      $uname = $row['UserName'];
                      $fn = $row['FirstName'];
                      $ln = $row['LastName'];
                      $email = $row['Email']; 
                      $gender = $row['Gender'];
                      $bday = $row['Birthday'];
                      $contact = $row['ContactNo'];
                      $address = $row['Address'];
                      $status = $row['Status'];

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
                      <td>
                      <a href='viewuserdetail.php?id=$uid' class='btn btn-xs btn-info'>
                      <i class='fa fa-edit'></i>
                      </a>
                      </td>
                      <td>
                      <a href='archiveuser.php?id=$uid' class='btn btn-xs btn-danger' 
                      onclick='return confirm(\"Are you sure?\");''>
                      <i class='fa fa-trash'></i>
                      </a>
                      </td>
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
      <!-- /.box-body -->
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
