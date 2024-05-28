<?php

	if (!isset($_SESSION['user'])) //if user session is not set this measn user is not logged in 
	 {
		$_SESSION['no-login-msg'] = "<div class='error text-center'> Please login to access admin panel </div>";

		header('location:'.SITEURL.'admin/login.php');
	}

?>