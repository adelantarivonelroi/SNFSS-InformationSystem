<?php
  $page_title = "Current Announcements";
  include_once('../../includes/header.php');

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
  WHERE p.PostTypeID = 2 AND p.Status = 'Active' ";

  $result_enrollment = $con->query($sql_annoucements) or die(mysqli_error($con));
 ?>

  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="downloadforms.php"><i class="fa fa-circle-o text-red"></i> <span>Downloadable Forms</span></a></li>
            <li><a href="viewstudentgrade.php"><i class="fa fa-circle-o text-red"></i><span>View Student Grade</span></a></li>
            <li class="header">Feedback</li>
            <li><a href="feedback.php"><i class="fa fa-circle-o text-red"></i> <span>Feedback</span></a></li>
            <li><a href="feedbackcreate.php"><i class="fa fa-circle-o text-red"></i> <span>Create Feedback</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

        
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
     <!-- /.row -->
       <!-- left column -->
       <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Enrollment Requirements</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <table id="" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Announcement</th>
                    <th>Date</th>
                    <th>View Announcement</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    while ($row = mysqli_fetch_array($result_enrollment))
                    {
                      $eipid = $row['PostID'];
                      $eititle = $row['Title'];
                      $eidatecreated = $row['DateAdded'];
                      echo "
                        <tr>
                        <td>$eititle</td>
                        <td>$eidatecreated</td>
                        <td><a href='viewdetailenrollmentreq.php?id=$eipid' target='_blank' class='btn btn-info btn-info'>View</a></td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>
            <script>

              $(document).ready(function() {
                $('table.display').DataTable();
              } );
            </script>
          </form>
        </div>
      </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>
