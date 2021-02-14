<?php 

	$page_title="Sto. Nino Formation and Science ";
    include_once('../../includes/header.php');
    //include ('../../config.php');

  validateAccess();
  validateRegistrar();

   $query = "SELECT EnrollmentStatus, count(*) as number FROM enrollment GROUP BY EnrollmentStatus";  
   $result = mysqli_query($con, $query);  

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
<!-- /.sidebar -->
</aside>

  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar
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
              <h3 class="box-title">Home</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <label>Select a Task From The Side Bar.</label>

                     <title>Enrollment Statistics</title>  
                     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
                     <script type="text/javascript">  
                     google.charts.load('current', {'packages':['corechart']});  
                     google.charts.setOnLoadCallback(drawChart);  
                     function drawChart()  
                     {  
                          var data = google.visualization.arrayToDataTable([  
                                    ['EnrollmentStatus', 'number'],  
                                    <?php  
                                    while($row = mysqli_fetch_array($result))  
                                    {  
                                         echo "['".$row["EnrollmentStatus"]."', ".$row["number"]."],";  
                                    }  
                                    ?>  
                               ]);  
                          var options = {  
                                title: 'Number of Enrolled Students',  
                                //is3D:true,  
                                pieHole: 0.4  
                               };  
                          var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                          chart.draw(data, options);  
                     }  
                     </script>  

                     </form>
                         <br /><br />  
                         <div style="width:900px;">  
                              <h3 align="center">Current number of enrollees</h3>  
                              <br />  
                              <div id="piechart" style="width: 900px; height: 500px;"></div>  
                         </div>  




                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
        </div>
      </div>
    </section>


    <!-- /.content -->

  <!-- /.content-wrapper -->

<?php
    include_once('../../includes/footer.php');
?>