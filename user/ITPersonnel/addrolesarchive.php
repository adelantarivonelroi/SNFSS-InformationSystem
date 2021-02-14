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
			$sql_delete = "DELETE FROM role WHERE RoleID = $id";
				
			$result = $con->query($sql_delete) or die(mysqli_error($con));
			header('location: /snfss/User/ITPersonnel/addroles.php');  
		}
		else
		{
			header('location: /snfss/User/ITPersonnel/addroles.php');  
		}
	}
	else
	{
		header('location:/snfss/User/ITPersonnel/addroles.php');  
	}
?>