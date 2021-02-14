<?php
	# displays total number of records from a chosen table
	function countData($table)
	{
		include 'config.php';
		$sql_count = "SELECT COUNT(*) AS total FROM $table
			WHERE Status!='Archived'";
		$result = $con->query($sql_count);

		$data = mysqli_fetch_assoc($result);
		return $data['total'];
	}

	# hides elements if customer is not logged in
	function toggleUser()
	{
		if (!isset($_SESSION['userid']))
		{	
			echo 'style="display:none;"';
		}
	}
	function toggleprofile()
	{
		if(isset($_SESSION['userid']))
		{
			echo 'style="display:none;"';
		}
	}

	# hides elements if customer is logged in
	function toggleGuest()
	{
		if (isset($_SESSION['userid']))
		{
			echo 'style="display:none;"';
		}
	}

	# gets path of application folder
	function getAppFolder()
	{
	    $protocol  = empty($_SERVER['HTTPS']) ? 'http' : 'https';
	    $port      = $_SERVER['SERVER_PORT'];
	    $disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";
	    $domain    = $_SERVER['SERVER_NAME'];
	    
	    return "${protocol}://${domain}${disp_port}" . "/snfss/";
	}

	# checks if user has logged in; redirects to login page if not logged in
	function validateAccess()
	{
		if (!isset($_SESSION['userid']))
		{
			$admin_login = 'index.php';
			$lastURL = $_SERVER['REQUEST_URI'];
			header('location: /snfss/' . $admin_login);
		}
	}

	function validatePersonnel()
	{
		$usertype = $_SESSION['usertype'];
    	if ($usertype == 'Admin')
        {
        	header('location:'.app_path.'user/Admin/index.php');
        }
        if ($usertype == 'Department Head')
        {
        	header('location:'.app_path.'user/DepartmentHead/index.php');
        }
        if ($usertype == 'Faculty')
        {
        	header('location:'.app_path.'user/Faculty/index.php');
        }
        if ($usertype == 'IT Personnel')
        {
        	header('location:'.app_path.'user/ITPersonnel/index.php');
        }
        if ($usertype == 'IT Personnel - Standard User')
        {
        	header('location:' .app_path. 'user/ITPersonnel/index3.php');
        }
        if ($usertype == 'IT Personnel - Superior User')
        {
        	header('location:' .app_path. 'user/ITPersonnel/index2.php');
        }
        if ($usertype == 'Parents')
        {
        	header('location:'.app_path.'user/Parents/index.php');
        }
        if ($usertype == 'Principal')
        {
        	header('location:'.app_path.'user/Principal/index.php');
        }
        if ($usertype == 'Registrar')
        {
        	header('location:'.app_path.'user/Registrar/index.php');
        }
       	if ($usertype == 'Student Services Officer')
        {
        	header('location:'.app_path.'user/StudentServicesOfficer/index.php');
        }
	}

#validate user Access
	function validateAdmin()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Admin')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}

	#validate user Access
	function validateDepartmentHead()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Department Head')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}

	function validateFaculty()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Faculty')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}

	function validateITPersonnel()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'IT Personnel' || $usertype == 'IT Personnel - Standard User' || $usertype == 'IT Personnel - Superior User')
	        {

	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}

	function validateParents()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Parents')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}

	function validatePrincipal()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Principal')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}
	function validateRegistrar()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Registrar')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}
	function validateStudentServicesOfficer()
	{
		$usertype = $_SESSION['usertype'];
	    if(isset($_SESSION['userid']))
	    {
	        if ($usertype == 'Student Services Officer')
	        {
	        }
	        else
	        {
	            header('location:'.app_path.'invalid.php');
	        }
	    }
	}



	function clean_input($data)
    {
	       
	    include('config.php');
	    
	    $data = mysqli_real_escape_string($con, htmlspecialchars(strip_tags(stripslashes(trim($data)))));
	    return $data;    

	}

	function encrypt($data) 
	{
		$key = "N3VZUo0S0SLM7asvU8pDpQiQx7VvSP8w7x6GJjccWsA=";
	    $enc_key = base64_decode($key);
	    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
	    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $enc_key, 0, $iv);
	    return base64_encode($encrypted . '::' . $iv);
	}

	function decrypt($data) 
	{
		$key = "N3VZUo0S0SLM7asvU8pDpQiQx7VvSP8w7x6GJjccWsA=";
	    $enc_key = base64_decode($key);
	    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
	    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $enc_key, 0, $iv);
	}