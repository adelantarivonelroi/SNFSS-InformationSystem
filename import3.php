<?php 

include_once('../../includes/header.php');

  validateAccess();
  validateRegistrar();

 if (!empty($_FILES['csv']['size']) && $_FILES['csv']['size'] > 0) { 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO students (StudentID, StatusStudentID, StudentTypeID, FirstName, MiddleName, LastName, Picture, GenderID, Birthday, Email, ContactNo, AddressID, MotherFirstName, MotherLastName, MotherOccupation, FatherFirstName, FatherLastName, FatherOccupation, NOW()) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
                    '".addslashes($data[3])."', 
                    '".addslashes($data[4])."', 
                    '".addslashes($data[5])."', 
                    '".addslashes($data[6])."', 
                    '".addslashes($data[7])."', 
                    '".addslashes($data[8])."', 
                    '".addslashes($data[9])."', 
                    '".addslashes($data[10])."', 
                    '".addslashes($data[11])."', 
                    '".addslashes($data[12])."', 
                    '".addslashes($data[13])."', 
                    '".addslashes($data[14])."', 
                    '".addslashes($data[15])."', 
                    '".addslashes($data[16])."', 
                    '".addslashes($data[17])."', 
                    '".addslashes($data[18])."', 
                    '".addslashes($data[19])."',  

                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
  header('Location: import.php?success=1'); die; 


} 

?>

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
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

<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1"> 
  Choose your file: <br /> 
  <input name="csv" type="file" id="csv" /> 
  <input type="submit" name="Submit" value="import" /> 


