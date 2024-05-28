<?php include 'partials/header.php';  ?>
<!-- Main content section starts -->
<div class="main-content">
 <div class="wrapper">
	<h1>Manage Admin</h1>
	<br>
	<?php
		if (isset($_SESSION['add'])) {
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if (isset($_SESSION['Delete'])) {
			echo $_SESSION['Delete'];
			unset($_SESSION['Delete']);
		}
		if (isset($_SESSION['update'])) {
			echo $_SESSION['update'];
			unset($_SESSION['update']);
		}
		if (isset($_SESSION['user-not-found'])) {
			echo $_SESSION['user-not-found'];
			unset($_SESSION['user-not-found']);
		}
		if (isset($_SESSION['pwd-not-match'])) {
			echo $_SESSION['pwd-not-match'];
			unset($_SESSION['pwd-not-match']);
		}
		if (isset($_SESSION['change-pwd'])) {
			echo $_SESSION['change-pwd'];
			unset($_SESSION['change-pwd']);
		}
		if (isset($_SESSION['failed-pwd'])) {
			echo $_SESSION['failed-pwd'];
			unset($_SESSION['failed-pwd']);
		}
		if (isset($_SESSION['success'])) {
			 echo $_SESSION['success'];
			 unset($_SESSION['success']);
		}
	?>
	<br>
	<br>

	<!-- BUtton add to admin -->
	<a href="add_admin.php" class="btn_primary">Add Admin</a>
	<br><br>
	<table class="tbl_full">
		<tr>
			<th>S.N</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Actions</th>
		</tr>

		<?php
		//query to get admin
			$sql ="SELECT * FROM  tbl_admin";
			//excute the query
			$res = mysqli_query($con,$sql);
			//condition
			if ($res==TRUE) {
				// count rows to check whether we have data or not 
				$count = mysqli_num_rows($res);
				$sn=1;

				if ($count>0) {
				   //we have data in database 
					while($rows=mysqli_fetch_assoc($res)){
						//using while loop to get all the data from database 
						$id=$rows['id'];
						$full_name=$rows['full_name'];
						$username=$rows['username'];

						//display the  values in our table using html
						?>
						    <tr>
								<td><?php echo $sn++; ?></td>
								<td><?php echo $full_name; ?></td>
								<td><?php echo $username; ?></td>
								<td>
								   <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn_primary">Change Password</a>
								   <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn_secondary">Update</a>
								   <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?> " class="btn_danger">Delete</a>
							    </td>
							</tr>
						<?php
					}
				}else{
					// no data here
				}
			}
		?>
	</table>
  </div>
 </div>
	<!-- Main content section end -->

<?php include 'partials/footer.php'; ?>