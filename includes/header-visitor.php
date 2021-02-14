<!-- <?php
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
     
    if(isset($_SESSION['userid']))
    {   
        $uid = $_SESSION['userid'];
        $sql_display = "SELECT u.FirstName, u.LastName,t.TypeName FROM user u INNER JOIN type t ON u.TypeID = t.TypeID
        WHERE u.UserID=$uid";

        $result_display = $con->query($sql_display) or die(mysqli_error($con));

        while($row = mysqli_fetch_array($result_display))
        {
            $fn = $row['FirstName'];
            $ln = $row['LastName'];

            $userName = $fn . ' ' . $ln;
            $userType= $row['TypeName'];


        }
    }
?> -->

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
        <link rel="stylesheet" href="<?php echo app_path ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
               folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo app_path ?>dist/css/skins/skin-red.min.css">
        <!-- Google Font -->
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        
        <script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>


        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>


        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.4.2/js/buttons.colVis.min.js"></script>
        

    </head>

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>IS</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>SNFSS-SIS</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
            
                    
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs">Guest User</span>
                        </a>
                    </li>
          </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p><?php echo $fn ." ". $ln ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview menu-open">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>[Page Name]</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="index.html"><i class="fa fa-circle-o"></i>[Page Name]</a></li>
                        <li><a href="index2.html"><i class="fa fa-circle-o"></i>[Page Name]</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-laptop"></i>
                        <span>[Page Name]</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                        <li><a href="#"><i class="fa fa-circle-o"></i> [Page Name]</a></li>
                    </ul>
                </li>
        </section>
        <!-- /.sidebar -->
      </aside>

        <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
                

        