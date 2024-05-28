<?php include '../config/connection.php';  ?>

<?php  include 'login_check.php'; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Food-ordering-Website-Admin_Panel</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<!-- Main section starts -->
	<div class="menu text-center">
		<div class="wrapper">
			<ui>
				<li> <a href="index.php">Home</a></li>
				<li> <a href="manage_admin.php">Admin</a></li>
				<li> <a href="manage_category.php">Category</a></li>
				<li> <a href="manage_food.php">Food</a></li>
				<li> <a href="manage_order.php">Order</a></li>
				<li> <a href="logout.php">Logout</a></li>
			</ui>
		</div>
	</div>
	<!-- Main section end -->
