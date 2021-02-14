<?php
   ob_start(); # Quick fix to 'Warning: Cannot modify header information - headers already sent by...'
    
    # sets path of application folder
    $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $port      = $_SERVER['SERVER_PORT'];
    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
    $domain    = $_SERVER['SERVER_NAME'];

    define('app_path', "${protocol}://${domain}${disp_port}" . '/snfss/');

    require($_SERVER['DOCUMENT_ROOT'] . '/snfss/config.php');
    require($_SERVER['DOCUMENT_ROOT'] . '/snfss/function.php');
    $visible = true;
     session_start();
     
    /** 
    if(isset($_SESSION['userid']))
    {   
        $uid = $_SESSION['userid'];
        $sql_display = "SELECT u.FirstName, u.LastName,t.userType FROM user u INNER JOIN type t ON u.TypeID = t.TypeID
        WHERE u.userID=$uid";

        $result_display = $con->query($sql_display) or die(mysqli_error($con));

        while($row = mysqli_fetch_array($result_display))
        {
            $fn = $row['firstName'];
            $ln = $row['lastName'];

            $userName = $fn . ' ' . $ln;
            $userType = $row['userType'];


        }
    }
    **/
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sto. Nino Formation and Science School| Dashboard<</title>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo app_path ?>assets/img/apple-icon.png" />
        <link rel="icon" type="image/png" href="<?php echo app_path ?>assets/img/icon.png" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />    
        
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?php echo app_path ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo app_path ?>bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo app_path ?>bower_components/Ionicons/css/ionicons.min.css">
        <!-- DataTables -->
        <link rel="stylesheet" href="<?php echo app_path ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo app_path ?>dist/css/AdminLTE.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
               folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo app_path ?>dist/css/skins/skin-red.min.css">
        <!-- Google Font -->
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <!-- Captcha Script -->
        <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>



        