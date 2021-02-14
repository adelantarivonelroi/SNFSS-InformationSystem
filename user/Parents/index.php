<?php
  $page_title = "Home Page";
  include_once('../../includes/header.php');
  validateAccess();
  validateParents();
  $sql_annoucements = "SELECT * FROM post WHERE PostTypeID = 1 AND Status = 'Active'";
  $result_annoucements = $con->query($sql_annoucements) or die(mysqli_error($con));

  $sql_enrollment = "SELECT * FROM post WHERE PostTypeID = 2 AND Status = 'Active'";
  $result_enrollment = $con->query($sql_enrollment) or die(mysqli_error($con));
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
      <h1>
        Parents Portal
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Enrollment Requirements</h3>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="enrollmentrequirements.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>Downloadable Forms</h3>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="downloadforms.php" class="small-box-footer"> Download Here <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- /.row -->
       <!-- left column -->
       <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Latest School Announcements</h3>
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
                    while ($row = mysqli_fetch_array($result_annoucements))
                    {
                      $pid = $row['PostID'];
                      $title = $row['Title'];
                      $attachment = $row['Attachment'];
                      $datecreated = $row['DateAdded'];
                      echo "
                        <tr>
                        <td>
                        <a href='viewdetailannouncement.php?id=$pid'>
                        $title
                        </a></td>
                          <td>$datecreated</td>
                          <td><a href='viewdetailannouncement.php?id=$pid' target='_blank' class='btn btn-info btn-info'>View</a></td>
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
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Enrollment Information </h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
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
                        <td><a href='viewdetailenrollmentreq.php?id=$eipid'>
                        $eititle
                        </a></td>
                        <td>$eidatecreated</td>
                        <td><a href='viewdetailenrollmentreq.php?id=$eipid' target='_blank' class='btn btn-info btn-info'>View</a></td>
                        </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
              <style type="text/css">
                    .dt-buttons {
                      margin-left: 50px;
                    }
                  </style>
                  <script>
                    $(document).ready(function() {
                      $('#user').DataTable( {
                        dom: 'l<".margin" B>frtip',
                        buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                      } );
                    } );
                  </script>
            </div>
            <script>
              $(document).ready(function() {
                $('table.display').DataTable();
              } );
            </script>
          </div>
        </div>
      </div>
    </form>
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
