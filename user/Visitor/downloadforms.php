<?php
  $page_title = "Home Page";
  include_once('../../includes/header-visitor.php');

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
            <li class="header">News & Announcements</li>
            <li><a href="viewannouncements.php"><i class="fa fa-circle-o text-red"></i> <span>Announcements</span></a></li>
            <li><a href="enrollmentrequirements.php"><i class="fa fa-circle-o text-red"></i> <span>Enrollment Requirements</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Downloadable Forms
      </h1>
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
            <h3 class="box-title">Enrollment Forms</h3>
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
                    <th>Attachment</th>
                    <th>View</th>

                  </tr>
                </thead>
                <tbody>
                <?php
                    while ($row = mysqli_fetch_array($result_enrollment))
                    {
                      $eipid = $row['PostID'];
                      $eititle = $row['Title'];
                      $attachment = $row['Attachment'];
                      $datecreated = $row['DateAdded'];
                      echo "
                        <tr>
                        <td>
                        $eititle
                        </td>
                          <td>$datecreated</td>
                          <td>$attachment</td>
                          <td><a href='../StudentServicesOfficer/files/requirements/$attachment' target='_blank' class='btn btn-info btn-info'>View</a></td>
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
