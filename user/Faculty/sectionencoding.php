 
<?php
$page_title = "Register User";
include_once('../../includes/header.php');
validateAccess();
?>


<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header">Index</li>
      <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
      <li class="header">Enrollment</li>
      <li><a href="enrollment/entrance/index.php"><i class="fa fa-circle-o text-red"></i> <span>Grade Entrance Exam</span></a></li>
      <li class="header">Faculty Record</li>
      <li><a href="viewschedule.php"><i class="fa fa-circle-o text-red"></i> <span>View Schedule</span></a></li>
      <li class="header">Student Record</li>
      <li><a href="encodeindex.php"><i class="fa fa-circle-o text-red"></i> <span>Encode Grade</span></a></li>

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
          <h3 class="box-title">Section [Section Number] - Subject [Subject]</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form method="post">
          <div class="box-body">
            <div class="col-md-4">
              <label class="control-label">Subject</label>
              <input type="text" class="form-control" value="" name="uname" required>
            </div>
            <div class="col-md-4">
              <label class="control-label">Section</label>
              <input type="text" class="form-control" value="" name="uname" required>
            </div>
          </div>
          <div class="box-header with-border">
            <p class="box-title">Content</p>
          </div>
          <div class="box-body">
            <div class="col-md-12">
              <!-- Horizontal Form -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Section List</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                  <div class="box-body">
                    <table id="" class="display" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Student ID</th>
                          <th>Student Name</th>
                          <th>Student Grade</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <div class="box-body">
                      <div class="col-md-4">
                        <label class="control-label">ID Number</label>
                        <input type="email" class="form-control" value="" name="email" required>
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Student Name</label>
                        <input type="email" class="form-control" value="" name="email" required>
                      </div>
                    <div class="col-md-4">
                      <label class="control-label">Grade</label>
                      <input type="email" class="form-control" value="" name="email" required>
                    </div>
                  </div>
                
                      <div class="col-lg-offset-4 col-lg-8">
                        <a href="#" class="btn btn-danger pull-right">
                          Submit Grade
                        </a>
                      </div> 
                    </div>
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
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



        <?php
        include_once('../../includes/footer.php');
        ?>
