<?php
  $page_title = "Home Page";
  include_once('../../includes/header.php');
  validateAccess();
  validateITPersonnel();
  ?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">User Management</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="registeruser.php"><i class="fa fa-circle-o text-red"></i> <span>Add new user</span></a></li>
            <!-- <li><a href="addroles.php"><i class="fa fa-circle-o text-red"></i> <span>Add new role</span></a></li> -->
            <li><a href="viewuser.php"><i class="fa fa-circle-o text-red"></i> <span>Manage user(s)</span></a></li>
            <li><a href="viewarchiveuser.php"><i class="fa fa-circle-o text-red"></i> <span>View archived user(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View activity logs</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Content Header (Page header) -->
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
                        $sql_users = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, u.AddressID,
                          u.Email, u.ContactNo, a.Street, a.Barangay, c.CityName, u.Status, u.DateAdded, u.DateModified
                        from user u 
                        INNER JOIN type t 
                        ON u.TypeID = t.TypeID  
                        INNER JOIN  address a 
                        ON u.AddressID = a.AddressID
                        INNER JOIN  city c 
                        ON a.CityID = c.CityID
                        WHERE u.Status != 'Archived'";
                        $result_users = $con->query($sql_users) or die(mysqli_error($con));
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
                              $mn = $row['MiddleName'];
                              $ln = $row['LastName'];
                              $email = $row['Email']; 
                              $gender = $row['Gender'];
                              $bday = $row['Birthday'];
                              $contact = $row['ContactNo'];
                              
                              $street = decrypt($row['Street']);
                              $brgy = decrypt($row['Barangay']);
                              $city = $row['CityName'];

                              $status = $row['Status'];

                              echo
                              "<tr>
                                <td>$uid</td>
                                <td>$utype</td>
                                <td>$uname</td>
                                <td>$ln, $fn $mn</td>
                                <td>$gender</td>
                                <td>$bday</td>
                                <td>$email</td>
                                <td>$contact</td>
                                <td>$street, $brgy, $city</td>
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
              </form>
              </div> </div>
          <!-- /.box -->
                    <style type="text/css">
                    .dt-buttons {
                      margin-left: 50px;
                    }
                  </style>
                  <script>
                    $(document).ready(function() {
                      $('#user').DataTable( {
                        dom: 'l<".margin" B>frtip',
                        buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                      } );
                    } );
                  </script>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>
