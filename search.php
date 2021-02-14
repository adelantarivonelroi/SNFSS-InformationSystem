<?php
  $page_title = "Home Page";
  include_once('includes/header-visitor.php');
  ?>

  <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>View Student Grade</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Downloadable Forms</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Feedback</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Search
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>View Student Grade</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3></h3>

              <p>Enrollment Forms</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Search</h3>
          </div>
          <div class="box-body">
            <div class="col-md-4">
              <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Go!</button>
                    </span>
              </div>
            </div>
        </div>
        <div class="box-header with-border">
          <p class="box-title">Filter Results</p>
        </div>
      <div class="box-body">
        <div class="col-md-4">
              <div class="form-group">
                <label>[Type]</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>[Type]</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Alabama</option>
                  <option>Alaska</option>
                  <option>California</option>
                  <option>Delaware</option>
                  <option>Tennessee</option>
                  <option>Texas</option>
                  <option>Washington</option>
                </select>
              </div>
        </div>
        <div class="col-md-4">
          <label class="control-label">Date</label>
          <input type="date" class="form-control" value="" name="ln" required>
        </div>
      </div>
      <div class="box-footer">
        <button name="search" onclick="return confirm('Are you sure?')" class="btn btn-info pull-right btn-danger">
          Search
        </button>
      </div>
    </div>
  </div>


       <!-- left column -->
       <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Date Results</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form">
            <div class="box-body">
              <table id="" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Announcements</th>

                  </tr>
                </thead>
                <tbody>
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
  </div>
  <!-- /.box -->
</div>
<!-- /.col -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
    include_once('includes/footer.php');
?>
