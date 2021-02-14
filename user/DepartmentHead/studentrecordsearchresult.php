<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateDepartmentHead();

  # retrieve search result

  $search = $_SESSION['name'];
  $string = '%' . $search . '%';

  $sql_search = $con->prepare("SELECT s.StudentID, s.FirstName, s.MiddleName, s.LastName, s.Birthday, g.GenderName , a.Street, a.Barangay, cc.CityName, ss.StatusName, e.EnrollmentStatus
        FROM students s 
        INNER JOIN gender g 
        ON s.GenderID = g.GenderID 
        INNER JOIN statusstudent ss 
        ON s.StatusStudentID = ss.StatusStudentID
        INNER JOIN  enrollment e 
        ON s.StudentID = e.StudentID
        INNER JOIN  address a 
        ON s.AddressID = a.AddressID
        INNER JOIN  city cc 
        ON a.CityID = cc.CityID
        WHERE FirstName LIKE ? OR LastName LIKE ? ORDER BY e.DateEnroll DESC LIMIT 1");

  $sql_search->bind_param('ss', $string, $string);
  $sql_search->execute();
  $result_search = $sql_search->get_result();
?>

<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Index</li>
            <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
            <li class="header">Faculty list</li>
            <li><a href="facultylisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Faculty list</span></a></li>
            <li class="header">Student list</li>
            <li><a href="studentlisthome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student list</span></a></li>
            <li class="header">Sections</li>
            <li><a href="sectionhome.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Sections</span></a></li>
            <li class="header">Student Record</li>
            <li><a href="studentrecordsearch.php"><i class="fa fa-circle-o text-red"></i> <span>View Student Record</span></a></li>
          </ul>
          </section>
          <!-- /.sidebar -->
        </aside> 

<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Student Record
        <small>View student records</small>
      </h1>
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
                  <div class="col-sm-4">
                    <?php 
                    if ( mysqli_num_rows($result_search) > 0 ) 
                    {
                      echo "<label>Click the 'View' button beside the row to view.</label></br>
                            <a href='studentrecordsearch.php'>Click here to search again.</a>";

                    } 
                    else 
                    {
                      echo "<b>No record(s) found.</b></br>
                            <a href='studentrecordsearch.php'>Click here to search again.</a>";
                    }
                    
                    ?>
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
             <table id="table3" class="table table-bordered table-striped">
                <thead>
                  <th>Student ID</th>
                  <th>Type of student</th>
                  <th>Enrollment Status</th>
                  <th>Full name</th>
                  <th>Birthday</th>
                  <th>Gender</th>
                  <th>Address</th>
                  <th></th>
                </thead>
                <tbody>
                  <?php

                    while ($row = mysqli_fetch_array($result_search))
                    {
                      $sid = $row['StudentID'];
                      $status = $row['StatusName'];
                      $estatus = $row['EnrollmentStatus'];
                      $fn = $row['FirstName'];
                      $mn = $row['MiddleName'];
                      $ln = $row['LastName'];
                      $bday = $row['Birthday'];
                      $gender = $row['GenderName'];
                      
                      $street = decrypt($row['Street']);
                      $brgy = decrypt($row['Barangay']);
                      $city = $row['CityName'];


                      echo "
                        <tr>
                          <td>$sid</td>
                          <td>$status</td>
                          <td>$estatus</td>
                          <td>$ln, $fn $mn</td>
                          <td>$bday</td>
                          <td>$gender</td>
                          <td>$street, $brgy, $city</td>
                          <td>
                              <a href='studentrecordviewselect.php?id=$sid' class='btn btn-sm btn-info'>
                                  View
                              </a>
                          </td>
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
    include_once('../../includes/footer.php');
?>