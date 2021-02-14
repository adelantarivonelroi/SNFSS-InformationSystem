<?php 
	# checks if record is selected
	if (isset($_REQUEST['id']))
	{
		# checks if selected record is an ID value
		if (ctype_digit($_REQUEST['id']))
		{
			$id = $_REQUEST['id'];
			require($_SERVER['DOCUMENT_ROOT'] . '/snfss/config.php');
			require($_SERVER['DOCUMENT_ROOT'] . '/snfss/function.php');

			validateAccess();
			validateITPersonnel();
			
			# archives existing record
			$sql_delete = "UPDATE user SET status='Archived',
				DateModified=NOW()
				WHERE userID=$id";
				
			$result = $con->query($sql_delete) or die(mysqli_error($con));
			header('location: /snfss/User/ITPersonnel/viewuser.php');  
		}
		else
		{
			header('location: /snfss/User/ITPersonnel/viewuser.php');  
		}
	}
	else
	{
		header('location:/snfss/User/ITPersonnel/viewuser.php');  
	}
?>