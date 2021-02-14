<?php 
  # checks if record is selected
  if (isset($_REQUEST['id']))
  {
    # checks if selected record is an ID value
    if (ctype_digit($_REQUEST['id']))
    {
      $id = $_REQUEST['id'];
      include_once( '../../includes/header.php');
      

      $sql_archive = "UPDATE post SET Status = 'Archived' WHERE PostID = $id";
      $con->query($sql_archive);

      header('location: enrollmentrequirements.php');
    }
    else
    {
      header('location: enrollmentrequirements.php');
    }
  }
  else
  {
    header('location: enrollmentrequirements.php');
  }
?>