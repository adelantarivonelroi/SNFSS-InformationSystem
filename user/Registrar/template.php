<?php 

    	$page_title="Sto. Nino Formation and Science ";
      include_once('../../includes/header.php');
      include_once('../../email/verify.php');
      include_once('../../email/PHPMailerAutoload.php');

      validateAccess();
      validateRegistrar();

      $displaymessage = "";

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

        $changepassword = hash('sha256', mysqli_real_escape_string($con, $newpasswordretype)); 
        $userid = mysqli_real_escape_string($con, $uid); 
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

            $mail->Body    = '<b>Hi, '. $fn. '</b><br/><br/>'.' The deadline for the grade encoding will be on the second week of April. God bless.';
            $mail->AddAddress($email);  // Add a recipient
          
            $mail->Send();
          }
        } else 
        {
          echo "There are no users to send to."; //Added this for error checking purposes.
        }

      }

?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Enrollment Process</li>
      <li><a href="enrollmentsearch.php"><i class="fa fa-circle-o text-red"></i> <span>Check enrollee</span></a></li>
      <li><a href="enrollmentviewall.php"><i class="fa fa-circle-o text-red"></i> <span>View all enrollee</span></a></li>
      <li class="header">Student Record(s)</li>
      <li><a href="studentrecordmain.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student Record</span></a></li>
      <li class="header">Grade Encoding</li>
      <li><a href="encodefeature.php"><i class="fa fa-circle-o text-red"></i> <span>Update Encode Feature</span></a></li>
      <li class="header">Clearance</li>
      <li><a href="updateclearancesearch.php"><i class="fa fa-circle-o text-red"></i> <span>Update Clearance Status</span></a></li>
      <li class="header">Periodic Rating</li>
      <li><a href="updateperiodicrating.php"><i class="fa fa-circle-o text-red"></i> <span>Update Periodic Rating</span></a></li>
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

              <!-- dito mga fields textbox labels etc-->

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