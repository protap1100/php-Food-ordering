<?php include '../config/connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - Food Ordering Page</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
</head>
<body>


<div class="login">
	<h1 class="text-center">Admin Login</h1>
	<br><br>
	<?php 
		
		if (isset($_SESSION['login'])) {
			 echo $_SESSION['login'];
			 unset($_SESSION['login']);
		}
		if (isset($_SESSION['no-login-msg'])) {
			echo $_SESSION['no-login-msg'];
			unset($_SESSION['no-login-msg']);
		}
	 ?>
	<!-- Login form start here --> 
	<form action="login.php" method="POST"  class="text-center">
		<label class="success">Username:</label>
		<br>
		<input type="text" name="username" placeholder="Enter your Username" > 
		<br><br>
		<label class="success">Password:</label>
		<br>
		<input type="Password" name="password" placeholder="Enter your Password">
		<br>	<br>
		<input type="submit" name="submit" value="login" class="btn_primary">
	</form>
	<p class="text-center">Created by - <a href="https://www.facebook.com/protap.biswas1100">Protap Biswas</a></p>
</div>
</body>
</html>

<?php

//check whether login button clicked or not 

if (isset($_POST['submit'])) {
	
	//1.get the value
	// $username=$_POST['username'];
	// $password=md5($_POST['password']);

	$username=mysqli_real_escape_string($con,$_POST['username']);
	$raw_password = $password=md5($_POST['password']);
	$password = mysqli_real_escape_string($con,$raw_password);

	//2.check with sql  whether  the user with username  and password exist or not 
	$sql = "SELECT * FROM tbl_admin WHERE  username ='$username' AND password='$password'";
	
	//3.exexute the query
	$res = mysqli_query($con,$sql);
	
	//4.count rows to check user exist or not 
	$count= mysqli_num_rows($res);
	
	//5.check the user exist or not 

	if ($count==1) {
		//user login success
		$_SESSION['login'] = "<div class='success'>You have logged in successfully.</div>";
		$_SESSION['user'] = $username;	//to check  whether the logged in or not and logout will unset it

		//redriect to home page 
		header('location:'.SITEURL.'admin/index.php');
	}else{
		// echo "user not availabe ";
		$_SESSION['login'] = "<div class='error'> Usename or password did not match.</div>";
		//redriect to login page 
		header('location:'.SITEURL.'admin/login.php');
	}

}
?>