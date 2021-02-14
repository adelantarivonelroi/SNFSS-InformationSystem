<?php 
	$page_title = "View Enrollee Record";
    include_once('../../../includes/faculty/header.php');
    //validateAccess();
    //validateAdmin();

?>

<body class="hold-transition skin-red sidebar-mini">
<div class="content-wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>[System Name]</b></span>
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
              <img src="<?php echo app_path ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">[Name]</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo app_path ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                [Name] - [User Type]
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
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
          <img src="<?php echo app_path ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>[Name of User]</p>
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
            <span>Enrollment</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../grades/entrance/"><i class="fa fa-circle-o"></i> Manage entrance exam</a></li>
            <li><a href="index.php"><i class="fa fa-circle-o"></i> Check enrollee requirement</a></li>

          </ul>
        </li>
    </section>
    <!-- /.sidebar -->
    </aside>

    <div class="main-panel">
            <div class="content">
	            <div class="container-fluid">
	                <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" data-background-color="blue">
                                    <h4 class="title">Student List</h4>
                                </div>
                                <div class="card-content table-responsive">
                       			
			                    	<form method="POST" class="form-horizontal">
										<div class="col-lg-12">
											<?php
												$sql_users = "SELECT u.StudentID, u.UserID, u.LevelID, u.GradeID, u.ClearanceID, t.StudentID, t.FirstName, u.LastName,u.Picture, u.Gender, 
											u.Birthday, u.Email, u.ContactNo, u.Address, u.MotherFirstName, u.MotherLastName, u.MotherOccupation, u.FatherFirstName, u.FatherLastName, u.FatherOccupation, u.StudentStatus, u.DateAdded, u.DateModified
												from users u 
												INNER JOIN types t ON u.StudentID = t.StudentID
												WHERE t.userType = 'Student'";

												$result_users = $con->query($sql_users);
											?>
											<table id="users" class="table table-hover">
												<thead>
													<th>Student ID</th>
													<th>User ID</th>
													<th>Level ID</th>
													<th>Grade ID</th>
													<th>Clearance ID</th>
													<th>First Name</th>
													<th>Middle Name</th>
													<th>Last Name</th>
													<th>Picture</th>
													<th>Gender</th>
													<th>Birthday</th>
													<th>Email</th>
													<th>ContactNo</th>
													<th>Address</th>
													<th>Mother First Name</th>
													<th>Mother Last Name</th>
													<th>Mother Occupation</th>
													<th>Father First Name</th>
													<th>Father Last Name</th>
													<th>Father Occupation</th>
													<th>Student Status</th>
													<th>Date Added</th>
													<th>Date Modified</th>
												</thead>
												<tbody>
													<?php
														while ($row = mysqli_fetch_array($result_users))
														{
															
															echo
															"<tr>
																
															</tr>";
														}
													?>
												</tbody>
											</table>								
										</div>
									</form>
									</div></div>
							<style type="text/css">
										.dt-buttons {
											margin-left: 50px;
										}
									</style>
							<script>
								$(document).ready(function() {
									$('#users').DataTable( {
										dom: 'l<".margin" B>frtip',
										buttons: [
										'copy', 'csv', 'excel', 'pdf', 'print'
										]
									} );
								} );
							</script>

						</div>
					</div>
	    		</div>
	    	</div>
	    </div>

		
<?php
	include_once('../../../includes/faculty/footer.php');
?>