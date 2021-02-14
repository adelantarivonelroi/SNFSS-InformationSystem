<?php
  $page_title = "Home Page";
  include_once('../../includes/header.php');
  validateAccess();
  validateParents();
  $sql_feedback = "SELECT * FROM feedback";
  $result_feedback = $con->query($sql_feedback) or die(mysqli_error($con));

  if(isset($_POST['create'])) 
    {
      $title = mysqli_real_escape_string($con, $_POST['title']);
      $description = mysqli_real_escape_string($con, $_POST['description']);
      $sql_send = "INSERT INTO feedback VALUES ( '', $uid, '$title', '$description', NOW() )";
      $con->query($sql_send) or die(mysqli_error($con));
      header('location: feedbackcreate.php');
    }
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
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-8 col-xs-8">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>Feedback</p>
            </div>
            <div class="icon">
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-4">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>Message Box</p>
            </div>
            <div class="icon">
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
       <!-- left column -->
       <div class="col-md-8">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Message</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form method="post">
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Subject</label>
                  <input type="text" class="form-control" value="" name="title" required>
                </div>
              </div>
            <div class="box-header with-border">
            </div>
              <div class="box-body">
                <div class="col-md-12">
                  <label>Message</label>
                  <textarea class="form-control" name="description" rows="3" value=""></textarea>
                </div>
              </div>        
              <!-- /.box-body -->

              <div class="box-footer">
                <button name="create" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Reply
                </button>
              </div>
          </form>

        </div>

      </div>
      <!--/.col (left) -->
      <!-- right column -->
      <div class="col-md-4">
        <!-- Horizontal Form -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Select message below</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <table id="" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>State</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_feedback))
                    {
                      $fbid = $row['feedbackid'];
                      $ftitle = $row['title'];
                      $fdate = $row['datesent'];
                      echo "
                        <tr>
                          <td>$fdate</td>
                          <td>$ftitle
                          </td>
                          <td>
                          <a href='feedbackview.php?id=$fbid' class='btn btn-xs btn-info'>View           
                          </a></td>
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
