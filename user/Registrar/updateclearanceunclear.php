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

      $sql_unclear = "UPDATE clearancedetails SET Status = 'Pending', DateCleared = NULL WHERE ClearanceDetailsID = $id";
      $con->query($sql_unclear);

      header('location: updateclearancestatus.php');
    }
    else
    {
      header('location: updateclearancestatus.php');
    }
  }
  else
  {
    header('location: updateclearancestatus.php');
  }
?>