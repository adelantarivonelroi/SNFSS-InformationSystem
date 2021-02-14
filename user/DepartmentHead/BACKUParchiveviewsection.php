<?php 

  $page_title="Sto. Nino Formation and Science ";
  include_once( '../../includes/header.php');
  validateAccess();
  validateDepartmentHead();

  # get school year
  $sql_schoolyear = "SELECT * FROM schoolyear ORDER BY SchoolYearID DESC LIMIT 1";
  $result_sy = $con->query($sql_schoolyear) or die(mysqli_error($con));

  while ($row = mysqli_fetch_array($result_sy))
  {
    $syid = $row['SchoolYearID'];
    $sys = $row['SchoolYearStart'];
    $sye = $row['SchoolYearEnd'];
  }

  # list of classification
   $sql_level = "SELECT s.LevelID, l.LevelName FROM section s
   INNER JOIN level l
   ON s.LevelID = l.LevelID
   GROUP BY LevelID ORDER BY LevelID DESC";
   $result_level =$con->query($sql_level);

   $list_level = "";
   while($row = mysqli_fetch_array($result_level))
   {
      $lvlid= $row['LevelID'];
      $lvlname= $row['LevelName'];
      $list_level .="<option value='$lvlid'>$lvlname</option>";
   }

  $result_section = "";

  if ( isset($_POST['select']) ) 
  {
      if (!empty($_POST['selectlevel']))
      {
      $selectlvl = mysqli_real_escape_string($con, $_POST['selectlevel']);

      $sql_section = "SELECT s.SectionID, s.SchoolYearID, sy.SchoolYearStart, sy.SchoolYearEnd, s.LevelID, l.LevelName, s.SectionName, s.SectionStatus
            FROM section s 
            INNER JOIN level l
            ON s.LevelID = l.LevelID
            INNER JOIN schoolyear sy
            ON s.SchoolYearID = sy.SchoolYearID
            WHERE sy.SchoolYearID = $syid AND s.LevelID = $selectlvl ORDER BY s.SectionID DESC";

      $result_section = $con->query($sql_section) or die(mysqli_error($con));
      }
      else 
      {
        $message ="Please select a year level first.";
      }

  }
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
        Manage section
        <small>View sections</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Section</a></li>
        <li class="active">Manage section</li>
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
              <h3 class="box-title">Manage section</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="POST">
              <div class="box-body">
                <div class="row1">
                  <div class="col-sm-4">
                    <label>Current school year is <?php echo $sys . "-" . $sye ?></label>
                     <div class="form-group">
                      <p class="control-label col-sm-4">Select year level</p>
                      <div class="col-sm-4">
                        <select name="selectlevel"  class="form-control" required>
                            <option></option>
                            <?php echo $list_level ?>
                        </select>   
                      </div>  
                      <div class="col-sm-3">
                        <button name="select" type="submit" class="btn btn-primary">Select</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- /.input group -->
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">List of sections</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <th>Section ID</th>
                  <th>School Year</th>
                  <th>Section</th>
                  <th>View</th>
                </thead>
                <tbody>
                  <?php

                  if ( !empty($result_section) )
                  {
                    while ($row = mysqli_fetch_array($result_section))
                    {
                      $secid = $row['SectionID'];
                      $sys = $row['SchoolYearStart'];
                      $sye = $row['SchoolYearEnd'];
                      $ln = $row['LevelName'];
                      $sn = $row['SectionName'];



                      echo "
                        <tr>
                          <td>$secid</td>
                          <td>$sys - $sye</td>
                          <td>$sn</td>
                          <td>
                              <a href='archivestudentsection.php?id=$secid' class='btn btn-sm btn-info'>
                                  View
                              </a>
                          </td>
                        </tr>
                      ";
                    }
                  } 
                  else
                  {
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