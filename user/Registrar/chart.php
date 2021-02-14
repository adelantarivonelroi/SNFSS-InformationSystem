<?php  
 $connect = mysqli_connect("localhost", "root", "", "snfssdb");  
 $query = "SELECT EnrollmentStatus, count(*) as number FROM enrollment GROUP BY EnrollmentStatus";  
 $result = mysqli_query($connect, $query);  
 ?>  
 


 <!DOCTYPE html>  
 <html>  
      <head>  

       <section class="content-header">
      <h1>
        Student Record
        <small>Encoded</small>
      </h1>
    </section>
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
      </head>  
      <body>  
       <form method="POST">
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Statistics</h3>
              </div>

              <div class="box-body">

      
              </div>

            </div>
          </div>
        </div>
      </section>
    </form>
           <br /><br />  
           <div style="width:900px;">  
                <h3 align="center">SNFSS-SIS</h3>  
                <br />  
                <div id="piechart" style="width: 900px; height: 500px;"></div>  
           </div>  
      </body>  
 </html>  