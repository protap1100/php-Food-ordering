<?php
	//start session
	session_start();

	define('SITEURL','http://localhost/food_ordering/');

	$con= mysqli_connect("localhost","root","","food-order");
	if (!$con) {
		echo "thanksssssssss";
	}
?>