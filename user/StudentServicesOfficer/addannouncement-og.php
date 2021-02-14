 
<?php
  $page_title = "Add annoucement";
  include_once('../../includes/header.php');
  validateAccess();
  validateStudentServicesOfficer();

  if ( isset($_POST['add'])) {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $upload = "files/requirements/"; # location where to upload the image
    $pdf = $_FILES["pdf"]["name"]; # gets the file from file upload
    if(empty($pdf))
    {
      $newpdf = "";
    }
    else
    {
        $newpdf = $title . "-" . basename($pdf); # eg. 20170322051234-sample.jpg
    }
      $file = $upload . $newpdf;

      move_uploaded_file($_FILES["pdf"]["tmp_name"], $file);

        $uploads = "files/image/"; # location where to upload the image
        $image = $_FILES["image"]["name"]; # gets the file from file upload
        $newImage = $title . "-" . basename($image); # eg. 20170322051234-sample.jpg
        $files = $uploads . $newImage;

        move_uploaded_file($_FILES["image"]["tmp_name"], $files);

        $sql_addannoucement = "INSERT INTO post VALUES ( '', $uid, 1, '$title', '$description', '$newImage', '$newpdf', NOW(), NULL, 'Active' )";  
        $con->query($sql_addannoucement) or die(mysqli_error($con));
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
            <li><a href="viewarchiveposts.php"><i class="fa fa-circle-o text-red"></i> <span>Archived Announcement(s)</span></a></li>
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
              <h3 class="box-title">Add New Announcement</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="col-md-4">
                  <label class="control-label">Title</label>
                  <input type="text" class="form-control" value="" name="title" required>
                </div>
              </div>
            <div class="box-header with-border">
              <p class="box-title">Content</p>
            </div>
              <div class="box-body">
                <div class="col-md-12">
                  <label>Description</label>
                  <textarea class="form-control" name="description" rows="3" placeholder="Enter Announcement Here.."></textarea>
                </div>
              </div>
               <div class="box-body">
                <div class="col-md-4">
                  <label for="exampleInputFile">Upload Image</label>
                  <input type="file" name="image" accept="image/gif, image/jpg, image/jpeg, image/png"/>
                  <p class="help-block">Upload Image</p>
                </div>
                <div class="col-md-4">
                  <label for="exampleInputFile">Upload Attachment</label>
                  <input type="file" name="pdf" accept="application/pdf" />
                  <p class="help-block">Upload Attachment File (.pdf / .doc)</p>
                </div>
                <div class="col-md-4">
                  <label class="control-label">Posted By</label>
                  <input type="text" class="form-control" value="<?php echo $userName ?>" name="postedby" readonly>
                </div>
              </div>
              <div class="box-body">
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button name="add" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
                  Submit
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
