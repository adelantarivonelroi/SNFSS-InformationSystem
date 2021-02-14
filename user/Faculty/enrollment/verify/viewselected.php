
<?php 
    # checks if record is selected
    if (isset($_REQUEST['id']))
    {
        # checks if selected record is an ID value
        if (ctype_digit($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            include_once('../../../../includes/header.php');
            validateAccess();
            validateFaculty();

            $label1 = "";
            $label2 = "";
            $label3 = "";
            $req1 = "";
            $req2 = "";
            $req3 = "";

            //validateAccess();

            # display existing record
            $sql_search = "SELECT StudentID, FirstName, MiddleName, LastName, Birthday, Gender, Address, StudentStatus 
                FROM students
                WHERE StudentID=$id";
            $result_search = $con->query($sql_search);

            # checks if record is not existing
            if (mysqli_num_rows($result_search) == 0)
            {
                header('location: index.php');
            }

            while ($row = mysqli_fetch_array($result_search))
            {
                $studid = $row['StudentID'];
                $status = $row['StudentStatus'];
                $fname = $row['FirstName'];
                $mname = $row['MiddleName'];
                $lname = $row['LastName'];
                $bday = $row['Birthday'];
                $gender = $row['Gender'];
                $address = $row['Address'];
            }

            if ( $status == "Not Enrolled") {
                $label1 = "<label>Status</label>";
                $label2 = "<label>Full name</label>";
                $label3 = "<label>List of requirements</label>";

                $req1 = "<p>Requirement number one.</p>";
                $req2 = "<p>Requirement number two.</p>";
                $req3 = "";

            } else {
              $label1 = "<label>Status</label>";
              $label2 = "<label>Full name</label>";
            }

            

            /*
            # updates existing record
            if (isset($_POST['return']))
            {

                $relpid = mysqli_real_escape_string($con, $_POST['relpid']);
                $ownid = mysqli_real_escape_string($con, $_POST['oid']);

                $sql_update ="UPDATE items SET 
                ownerID = $ownid,
                releasingPersonnelID = $uid,
                dateReturned = NOW(), 
                status = 'Returned',
                dataStatus = 'Active' WHERE itemID = $id";

                $con->query($sql_update) or die(mysqli_error($con));
                header('location: index.php');


            }
            */
          
        }
        else
        {
            header('location: index.php');
        }
    }
    else
    {
        header('location: index.php');
    }
?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="../../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Enrollment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../enrollment/entrance/index.php"><i class="fa fa-circle-o"></i>Entrance exam grade</a></li>
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Verify enrollee status</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Faculty Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../viewschedule.php"><i class="fa fa-circle-o"></i>View schedule</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Student Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../student/grade/index.php"><i class="fa fa-circle-o"></i>Encode grade</a></li>
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
        Enrollment
        <small>Check enrollee requirements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirements</li>
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
              <h3 class="box-title">Student requirements</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-2">
                    <?php echo $label1 ?> 
                  </div>
                  <div class="col-sm-2">
                    <?php echo "<span style='color:red'> $status </span>" ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <?php echo $label2 ?>
                  </div>
                  <div class="col-sm-2">
                    <?php echo $lname . ", " . $fname . " " . $mname ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <?php echo $label3 ?>
                  </div>
                  <div class="col-sm-2">
                    <?php echo $req1 ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <?php echo "" ?>
                  </div>
                  <div class="col-sm-2">
                    <?php echo $req2 ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-2">
                    <?php echo "" ?>
                  </div>
                  <div class="col-sm-2">
                    <?php echo $req3 ?>
                  </div>
                </div>
                <button onclick="history.go(-2);">Back </button>
                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Selected record</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <th>Student ID</th>
                  <th>Status</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Address</th>
                </thead>
                <tbody>
                  <?php
                      echo "
                        <tr>
                          <td>$studid</td>
                          <td>$status</td>
                          <td>$lname, $fname $mname</td>
                          <td>$bday</td>
                          <td>$gender</td>
                          <td>$address</td>
                        </tr>
                      ";
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
    include_once('../../../../includes/footer.php');
?>