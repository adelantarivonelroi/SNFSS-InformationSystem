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

      $sql_approve = "UPDATE facultylist SET DateApproved = NOW(), Status = 'Disapproved' WHERE FacultyListID = $id";
      $con->query($sql_approve);

      header('location: pfacultylist.php');
    }
    else
    {
      header('location: pfacultylist.php');
    }
  }
  else
  {
    header('location: pfacultylist.php');
  }
?>