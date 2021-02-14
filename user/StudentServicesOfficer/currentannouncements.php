<?php
  $page_title = "Current Announcements";
  include_once('../../includes/header.php');
  validateAccess();
  validateStudentServicesOfficer();

  $sql_annoucements = "SELECT p.PostID
  , p.PostTypeID
  , p.Title
  , p.Description
  , p.Image
  , p.Attachment
  , p.DateAdded
  , p.DateModified
  , p.Status
  , u.FirstName
  , u.LastName
  , pt.PostName

  FROM post p 
  INNER JOIN user u 
  ON p.UserID = u.UserID 
  INNER JOIN posttype pt 
  ON p.PostTypeID = pt.PostTypeID
  WHERE p.PostTypeID = 1 AND p.Status = 'Active' ";

  $result_announcements = $con->query($sql_annoucements) or die(mysqli_error($con));
 ?>


  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="currentannouncements.php"><i class="fa fa-circle-o text-red"></i> <span>Current Announcements</span></a></li>
            <li><a href="enrollmentrequirements.php"><i class="fa fa-circle-o text-red"></i> <span>Enrollment Requirement(s)</span></a></li>
            <li><a href="viewarchiveposts.php"><i class="fa fa-circle-o text-red"></i> <span>Archived post(s)</span></a></li>
            <li class="header">Feedback</li>
            <li><a href="feedback.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="feedbackcreate.php"><i class="fa fa-circle-o text-red"></i> <span>Create Feedback</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Current Announcements
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Announcements</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
                <form method="POST" class="form-horizontal">
                    <div class="col-lg-12">
                      <table id="user" class="table table-hover">
                        <thead>
                          <th>PostID</th>
                          <th>Post Type</th>
                          <th>Title</th>
                          <th>DateAdded</th>
                          <th>DateModified</th>
                          <th>Posted By</th>
                          <th>Status</th>
                          <th>View/Update</th>
                          <th>Archive</th>
                        </thead>
                        <tbody>
                          <?php
                            while ($row = mysqli_fetch_array($result_announcements))
                            {
                              $pid = $row['PostID'];
                              $pt = $row['PostName'];
                              $title = $row['Title'];
                              $dateadded = $row['DateAdded'];
                              $datemodified = $row['DateModified'];
                              $ln = $row['LastName'];
                              $fn = $row['FirstName'];
                              $status = $row['Status'];
                              echo "
                                <tr>
                                  <td>$pid</td>
                                  <td>$pt</td>
                                  <td>$title</td>
                                  <td>$dateadded</td>
                                  <td>$datemodified</td>
                                  <td>$ln, $fn</td>
                                  <td>$status</td>
                                  <td>
                                  <a href='viewdetailannouncement.php?id=$pid' class='btn btn-xs btn-info'>
                                        <i class='fa fa-edit'></i>
                                  </a>
                                  </td>
                                  <td>
                                  <a href='archiveannouncement.php?id=$pid' class='btn btn-xs btn-info'>
                                        <i class='fa fa-trash'></i>
                                  </a>
                                  </td>
                                </tr>
                              ";
                            }
                          ?>
                        </tbody>
                      </table>                
                    </div>
                  </div>
                  <!-- /.box-body -->
                </form>
              </div>
              <!-- /.box -->
              <script>
                $(document).ready(function(){
                  $('#user').DataTable();
                });
              </script>
              <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>

