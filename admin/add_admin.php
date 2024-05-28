<?php include 'partials/header.php'; ?>
<div class="main-content">
		<div class="wrapper">
			<h1>Add Admin</h1>
			<br>
			<?php 
				if (isset($_SESSION['add'])) {
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
			?>
			<form action="" method="POST">
				<table class="tbl_30">
					<tr>
						<td>Full Name:</td>
						<td><input type="text" name="full_name" placeholder="Enter your name" required=""></td>
					</tr>
					<tr>
						<td>Username:</td>
						<td>
							<input type="text" name="username" placeholder="Username" required="">
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input type="password" name="password" placeholder="Password" required="">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							 <input type="submit" name="submit" value="Add Admin" class="btn_secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
</div>
<?php include 'partials/footer.php'; ?>

<?php
	//proccess the value from form and 	save it to database
	//check  whather the bottom clicked ot not
	//1. get the data from form 
if (isset($_POST['submit'])) {
	$full_name=mysqli_real_escape_string($con,$_POST['full_name']);
	$username=mysqli_real_escape_string($con,$_POST['username']);
	$password=md5($_POST['password']); //password encryped 

	//2.sql insert into table
	$con= mysqli_connect("localhost","root","","food-order");

	$sql = "INSERT INTO tbl_admin SET 
						full_name='$full_name',
						username='$username',
						password='$password'";

				$res =mysqli_query($con,$sql) or die(mysqli_error());		

			if ($res==TRUE) {
				//data inserted
				// echo "data inserted";
				//header('location:manage_admin.php');
				$_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
				//redirect page admin manage
				header("location:".SITEURL.'admin/manage_admin.php');
				}else{
				//data not inserted
				$_SESSION['add'] = "<div class='error'>Failed To Add Admin. </div>";
				//redirect page add admin
				header("location:".SITEURL.'admin/manage_admin.php');
				}
}
?>

