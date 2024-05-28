<?php include 'partials/header.php'; ?>
<div class="main_content">
	<div class="wrapper">
		<h1>Change Password</h1>
		<br><br>
		<?php

		  if (isset($_GET['id'])) {
			$id=$_GET['id'];
		  } 
		?>

		<form action="" method="POST">
			<table class="tbl_30">
				<tr>
					<td>Current Password:</td>
					<td>
						<input type="password" name="current_password" placeholder="Current Password">
					</td>
				</tr>
				<tr>
					<td>Password:</td>
					<td> 
						<input type="password" name="new_password" placeholder="New Password">
					</td>
				</tr>
				<tr>
					<td>Confirm Password:</td>
					<td> <input type="password" name="confirm_password" placeholder="confirm password"> </td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Change_Password" class="btn_primary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
	
	//checked whether the submit button is clicked or not 
		
		if (isset($_POST['submit'])) {
			// echo"OK";

			//1.GET data from form
			$id=mysqli_real_escape_string($con,$_POST['id']);
			$current_password=md5($_POST['current_password']);
			$new_password=md5($_POST['new_password']);
			$confirm_password=md5($_POST['confirm_password']);
			//2.check whether the user current id or password exist or not 
			$sql ="SELECT * FROM `tbl_admin` WHERE id=$id AND password='$current_password'";
			//excute the query
			$res = mysqli_query($con,$sql);

			if ($res==TRUE) {

				$count=mysqli_num_rows($res);
				
				if($count==1){
					//user exist
					// echo "user found";
					//check whether   new password match or not 
					if($new_password==$confirm_password){
							// echo "password_match";
						$sql2 = "UPDATE tbl_admin SET
								password = '$new_password'
								WHERE id=$id
						        ";
						        $res2= mysqli_query($con,$sql2);
						        //check query is executed or not 
						        if ($res2==TRUE) {
						        	 $_SESSION['change-pwd'] ="<div class='error'>Password Changed Successfully </div>";
					                 header('location:'.SITEURL.'admin/manage_admin.php');
						        }else{
						        	 $_SESSION['failed-pwd'] ="<div class='error'>Failed to change password </div>";
					                 header('location:'.SITEURL.'admin/manage_admin.php');
						        }

					}else{
						$_SESSION['pwd-not-match'] ="<div class='error'>Password did not match </div>";
					    header('location:'.SITEURL.'admin/manage_admin.php');
					}

				}else{
					//user does not exist
					$_SESSION['user-not-found'] ="<div class='error'>user not found </div>";
					header('location:'.SITEURL.'admin/manage_admin.php');
				}
			}
			//3.check whether current or new password match or not 

			//4.update the password
		}


?>


<?php include 'partials/footer.php'; ?>