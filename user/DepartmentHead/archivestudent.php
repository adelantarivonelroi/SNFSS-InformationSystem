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

      $sql_archive = "UPDATE studentlist SET Status = 'Archived', ArchiveReason = '$reason' WHERE StudentListID = $id";
      $con->query($sql_archive);

      header('location: archivestudentsection.php');
    }
    else
    {
      header('location: archivestudentsection.php');
    }
  }
  else
  {
    header('location: archivestudentsection.php');
  }
?>