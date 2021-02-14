<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateITPersonnel();
  $message = "";
  # retrieve search result

  $sql_search = $con->prepare("SELECT RoleID, RoleName FROM role ORDER BY RoleID DESC");
  $sql_search->execute();
  $result_search = $sql_search->get_result();

  if (isset ($_POST['create']))
  {

    if (!empty($_POST['newrole']))
    {
    $roleinput = clean_input($_POST['newrole']);

    $sql_insert = "INSERT INTO role ( RoleName ) VALUES ( '$roleinput' )";
    $con->query($sql_insert) or die(mysqli_error($con));

    header('location: addroles.php');
    }
    else
    {
      $message = "Text box must not be empty";
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
            <li><a href="addroles.php"><i class="fa fa-circle-o text-red"></i> <span>Add new role</span></a></li>
            <li><a href="viewuser.php"><i class="fa fa-circle-o text-red"></i> <span>Manage user(s)</span></a></li>
            <li><a href="viewarchiveuser.php"><i class="fa fa-circle-o text-red"></i> <span>View archived user(s)</span></a></li>
            <li class="header">Activity Logs</li>
            <li><a href="viewactivitylog.php"><i class="fa fa-circle-o text-red"></i> <span>View activity logs</span></a></li>
          </ul>
  </section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        User Management
        <small>Manage Roles</small>
      </h1>
    </section>
   
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Manage Roles</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST">
            <div class=box-body>
                    <div class="col-sm-7 ">
                      <div class="form-group">
                        <p class="control-label col-sm-3">Set new role</p>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" value="" name="newrole">  
                        </div>  
                        <div class="col-sm-3">
                          <button name="create" type="submit" class="btn btn-primary">Create</button><br>
                          <?php echo $message ?>
                        </div>
                      </div>
                    </div>
                </div>
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Current roles.</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-striped text-center">
                <thead>
                  <th>Role ID</th>
                  <th>Role Name</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_search))
                    {
                      $tid = $row['RoleID'];
                      $tname = $row['RoleName'];

                      echo "
                        <tr>
                          <td>$tid</td>
                          <td>$tname</td>
                          <td>
                              <a href='addrolesarchive.php?id=$tid' class='btn btn-sm btn-danger'>
                                  Archive
                              </a>
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
  
    <!-- /.content -->
  <!-- /.content-wrapper -->
<?php
    include_once('../../includes/footer.php');
?>