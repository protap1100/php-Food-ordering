<?php include 'partials/header.php'; ?> 

	<div class="main_content">
		<div class="wrapper">
			<h1>Update Admin</h1>
			<br><br>
			<?php
			    //1. grt the id from the selected id
				$id=$_GET['id'];
				//2. CREATE QUERY FOR UPDATE
				$sql = "SELECT * FROM tbl_admin";
				//3.excute the query
				$res=mysqli_query($con,$sql);
				//4.check query 
				if ($res==TRUE) {
					//check the data is available or not 
					$count= mysqli_num_rows($res);
					if($count==1){
						// echo "Admin available";
						$row=mysqli_fetch_assoc($res);
						$full_name = $row['full_name'];
						$username = $row['username'];
					}else{
						header('location:'.SITEURL.'admin/manage_admin.php');
					}
				}
			?>
			<form action="" method="POST">
				<table class="tbl_30">
						<tr>
							<td>Full Name:</td>
							<td>
								<input type="text" name="full_name" value="<?php echo $full_name; ?>">
							</td>
						</tr>	
						<tr>
							<td>Username:</td>
							<td>
								<input type="text" name="username" value="<?php echo $username; ?>">
							</td>
						</tr>
						<tr>
							
							<td colspan="2">
								<input type="hidden" name="id" value="<?php echo $id ;?>">
								<input type="submit" name="submit" value="Update admin" class="btn_secondary">
							</td>
						</tr>
				</table>
			</form>
		</div>
	</div>
	<?php
     //1.check whether submit button is clickced or not 
	if (isset($_POST['submit'])) {
	 //2.get all the values for update
		$id =mysqli_real_escape_string($con, $_POST['id']);
		$full_name =mysqli_real_escape_string($con, $_POST['full_name']);
		$username = mysqli_real_escape_string($con,$_POST['username']);

		//create a sql query  to update admin
		$sql= "UPDATE tbl_admin SET
				full_name = '$full_name',
				username = '$username'
		        WHERE id='$id'";

		        $res =mysqli_query($con,$sql);
		        //check query
		        if ($res==TRUE) {
		        	$_SESSION['update'] = "<div class='success'> Admin Updated successfully </div>";
		        	header('location:'.SITEURL.'admin/manage_admin.php');
		        }else{
		        	$_SESSION['update'] = "<div class='error'> Failed to  Updated Admin </div>";
		        	header('location:'.SITEURL.'admin/manage_admin.php');
		        }
	}


	?>

<?php include 'partials/footer.php'; ?> 
