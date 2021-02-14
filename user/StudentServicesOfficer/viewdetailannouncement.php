 
<?php
  $page_title = "Register User";
  include_once('../../includes/header.php');
  validateAccess();
  validateStudentServicesOfficer();

  if (isset($_REQUEST['id']))
  {
    # checks if selected record is an ID value
    if (ctype_digit($_REQUEST['id']))
    {
      $id = $_REQUEST['id'];

      $sql_annoucements = "SELECT * FROM post p WHERE PostID = $id";
      $result_annoucements = $con->query($sql_annoucements) or die(mysqli_error($con));

      while ( $row = mysqli_fetch_array($result_annoucements))
      {
        $uid = $row['UserID'];
        $posttypeid = $row['PostTypeID'];
        $title = $row['Title'];
        $description = $row['Description'];
        $image = $row['Image'];
        $attachment = $row['Attachment'];
        $dateadded = $row['DateAdded'];
        $datemodified = $row['DateModified'];
        $status = $row['Status'];

        $sql_getname = "SELECT u.FirstName, u.LastName FROM post p INNER JOIN user u ON p.UserID = u.UserID WHERE u.UserID = $uid";
        $result_getname = $con->query($sql_getname) or die(mysqli_error($con));

        while ( $row2 = mysqli_fetch_array($result_getname)) 
        {
          $pln = $row2['LastName'];
          $pfn = $row2['FirstName'];
        }
      }

      if( isset($_POST['update'])) {
          $utitle = mysqli_real_escape_string($con, $_POST['title']);
          $udescription = mysqli_real_escape_string($con, $_POST['description']);
          $uimage = mysqli_real_escape_string($con, $_POST['image']);
          $uattachment = mysqli_real_escape_string($con, $_POST['attachment']);

          $sql_update = "UPDATE post SET 
          Title = '$utitle',
          Description = '$udescription',
          Image = '$uimage',
          Attachment = '$uattachment',
          DateModified = NOW()
          WHERE PostID = $id";

          $con->query($sql_update) or die(mysqli_error($con));
           header('location: viewdetailannouncement.php');
        }

        if ( isset ($_POST['back']))
        {
          header('location: currentannouncements.php');
        }
    }
    else
    {
      header('location: currentannouncements.php');
    }
  } 
  else
  {
    header('location: currentannouncements.php');
  }
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

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Announcement Detail of Post ID #<?php echo $id ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post">
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Title</label>
                  <input type="text" class="form-control" value="<?php echo $title ?>" name="title" required>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Date Added</label>
                  <input type="email" class="form-control" value="<?php echo $dateadded ?>" name="dateadded" readonly>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Date Modified</label>
                  <input type="email" class="form-control" value="<?php echo $datemodified ?>" name="datemodified" readonly>
                </div>
              </div>
            <div class="box-header with-border">
              <p class="box-title">Content</p>
            </div>
              <div class="box-body">
                <div class="col-md-12">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="3" value=""><?php echo $description ?></textarea>
                </div>
              </div>
               <div class="box-body">
                <div class="col-md-4">
                  <label for="exampleInputFile">View Image</label>
                  <p class="help-block">Image Uploaded</p>
                  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 210px; max-height: 160px;">
                    <img src='<?php echo app_path ?>user/StudentServicesOfficer/files/image/<?php echo $image ?>'  alt='No Picture Available' style="max-width: 200px; max-height: 130px;"/>
                  </div>
                  <a href="<?php echo app_path ?>user/StudentServicesOfficer/files/image/<?php echo $image ?>" target="_blank" class="btn btn-info">View Image</a>
                </div>

                <div class="col-md-4">
                  <label for="exampleInputFile">View Attachment</label>
                  <p class="help-block">Attachment Uploaded (.pdf / .doc)</p>
                   <p><?php echo $attachment ?></p>
                  <a href="<?php echo app_path ?>user/StudentServicesOfficer/files/requirements/<?php echo $attachment ?>" target="_blank" class="btn btn-info">View Attachment</a>
                </div>

                <div class="col-md-4">
                  <label class="control-label">Posted By</label>
                  <input type="email" class="form-control" value="<?php echo $pln . ', ' . $pfn ?>"" name="postedby" readonly>
                </div>
              </div>
              <div class="box-body">
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button name="update" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Update
                </button>
              </div>
               <div class="box-footer">
                <button name="back" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Back
                </button>
              </div>
            </form>
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



<?php
    include_once('../../includes/footer.php');
?>
