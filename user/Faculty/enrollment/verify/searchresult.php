<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../../../includes/header.php');
  validateAccess();
  validateFaculty();

  # retrieve search result

  $search = $_SESSION['name'];
  $string = '%' . $search . '%';

  $sql_search = $con->prepare("SELECT StudentID, FirstName, MiddleName, LastName, Birthday, Gender, Address, StudentStatus 
        FROM students WHERE FirstName LIKE ? OR LastName LIKE ?");
  $sql_search->bind_param('ss', $string, $string);
  $sql_search->execute();
  $result_search = $sql_search->get_result();

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Menu</li>
            <li><a href="../../index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Enrollment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../enrollment/entrance/index.php"><i class="fa fa-circle-o"></i>Entrance exam grade</a></li>
                <li><a href="index.php"><i class="fa fa-circle-o"></i> Verify enrollee status</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Faculty Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../viewschedule.php"><i class="fa fa-circle-o"></i>View schedule</a></li>
              </ul>
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Student Record</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="../../student/grade/index.php"><i class="fa fa-circle-o"></i>Encode grade</a></li>
              </ul>
            </li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside>

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Enrollment
        <small>Check enrollee requirements</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Enrollment</a></li>
        <li class="active">Check enrollee requirements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Student requirements</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-2">
                    <label>Click on a record below to view.</label>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Search result</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example" class="table table-bordered table-striped">
                <thead>
                  <th></th>
                  <th>Student ID</th>
                  <th>StudentStatus</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Address</th>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($result_search))
                    {
                      $sid = $row['StudentID'];
                      $status = $row['StudentStatus'];
                      $fn = $row['FirstName'];
                      $mn = $row['MiddleName'];
                      $ln = $row['LastName'];
                      $bday = $row['Birthday'];
                      $gender = $row['Gender'];
                      $address = $row['Address'];


                      echo "
                        <tr>
                          <td>
                              <a href='viewselected.php?id=$sid' class='btn btn-xs btn-info'>
                                  <i class='fa fa-edit'></i>
                              </a>
                          </td>
                          <td>$sid</td>
                          <td>$status</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$gender</td>
                          <td>$address</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>

            
          </div>



        </div>
      </div>
    </section>
    <!-- /.content -->
  <!-- /.content-wrapper -->
<?php
    include_once('../../../../includes/footer.php');
?>