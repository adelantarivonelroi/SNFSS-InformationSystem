<?php
include_once('../../includes/header.php');
validateAccess();
validateRegistrar();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $sqlInsert = "INSERT into students (StudentID, StatusStudentID, StudentTypeID, LevelID, FirstName, MiddleName, LastName, Picture, GenderID, Birthday, Email, ContactNo, AddressID, MotherFirstName, MotherLastName, MotherOccupation, FatherFirstName, FatherLastName, FatherOccupation, DateAdded, DateModified, AssignStatus)
                   values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" . $column[9] . "','"
                   . $column[10] . "','" . $column[11] . "','" . $column[12] . "','" . $column[13] . "','" . $column[14] . "','"
                   . $column[15] . "','" . $column[16] . "','" . $column[17] . "','" . $column[18] . "','" . $column[19] . "','" . $column[20] . "','" . $column[21] . "')";
            $result = mysqli_query($con, $sqlInsert);
            
            if (! empty($result)) {
                $type = "success";
                $message = "<b>* CSV Data Imported into the Database</b>";
            } else {
                $type = "error";
                $message = "<b>* Problem in Importing CSV Data</b>";
            }
        }
    }
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

        $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
                $("#response").addClass("error");
                $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Home</li>
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
      <li class="header">Periodic Rating</li>
      <li><a href="updateperiodicrating.php"><i class="fa fa-circle-o text-red"></i> <span>Update Periodic Rating</span></a></li>
    </ul>
  </section>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    
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
          <h3 class="box-title">Import Student Record(s)</h3>
      </div>

      <form class="form-horizontal" action="" method="post"
      name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
      <div class="form-group">
          <label for="exampleInputFile" class="col-sm-2 control-label">Import .csv file </label>
          <div class="col-sm-4">
            <input type="file" name="file" id="file" accept=".csv">
            <button type="submit" id="submit" name="import" class="btn-submit">Import</button>
        </div>
             <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
    </div>
   <?php
        $sqlSelect = "SELECT * FROM students";
        $result = mysqli_query($con, $sqlSelect);
        if (mysqli_num_rows($result) > 0) {
          ?>
          <form role="form">
          <div class="box-body">
          <table id="" class='display' cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Student ID</th>
                <th>Status Student ID</th>
                <th>Student Type ID</th>
                <th>Level ID</th>
                <th>First Name</th>
                <th>Last Name</th>
              </tr>
            </thead>
            <?php
            while ($row = mysqli_fetch_array($result)) {
            ?>
              <tbody>
                <tr>
                  <td><?php  echo $row['StudentID']; ?></td>
                  <td><?php  echo $row['StatusStudentID']; ?></td>
                  <td><?php  echo $row['StudentTypeID']; ?></td>
                  <td><?php  echo $row['LevelID']; ?></td>
                  <td><?php  echo $row['FirstName']; ?></td>
                  <td><?php  echo $row['LastName']; ?></td>
                </tr>
                <?php
              };

              ?>
            </tbody>
          </table>
          <?php } ?>
        </div>
         <script>
              $(document).ready(function() {
                $('table.display').DataTable();
              } );
            </script>
          </form>
        </div>
      </div>
