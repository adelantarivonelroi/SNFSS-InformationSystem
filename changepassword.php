<?php
  $page_title = "Home Page";
  include_once('includes/header.php');
  include_once('email/verify.php');
  include_once('email/PHPMailerAutoload.php');
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


    if (isset($_POST['submit']))
    { 
      //Retrieve muna new password inputs.
      $newpassword = mysqli_real_escape_string($con, $_POST['newpassword']);
      $newpasswordretype = mysqli_real_escape_string($con, $_POST['newpasswordretype']);

      $recaptcha_secret = "6LeculEUAAAAAGXksV67p3yE7td--QQABeoPmv9f";
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$recaptcha_secret."&response=".$_POST['g-recaptcha-response']);
        $response = json_decode($response, true);
        if($response["success"] === true)
        {
            echo "Logged In Successfully";
        }
        else
        {
            echo "You are a robot";
        }
      //If same then execute below code, else echo nalang ng error message.
      if ( $newpassword == $newpasswordretype) 
      {

        //Either works, $newpassword or $newpasswordretype. Since namagkaparehas naman sila.
        //I hashed it here so that, it displays a hashed value in the link. 
        $changepassword = hash('sha256', mysqli_real_escape_string($con, $newpasswordretype)); 

        //Now, kukunin natin UserID ng nakalogged in, since nasa header.php naman at naka include na ito. Pwede na siya icall directly at yun at $uid.
        $userid = mysqli_real_escape_string($con, $uid); 

        //Kukunin naman natin mga pang fill up sa message part ng email natin and forms. ( By forms, I mean yung mga i-necho na user information dito sa page. ) 
        $sql_check = "SELECT UserID, FirstName, LastName, Email FROM user u 
          WHERE UserID = $userid";

        //This is to retrieve values from the selected row.  
        $result_check = $con->query($sql_check) or die(mysqli_error($con));
      
        if(mysqli_num_rows($result_check) > 0)
        {
          while ($row = mysqli_fetch_array($result_check))
          {
            $fn = $row['FirstName'];
            $ln = $row['LastName'];
            $email = $row['Email'];
            $userID = $row['UserID'];

            //$userName = $row['UserName']; Since $uid gamit naten sa pagidentify ng user. Comment out ko muna ito. 

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
            $mail->Subject = 'Password Confirmation';

            //I changed the link and the values it will carry. 
            //The new password $changepassword goes here along with the $userid.
            $mail->Body    = '<b>Hi, '. $fn. '</b><br/><br/>'.' The system will now update your password, when you click the verification link. '. '<br/><br/>'.'http://localhost/snfss/verificationpage.php?a='.$userID.'&b='.$changepassword.'<br/><br/>'.'If you did not request a password reset, please ignore this email.'.'<br/><br/><br/>Thanks, <br/<br/><br/> SNFSS-SIS.';
            $mail->AddAddress($email);  // Add a recipient
          
            if($mail->Send())
            {
              echo "<script type='text/javascript'>alert('Email Send!')</script>";
                header("Location: changepassword.php"); //Changed php name to newly created. Which is this.
                die();
            }
          }  
        } else 
        {
          echo "User does not exists."; //Added this for error checking purposes.
        }
      }
    }


/*    $sql_users = "SELECT u.UserID, u.TypeID, t.TypeName, u.UserName, u.FirstName, u.MiddleName, u.LastName, u.Gender, u.Birthday, 
    u.Email, u.ContactNo, u.Address, u.Status, u.DateAdded, u.DateModified
    from user u 
    INNER JOIN type t ON u.TypeID = t.TypeID  WHERE u.Status != 'Archive'";
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
      $address = $row['Address'];
      $status = $row['Status'];
    }*/

  // $newpassword;$newpasswordretype;$recaptcha;
  //       if(isset($_POST['newpassword']))
  //         $newpassword=$_POST['newpassword'];
  //       if(isset($_POST['newpasswordretype']))
  //         $newpasswordretype=$_POST['newpasswordretype'];
  //       if(isset($_POST['g-recaptcha-response']))
  //         $recaptcha=$_POST['g-recaptcha-response'];

  //       if(!$recaptcha){
  //         echo '<h2>Please check the the captcha form.</h2>';
  //         exit;
  //       }
  //       $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeculEUAAAAAGXksV67p3yE7td--QQABeoPmv9f&response=".$recaptcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
  //       if($response['success'] == false)
  //       {
  //         echo '<h2>You are spammer ! Get lost</h2>';
  //       }
  //       else
  //       {
  //         echo '<h2>Thanks.</h2>';
  //       }

    // if (isset($_POST['submit'])) {
    //   $newpass = $_POST['newpassword'];
    //   $newpassretype = $_POST['newpasswordretype'];
    //   $secretKey = "6LeculEUAAAAAGXksV67p3yE7td--QQABeoPmv9f";
    //   $responseKey = $_POST['g-recaptcha-response'];
    //   $userIP = $_SERVER['REMOTE_ADDR'];

    //   $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    //   $response = file_get_contents($url); 
    //   echo $response;
    // }



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
              </div>
            <div class="box-header with-border">
              <p class="box-title">Change Password</p>
            </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Enter new password</label>
                  <input type="password" class="form-control" value="" name="newpassword">
                </div>
              </div>
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Re-enter new password</label>
                  <input type="password" class="form-control" value="" name="newpasswordretype">
                  <br>
               <div class="g-recaptcha" data-theme="light" data-sitekey="6LeculEUAAAAAHEULDoI6UJLVUTtfD7xgSc4hAx-" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div> 
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <div class="form-group">
                  <div class="col-lg-offset-4 col-lg-10">
                    <button name="submit" onclick="return confirm('Are you sure?')" type="submit" class="btn btn-success">
                      Change
                    </button>
                    <a href="viewprofile.php" class="btn btn-default">
                      Cancel
                    </a>
                  </div>
                </div>

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