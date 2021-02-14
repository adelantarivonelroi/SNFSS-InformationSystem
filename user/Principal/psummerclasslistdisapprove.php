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

      $sql_approve = "UPDATE summerstudentlist SET DateApproved = NOW(), Status = 'Disapproved' WHERE SummerStudentListID = $id";
      $con->query($sql_approve) or die(mysqli_error($con));

      header('location: psummerclasslist.php');
    }
    else
    {
      header('location: psummerclasslist.php');
    }
  }
  else
  {
    header('location: psummerclasslist.php');
  }
?>