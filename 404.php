<?php 
 include_once('includes/header.php');
 
   $usertype = $_SESSION['usertype'];
  if ($usertype == 'Principal')
  {
    $link = 'index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Parents')
  {
    $link ='index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
  if ($usertype == 'Faculty')
  {
    $link ='index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Student Services Officer')
  {
    $link ='index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if ($usertype == 'Registrar')
  {
    $link ='index.php';
    $home = 'dashboard';
    $Home = 'Dashboard';
  }
    if($usertype == 'IT Personnel')
    {
      $link ='index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

    if($usertype == 'Department Head')
    {
      $link ='index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }

    if($usertype == 'Visitor')
    {
      $link = 'index.php';
      $home = 'dashboard';
      $Home = 'Dashboard';
    }
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Home</li>
             <li><a href="<?php echo $link ?>"><i class="fa fa-circle-o text-red"></i> <span><?php echo $Home ?></span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

 <section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>

          <p>
            We could not find the page you were looking for.
            Meanwhile, you may <a href="<?php echo $link ?>">return to <?php echo $Home ?></a>
          </p>
            </div>
            <!-- /.input-group -->
          </form>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>
    <!-- /.content -->
  </div>

</html>