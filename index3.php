<?php
    $page_title = "Log in";
    include_once('includes/header-login.php');
    session_unset();
    session_destroy();


    if (isset($_POST['login']) && $_POST['g-recaptcha-response']!="")
    { 
        $uname = clean_input($_POST['uname']);
        $pw = hash('sha256', clean_input($_POST['pw']));

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
    
        $sql_login = $con->prepare("SELECT u.UserID, u.TypeID, t.TypeName FROM user u 
          INNER JOIN type t ON u.TypeID = t.TypeID 
          WHERE u.UserName=? AND u.Password=? AND u.Status != 'Archived'");
        $sql_login->bind_param('ss', $uname, $pw);
        $sql_login->execute();
        $result_login = $sql_login->get_result();

        if(mysqli_num_rows($result_login) > 0)
        {

          session_start();
          while($row = mysqli_fetch_array($result_login))
          {
            $_SESSION['userid'] = $row['UserID'];
            $_SESSION['typeid'] = $row['TypeID'];
            $_SESSION['usertype'] = $row['TypeName'];
          }
          validatePersonnel();
        } 
        else {
          echo "User failed to login";
        }
    }

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Welcome to the Sto Nino Formation and Science School - School Information System</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->

  <div class="login-box-body">
        <div class="login-logo">
    <a href="../../index2.html"><b>SNFSS</b>IS</a>
  </div>
  <div class="login-logo">
    <a href=""><img src="images/snfss-logo.JPG"></a>
  </div>
     <p class="login-box-msg">Sign in to start your session</p>
    <form action="" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name = "uname" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name = "pw" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <div class="g-recaptcha" data-theme="light" data-sitekey="6LeculEUAAAAAHEULDoI6UJLVUTtfD7xgSc4hAx-" style="transform:scale(1.20);-webkit-transform:scale(1.06);transform-origin:0 0;-webkit-transform-origin:0 0;">
        </div>
      </div>
       
      <div class="row">
        <div class="col-xs-8">
          <!-- <div class="g-recaptcha" data-sitekey="6LeculEUAAAAAHEULDoI6UJLVUTtfD7xgSc4hAx-"></div> -->
        </div>
        <!-- /.col -->   
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-danger btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>