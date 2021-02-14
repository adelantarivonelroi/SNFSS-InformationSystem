<?php 

    	$page_title="Sto. Nino Formation and Science ";
      include_once('../../includes/header.php');
      include_once('../../email/verify.php');
      include_once('../../email/PHPMailerAutoload.php');

      validateAccess();
      validateRegistrar();

      $displaymessage = "";
      $displaydeadline = "";
      $deadlinestatus = "";

      $sql_checktriggervalue = "SELECT TriggerValue  FROM `trigger` WHERE TriggerTypeID = 1 AND TriggerValue = 1";
      $result_checktriggervalue = $con->query($sql_checktriggervalue) or die($mysqli_error($con));

      if ( mysqli_num_rows($result_checktriggervalue) > 0)
      {
        $displaymessage = "Grade encode feature is now ON.";

      } else {
        $displaymessage = "Grade encode feature is now OFF.";
      }

      $sql_deadlinemessage = "SELECT DISTINCT MessageDesc FROM message ORDER BY MessageID DESC LIMIT 1";
      $result_dlmessage = $con->query($sql_deadlinemessage) or die($mysqli_error($con));

      if ( mysqli_num_rows($result_dlmessage) > 0)
      {
        while ( $row = mysqli_fetch_array($result_dlmessage))
        {
          $deadline = $row['MessageDesc'];
          $deadlinestatus = "Current deadline is set to " . $deadline;
        }
      } else {
        $displaydeadline = "Deadline has not been set yet.";
      }


      if(isset($_POST['update']))
      {
        $switch = mysqli_real_escape_string($con, $_POST['switchselect']);

        $sql_switch = "UPDATE `trigger` SET `TriggerValue` = $switch WHERE `TriggerTypeID` = 1";
        $con->query($sql_switch) or die(mysqli_error($con));

        $string = "Updated grade encoding status " . $switch;
        #audit add student
        $sql_audit = "INSERT INTO audit ( UserID, Description, LogDate )VALUES($uid, '$string', Now() )";
        $con->query($sql_audit) or die (mysqli_error($con));

        if ($switch == 0)
        {
          $displaymessage = "Grade encode feature is now OFF.";
        }
        else
        {
          $displaymessage = "Grade encode feature is now ON";
        }

      }

      if(isset($_POST['setdeadline']))
      {
        $sql_ifon = "SELECT * FROM `trigger` WHERE TriggerTypeID = 1 AND TriggerValue = 1";
        $result_ifon = $con->query($sql_ifon) or die(mysqli_error($con));
        if ( mysqli_num_rows($result_ifon) > 0 ) 
        {
          if (!empty($_POST['deadline']) )
          {
            $deadlineinput = clean_input($_POST['deadline']); 

            $sql_insertdeadline = $con->prepare("INSERT INTO message ( UserID, MessageDesc ) VALUES ( ?, ? )");

            $sql_insertdeadline->bind_param('is', $uid, $deadlineinput);
            $sql_insertdeadline->execute();

            #email
            $sql_check = "SELECT UserID, FirstName, LastName, Email, TypeID FROM user u 
              WHERE TypeID = 4";

            $result_check = $con->query($sql_check) or die(mysqli_error($con));
          
            if(mysqli_num_rows($result_check) > 0)
            {
              while ($row = mysqli_fetch_array($result_check))
              {
                $fn = $row['FirstName'];
                $ln = $row['LastName'];
                $email = $row['Email'];
                $userID = $row['UserID'];

                $mail = new PHPMailer(true);
                $mail->IsSMTP();      
                $mail->SMTPDebug = false;                                     // Set mailer to use SMTP
                $mail->SMTPAuth = true;                                     // Enable SMTP authentication
                $mail->SMTPSecure = 'ssl';                                  // Enable encryption, 'ssl' also accepted
                $mail->Host = 'smtp.gmail.com';                             // Specify main and backup server
                $mail->Port = 465;                                        //Set the SMTP port number - 587 for authenticated TLS
                $mail->isHTML(true);                                          // Set email format to HTML
                $mail->Username = 'jan.simbahon@gmail.com';                        // SMTP username
                $mail->Password = 'janlouis';                         // SMTP password
                $mail->setFrom('jan.simbahon@gmail.com', 'Sto Nino Formation Science School');     //Set who the message is to be sent from
                $mail->Subject = 'GRADE ENCODING DEADLINE UPDATE';

                $mail->Body    = '<b>Hi, '. $fn. '</b><br/><br/>'.' The encoding of grades will be only on the following dates: ' . $deadlineinput;
                $mail->AddAddress($email);  // Add a recipient
              
                $mail->Send();
              }
              $displaydeadline = "Deadline has been set and an email has been sent to all faculty.";
            }
            else 
            {
              echo "There are no users to send to."; //Added this for error checking purposes.
            }
          } 
          else
          {
            $displaydeadline = "Deadline textbox must not be empty.";
          }
        } 
        else
        {
          $displaydeadline = "Grade encode feature must be on to set deadline and send email.";
        }



        
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
        Student Record
        <small>Encode Feature</small>
      </h1>
    </section>

    <!-- Main content -->
    <form method="POST">
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Encode Feature</h3>
              </div>

              <div class="box-body">
                <div class="col-md-4">
                  <i class="control-label">Turn on or off the grading encode feature for the teachers.</i>
                  <?php echo $displaymessage ?>
                  <hr>
                </div>
              </div>

              <div class=box-body>
                  <div class="col-sm-7 ">
                    <div class="form-group">
                      <p class="control-label col-sm-3">Switch grade encode feature</p>
                      <div class="col-sm-3">
                        <select name="switchselect"  class="form-control" required>
                          <option value='0'>Off</option>
                          <option value='1'>On</option>
                        </select>   
                      </div>  
                      <div class="col-sm-3">
                        <button name="update" type="submit" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                </div>
              </div>
              <hr>
               <div class="box-body">
                <div class="col-md-4">
                  <i class="control-label">Set deadline and send an email to all faculty.</i><br>
                  <b><?php echo $deadlinestatus ?></b><br>
                  <?php echo $displaydeadline ?>
                  <hr>
                </div>
              </div>
              
              <div class=box-body>
                  <div class="col-sm-7 ">
                    <div class="form-group">
                      <p class="control-label col-sm-3">Set deadline</p>
                      <div class="col-sm-3">
                        <input type="text" name="deadline"  class="form-control">
                      </div>  
                      <div class="col-sm-3">
                        <button name="setdeadline" type="submit" class="btn btn-primary">Confirm</button>
                      </div>
                    </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </section>
    </form>
    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>