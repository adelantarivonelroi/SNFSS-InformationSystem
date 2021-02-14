<?php
  $page_title = "Home Page";
  include_once('../../includes/header.php');
  validateAccess();
  validateParents();

  $sql_studentname = "SELECT s.FirstName, s.MiddleName, s.LastName FROM students s INNER JOIN parent p ON s.StudentID = p.StudentID WHERE p.UserID = $uid";
  $result_studentname = $con->query($sql_studentname) or die(mysqli_error($con));

  while($row = mysqli_fetch_array($result_studentname))
  {
    $stfn = $row['FirstName'];
    $stmn = $row['MiddleName'];
    $stln = $row['LastName'];
  }

  $sql_viewgrade = "SELECT g.Grade, sub.SubjectName 
  FROM grade g 
  INNER JOIN studentlist sl 
  ON g.StudentListID = sl.StudentListID 
  INNER JOIN subject sub 
  ON g.SubjectID = sub.SubjectID 
  INNER JOIN parent p 
  ON sl.StudentID = p.StudentID 
  WHERE p.UserID = $uid";

  $result_viewgrade = $con->query($sql_viewgrade) or die(mysqli_error($con));


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
       <!-- left column -->
       <form role="form">
       <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-danger">
          <div class="box-header with-border">
            <h3 class="box-title">Student Grade for <?php echo $stfn . " " . $stln ;?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
        
            <div class="box-body">
              <table id="" class="display" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>Subject</th>
                    <th>Grade</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    while ($row = mysqli_fetch_array($result_viewgrade))
                    {
                      $subn = $row['SubjectName'];
                      $grd = $row['Grade'];

                      echo "
                        <tr>
                          <td>$subn</td>
                          <td>$grd</td>

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
