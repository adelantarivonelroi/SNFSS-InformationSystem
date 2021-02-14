<?php
    $page_title = "Index Students";
    include_once('../../includes/header.php');
    validateaccess();
    validateregistrar();
    # display students record
    // $sql_students = "SELECT s.StudentID, st.StatusName, l.LevelName, c.ClearanceStatus, s.FirstName, s.LastName, s.Birthday, s.Email, s.ContactNo, s.Address, s.MotherFirstName, s.MotherLastName, s.MotherOccupation, s.FatherFirstName, s.FatherLastName, s.FatherOccupation, s.DateAdded, s.DateModified FROM students s INNER JOIN studentstatus st ON s.StudentStatusID = st.StudentStatusID INNER JOIN level l ON s.LevelID = l.LevelID INNER JOIN clearance c ON s.ClearanceID = c.ClearanceID";

     // $sql_students = "SELECT * FROM students";

    $sql_students = "SELECT s.StudentID, st.StatusName, l.LevelName, s.FirstName, s.LastName, s.Birthday, s.Address, s.DateAdded, s.DateModified FROM students s INNER JOIN  statusstudent st ON s.StatusStudentID = st.StatusStudentID INNER JOIN level l ON s.LevelID = l.LevelID";

    $result_students = $con->query($sql_students)
?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li class="header">Index</li>
      <li><a href="index.php"><i class="fa fa-circle-o text-red"></i> <span>Home</span></a></li>
      <li class="header">Enrollment Process</li>
      <li><a href="enrollmentsearch.php"><i class="fa fa-circle-o text-red"></i> <span>Check enrollee</span></a></li>
      <li><a href="enrollmentviewall.php"><i class="fa fa-circle-o text-red"></i> <span>View all enrollee</span></a></li>
      <li class="header">Student Record(s)</li>
      <li><a href="studentrecordmain.php"><i class="fa fa-circle-o text-red"></i> <span>Manage Student Record</span></a></li>
      <li class="header">Grade Encoding</li>
      <li><a href="encodefeature.php"><i class="fa fa-circle-o text-red"></i> <span>Update Encode Feature</span></a></li>
      <li class="header">Clearance</li>
      <li><a href="updateclearancesearch.php"><i class="fa fa-circle-o text-red"></i> <span>Update Clearance Status</span></a></li>
      <li class="header">Academic Year</li>
      <li><a href="addacademicyear.php"><i class="fa fa-circle-o text-red"></i> <span>Add academic year</span></a></li>
      <li class="header">Periodic Rating</li>
      <li><a href="updateperiodicrating.php"><i class="fa fa-circle-o text-red"></i> <span>Update Periodic Rating</span></a></li>
      <li class="header">Import Records</li>
      <li><a href="importstudent.php"><i class="fa fa-circle-o text-red"></i> <span>Import Student Record</span></a></li>
      <li><a href="importaddress.php"><i class="fa fa-circle-o text-red"></i> <span>Import Address Record</span></a></li>
      <li><a href="importenrollment.php"><i class="fa fa-circle-o text-red"></i> <span>Import Enrollment Record</span></a></li>

    </ul>
  </section>
</section>
<!-- /.sidebar -->
</aside>

    <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Student Record(s)
        <small>Manage Student Records</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Select Student Record</h3>
            </div>
            <div class="col-md-12">
              <div class="box-body pad table-responsive">
                <table class="table table-bordered text-center">
                  <tbody>
                    <tr>
                      <td>
                        <label>Input name</label>
                        <input type="keyword" class="form-control" id="samplekeyword" placeholder="Enter name">
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <button type="submit" class="btn btn-success">Search student</button>
                        <a href="view.php">
                        <button type="button" class="btn btn-info">View record</button>
                        </a>
                        <button type="submit" class="btn btn-danger">Archive record</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


<?php
    include_once('../../includes/footer.php');
?>