<?php 
  # checks if record is selected
  if (isset($_REQUEST['id']))
  {
    # checks if selected record is an ID value
    if (ctype_digit($_REQUEST['id']))
    {
      $id = $_REQUEST['id'];
      include_once( '../../includes/header.php');
      validateAccess();
      validatePrincipal();

      $sql_approve = "UPDATE summersection SET DateApproved = NOW(), Status = 'Approved' WHERE SummerSectionID = $id";
      $con->query($sql_approve) or die(mysqli_error($con));

      header('location: psummersection.php');
    }
    else
    {
      header('location: psummersection.php');
    }
  }
  else
  {
    header('location: psummersection.php');
  }
?>