
<?php 
    include_once('../../includes/header.php');
      # checks if record is selected
    if (isset($_SESSION['clearancestudentid']))
    {
        # checks if selected record is an ID value
        if (ctype_digit($_SESSION['clearancestudentid']))
        {
          $id = $_SESSION['clearancestudentid'];
          validateAccess();
          validateRegistrar();
          
          $sql_getclearance = "SELECT c.ClearanceDetailsID, c.StudentID, c.ClearanceDescription, c.DateCleared, c.Status, s.FirstName AS StuFirstName, s.MiddleName AS StuMiddleName, s.LastName AS StuLastName
          FROM clearancedetails c
          INNER JOIN students s
          ON c.StudentID = s.StudentID
          WHERE c.StudentID = $id";
          $result_getclearance = $con->query($sql_getclearance) or die(mysqli_error($con));


          /**$scheckboxes = isset($_POST['scheck_box']) ? $_POST['scheck_box'] : array();

          if(!empty($scheckboxes)) {
            foreach ($scheckboxes as $stuselected) {
              $sql_addtemp = "INSERT INTO  studentlist ( SchoolYearID, LevelID, SectionID, StudentID, Status ) VALUES ( $schoolyear, $lev, $secno, $stuselected, 'Temporary')";  
              $sql_assignstudent = "UPDATE students SET AssignStatus = 'Assigned' WHERE StudentID = $stuselected";  

              $con->query($sql_addtemp) or die(mysqli_error($con));
              $con->query($sql_assignstudent) or die(mysqli_error($con));
              $message = "Successfully added student to temporary list";
              header('location: studentlistcreate.php');
            }
          } **/


          $displayname = "";
          $sql_getname = "SELECT FirstName, MiddleName, LastName
          FROM students 
          WHERE StudentID = $id";
          $result_getname = $con->query($sql_getname) or die(mysqli_error($con));
          while($row = mysqlI_fetch_array($result_getname))
          {
              $fn = $row['FirstName'];
              $mn = $row['MiddleName'];
              $ln = $row['LastName'];

              $displayname = "Currently updating clearance record of student: <b>". $ln . ", " . $fn . " ". $mn . "</b>";
          }

          $messagestatus = "";
          $displaytopmenu = "";
          $buttons = "";

          $check ="";

          if (mysqli_num_rows($result_getclearance) > 0 )
          {
              $buttons = "
                <div class='box-footer text-center'>
                  <button name='update' type='submit' class='btn btn-success'>Cleared</button>
                </div>";

              $list_clearance = "";
              while($row = mysqlI_fetch_array($result_getclearance))
              {
                  $cdid = $row['ClearanceDetailsID'];
                  $sid = $row['StudentID'];
                  $cdesc = $row['ClearanceDescription'];
                  $cstat = $row['Status'];
                  $dc = $row['DateCleared'];
                  $fn = $row['StuFirstName'];
                  $mn = $row['StuMiddleName'];
                  $ln = $row['StuLastName'];

                  if ($cstat != "Pending")
                  {
                    $check = "checked='checked'";
                  }
                  else 
                  {
                    $check = "";
                  }


                  $list_clearance .= "
                        <tr>
                          <td><input type='checkbox' name='check_box[]' value='$cdid' $check /> </td>
                          <td>$cdesc</td>
                          <td>$cstat</td>
                          <td>$dc</td>
                          <td>
                          <a href='updateclearanceunclear.php?id=$cdid' class='btn btn-sm btn-danger'>
                          Unclear
                          </a>
                          </td>
                        </tr>";
              }
              
          } 
          else 
          {
              $list_clearance = "<b>User has no clearance record.</b>";
              $displaytopmenu = "<br><br>Create a clearance record. <button name='create' type='submit' class='btn btn-primary'>Create</button>";
          }

          if (isset($_POST['create']))
          {
            $sql_clearance1 = "INSERT INTO clearancedetails ( StudentID, ClearanceDescription, Status ) VALUES ( $id, 'Grade Clearance', 'Pending')";
            $con->query($sql_clearance1) or die (mysqli_error($con));
            $sql_clearance2 = "INSERT INTO clearancedetails ( StudentID, ClearanceDescription, Status ) VALUES ( $id, 'Accounting Clearance', 'Pending')";
            $con->query($sql_clearance2) or die (mysqli_error($con));
            $sql_clearance3 = "INSERT INTO clearancedetails ( StudentID, ClearanceDescription, Status ) VALUES ( $id, 'Library Clearance', 'Pending')";
            $con->query($sql_clearance3) or die (mysqli_error($con));
            $sql_clearance4 = "INSERT INTO clearancedetails ( StudentID, ClearanceDescription, Status ) VALUES ( $id, 'Payment Clearance', 'Pending')";
            $con->query($sql_clearance4) or die (mysqli_error($con));
            $sql_clearance5 = "INSERT INTO clearancedetails ( StudentID, ClearanceDescription, Status ) VALUES ( $id, 'Other Clearance', 'Pending')";
            $con->query($sql_clearance5) or die (mysqli_error($con));

            $string = "Created clearance record for student id " . $id;
            #audit add student
            $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
            $con->query($sql_audit) or die (mysqli_error($con));
            header('location: updateclearancestatus.php');
          }

          if (isset($_POST['update']))
          {
            $checkboxes = isset($_POST['check_box']) ? $_POST['check_box'] : array();
            if(!empty($checkboxes))
            {
              foreach ($checkboxes as $selected) {
                $sql_updatestatus = "UPDATE clearancedetails SET Status = 'Cleared', DateCleared = NOW() WHERE ClearanceDetailsID = $selected";
                $con->query($sql_updatestatus) or die (mysqli_error($con));
                $messagestatus = "Successfully updated clearance record.";
             
                /**$string = "Updated clearance record of student id " . $id;
                #audit add student
                $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
                $con->query($sql_audit) or die (mysqli_error($con)); **/
              }
            }
            header('location: updateclearancestatus.php');
          }
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

      <li class="header">Index</li>
      <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
      <li class="header">Enrollment Process</li>
      <li><a href="enrollmentsearch.php"><i class="fa fa-circle-o text-red"></i> <span>Check enrollee</span></a></li>
      <li><a href="enrollmentviewall.php"><i class="fa fa-circle-o text-red"></i> <span>View all enrollee</span></a></li>
      <li class="header">Student Record(s)</li>
      <li><a href="studentrecordmain.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student Record</span></a></li>
      <li class="header">Grade Encoding</li>
      <li><a href="encodefeature.php"><i class="fa fa-circle-o text-red"></i> <span>Update Encode Feature</span></a></li>
      <li class="header">Clearance</li>
      <li><a href="updateclearancesearch.php"><i class="fa fa-circle-o text-red"></i> <span>Update Clearance Status</span></a></li>
      <li class="header">Academic Year</li>
      <li><a href="addacademicyear.php"><i class="fa fa-circle-o text-red"></i> <span>Add academic year</span></a></li>
      <li class="header">Periodic Rating</li>
      <li><a href="updateperiodicrating.php"><i class="fa fa-circle-o text-red"></i> <span>Update Periodic Rating</span></a></li>
      <li class="header">Import Records</li>
      <li><a href="importstudent.php"><i class="fa fa-circle-o text-red"></i> <span>Import Student Record</span></a></li>
      <li><a href="importaddress.php"><i class="fa fa-circle-o text-red"></i> <span>Import Address Record</span></a></li>
      <li><a href="importenrollment.php"><i class="fa fa-circle-o text-red"></i> <span>Import Enrollment Record</span></a></li>

    </ul>
  </section>
<!-- /.sidebar -->
</aside>
                

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Clearance
        <small>Update clearance status</small>
      </h1>
    </section>

    <!-- Main content -->
    <form method="POST">
    <section class="content">
    <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Clearance </h3>
              </div>
                <div class="box-body">
                  <div class="col-md-5">
                    <i class="control-label">Update clearance status of a student.</i><br>
                    <p><?php echo $displayname ?></p>
                    <p><?php echo $messagestatus ?></p>
                    <?php echo $displaytopmenu ?>
                  </div>
                </div>
              </div>
              <div class="box box-primary">
               <div class="box-header with-border">
                <!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered table-hover text-center">
                    <thead>
                      <th></th>
                      <th>Clearance Details</th>
                      <th>Status</th>
                      <th>Date Cleared</th>
                      <th>Unclear</th>
                    </thead>
                      <tbody>
                        <?php echo $list_clearance ?>
                      </tbody>
                  </table>
                </div>
              </div>
                <!-- /.box-body -->
                <?php echo $buttons ?>
            
          </div>
        </div>  
    </section>
    </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->
<?php
    include_once('../../includes/footer.php');
?>