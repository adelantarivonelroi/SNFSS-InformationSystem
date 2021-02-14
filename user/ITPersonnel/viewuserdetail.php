<?php
  $page_title = "View User Detail";
  include_once('../../includes/header.php');
  validateAccess();
  validateITPersonnel();

    if (isset($_REQUEST['id']))
    {
        if(ctype_digit($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];

            # list of cities
            $sql_city = "SELECT cityid, cityname FROM city ORDER BY cityname ASC";
            $result_city =$con->query($sql_city);

             $list_city = "";
             while($row = mysqli_fetch_array($result_city))
             {
                $cityID= $row['cityid'];
                $cityName= $row['cityname'];

                $sql_cityselect = "SELECT c.CityID FROM user u INNER JOIN address a ON u.AddressID = a.AddressID INNER JOIN city c ON a.CityID = c.CityID WHERE u.UserID = $id";
                $result_cityselect = $con->query($sql_cityselect);

                while ( $row2 = mysqli_fetch_array($result_cityselect))
                {
                  $usercity = $row2['CityID'];
                }

                if ($cityID == $usercity)
                {
                  $list_city .="<option value='$cityID' selected='selected'>$cityName</option>";
                }
                else 
                {
                  $list_city .="<option value='$cityID'>$cityName</option>";
                }
             }

             # list of types
            $sql_type = "SELECT TypeID, TypeName FROM type ORDER BY typeID ASC";
            $result_type =$con->query($sql_type);

             $list_usertype = "";
             while($row = mysqli_fetch_array($result_type))
             {
                $typeid= $row['TypeID'];
                $typename= $row['TypeName'];

                $sql_typeselect = "SELECT TypeID FROM user u  WHERE u.UserID = $id";
                $result_typeselect = $con->query($sql_typeselect);

                while ( $row2 = mysqli_fetch_array($result_typeselect))
                {
                  $usertype = $row2['TypeID'];
                }

                if ($typeid == $usertype)
                {
                  $list_usertype .="<option value='$typeid' selected='selected'>$typename</option>";
                }
                else 
                {
                  $list_usertype .="<option value='$typeid'>$typename</option>";
                }
             }

            $sql_data = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, u.Password, u.Email, u.ContactNo, u.AddressID, u.Role, a.Street, a.Barangay, c.CityName, u.Status, u.DateAdded, u.DateModified 
            FROM user u 
            INNER JOIN type t 
            ON u.TypeID = t.TypeID 
            INNER JOIN  address a 
            ON u.AddressID = a.AddressID
            INNER JOIN  city c 
            ON a.CityID = c.CityID
            WHERE u.UserID = $id";

            $result_data = $con->query($sql_data);
            if(mysqli_num_rows($result_data) == 0)
            {
                header('location: /snfss/user/ITPersonnel/viewuser.php');
            }
            while ($row = mysqli_fetch_array($result_data))
            {
              $uid = $row['UserID'];
              $tid = $row['TypeID'];
              $tn = $row['TypeName'];
              $uname = $row['UserName'];
              $fn = $row['FirstName'];
              $mn = $row['MiddleName'];
              $ln = $row['LastName'];
              $pw = $row['Password'];
              $rpw = $row['Password'];
              $gender = $row['Gender'];
              $bday = $row['Birthday'];
              $email = $row['Email'];
              $contact = $row['ContactNo'];
              
              $addressid = $row['AddressID'];
              $role = $row['Role'];

              $street = decrypt($row['Street']);
              $brgy = decrypt($row['Barangay']);
              $city = $row['CityName'];
                              
              $status = $row['Status'];
              $dateAdded = $row['DateAdded'];
              $dateModified = $row['DateModified'];
            }

            if(isset($_POST['update']))
            {
                $tid = mysqli_real_escape_string($con, $_POST['usertype']);
                //not needed $tn = mysqli_real_escape_string($con, $_POST['TypeName']);
                $uname = mysqli_real_escape_string($con, $_POST['uname']);
                $fn = mysqli_real_escape_string($con, $_POST['fn']);
                $mn = mysqli_real_escape_string($con, $_POST['mn']);
                $ln = mysqli_real_escape_string($con, $_POST['ln']);
                $gender = mysqli_real_escape_string($con, $_POST['gender']);

                $bday = mysqli_real_escape_string($con, $_POST['bday']);
                $newbday = date("Y-m-d", strtotime($bday));
                $role = mysqli_real_escape_string($con, $_POST['role']);
                $email = mysqli_real_escape_string($con, $_POST['email']);
                $contact = mysqli_real_escape_string($con, $_POST['contact']);
                //there's no textbox for this $stat = mysqli_real_escape_string($con, $_POST['Status']);
            /*
            if(empty($pw) AND empty($rpw))
            { */
                $sql_update = "UPDATE user SET 
                TypeID = '$tid',
                UserName = '$uname',
                FirstName = '$fn',
                MiddleName = '$mn',
                LastName = '$ln',
                Gender = '$gender',
                Birthday = '$newbday',
                Email = '$email',
                ContactNo = '$contact',
                Role = '$role',
                DateModified = NOW()

                WHERE UserID = $id";

                // removed in query Status = '$stat',

                $con->query($sql_update)or die(mysqli_error($con));

                $st = encrypt(clean_input($_POST['street']));
                $brgy = encrypt(clean_input($_POST['barangay']));
                $cid = clean_input($_POST['cityid']);

                $sql_updateadd = "UPDATE address SET 
                Street = '$st',
                Barangay = '$brgy',
                CityID = '$cid'

                WHERE AddressID = $addressid";

                // removed in query Status = '$stat',

                $con->query($sql_updateadd)or die(mysqli_error($con));
                header('location: /snfss/user/ITPersonnel/viewuser.php');
            }
            /*
            else
            {
                header('location:/snfss/user/Admin/Accounts/viewuser.php');  
            } */
          }
    }
    /*
            else if (!empty($pw) AND empty($rpw))
            {
                echo "<script type='text/javascript'>alert('Password Does Not Match, Please Re-type!')</script>";
            }    
            else if(empty($pw) AND !empty($rpw))
            {
                echo "<script type='text/javascript'>alert('Password Does Not Match, Please Re-type!')</script>";
            }
            else if (!empty($pw) AND !empty($rpw))
            {
                if($pw === $rpw)
                {
                    $pwd = hash('sha256', $pw);
                    $sql_update = "UPDATE user SET 
                    TypeID = '$tid',
                    UserName = '$uname',
                    FirstName = '$fn',
                    MiddleName = '$mn',
                    LastName = '$ln',
                    Gender = '$gender',
                    Birthday = '$bday',
                    Email = '$email',
                    ContactNo = '$contact',
                    Address = '$address',
                    Status = '$stat',
                    DateModified = NOW()
                    WHERE UserID = $id";


                    $result = $con->query($sql_update) or die(mysqli_error($con));
                    header('location: /snfss/user/Admin/Accountss/viewuser.php');
                 }
                    else{
                        echo "<script type='text/javascript'>alert('Password Does Not Match, Please Re-type!')</script>";
                    }
            }
                else{
                    echo "<script type='text/javascript'>alert('Password Does Not Match, Please Re-type!')</script>";
                }  
        }
    }
    */
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
    <section class="content-header">
      <h1>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">User Detail for <?php echo $fn ." ". $ln ?> </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Username(*)</label>
                  <input type="text" class="form-control" value="<?php echo $uname; ?>" name="uname" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Password(*)</label>
                   <input type="password" class="form-control" value="<?php echo $pw ?>" name="pw" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Re-Type Password(*)</label>
                  <input type="password" class="form-control" value="<?php echo $rpw ?>" name="rpw" required>
                </div>
              </div>

            <div class="box-header with-border">
              <p class="box-title">Personal Information</p>
            </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">First Name(*)</label>
                  <input type="text" class="form-control" value="<?php echo $fn; ?>" name="fn" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Middle Name</label>
                   <input type="text" class="form-control" value="<?php echo $mn; ?>" name="mn">
                </div>
                <div class="col-md-4">
                  <label class="control-label">Last Name(*)</label>
                   <input type="text" class="form-control" value="<?php echo $ln; ?>" name="ln" required>
                </div>
              </div>
               <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Gender(*)</label>
                  <select name="gender"  class="form-control" required>
                      <option value='Male'>Male</option>
                      <option value='Female'>Female</option>
                  </select>  
                </div>
                <div class="col-md-4">
                  <label class="control-label">Birthday(*)</label>
                  <input type="date" class="form-control" value="<?php echo $bday; ?>" name="bday" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Email</label>
                  <input type="email" class="form-control" value="<?php echo $email; ?>" name="email">
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Contact No.</label>
                    <input type="text" class="form-control" value="<?php echo $contact; ?>" name="contact">
                </div>

              <div class="col-md-4">
                  <label class="control-label">Role</label>
                    <input type="text" class="form-control" value="<?php echo $role; ?>" name="role" required> 
                </div>
              </div>

              <div class="box-body">
                <!-- NEW ADDRESS PART -->
                <div class="col-md-4">
                  <label for="address" class="control-label">Street</label>
                    <input type="text" value="<?php echo $street; ?>" name="street"  class="form-control" required>
                </div>

                <div class="col-md-4">
                  <label for="address" class="control-label">Barangay</label>
                    <input type="text" value="<?php echo $brgy; ?>" name="barangay"  class="form-control" required>
                </div>

                <div class="col-md-4">
                  <label class="control-label">City</label>
                    <select name="cityid" class="form-control" required>
                      <option>
                      </option>
                        <?php echo $list_city; ?>
                    </select>     
                </div>

              </div>

              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">City</label>
                    <select name="usertype" class="form-control" required>
                      <option>
                      </option>
                        <?php echo $list_usertype; ?>
                    </select>     
                </div>
              </div>
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button name="update" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Update
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
