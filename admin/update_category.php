<?php include 'partials/header.php'; ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Update Category</h1>
		<br><br>

		<?php

		if (isset($_GET['id'])) {
		
			$id=$_GET['id'];

			$sql = "SELECT * FROM tbl_category WHERE id=$id";

			$res = mysqli_query($con,$sql);

			$count = mysqli_num_rows($res);

			if ($count==1) {
					$row = mysqli_fetch_assoc($res);
					$title = $row['title'];
					$current_image = $row['image_name'];
					$featured = $row['featured'];
					$active = $row['active'];
			}else{
				$_SESSION['nocategory']= "<div class='error'>Category Not Found</div>";
				header('location:'.SITEURL.'admin/manage_category.php');
			}

		}else{
			header('location:'.SITEURL.'admin/manage_category.php');
		}

		?>



		<!-- Start Manage category form-->
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl_30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Enter your title"  value="<?php echo $title; ?>">
					</td>
				</tr>
				<tr>
					<td>Current Img:</td>
					<td>
						<?php 
						if ($current_image != "") {
							?>
							<img width="200px" src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>">
							<?php

						}else{
							echo "<div class='error'>Image not added</div>";
						}

						 ?>
					</td>
				</tr>
				<tr>
					<td>new Img:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured:</td>
					<td>
						<input <?php  if($featured=="yes"){ echo "Checked";} ?> type="radio" name="featured" value="yes">Yes
						<input <?php  if($featured=="no"){ echo "Checked";} ?> type="radio" name="featured" value="no">No
					</td>
				</tr>
				<tr>
					<td>Active:</td>
					<td>
						<input <?php  if($active=="yes"){ echo "Checked";} ?> type="radio" name="active" value="yes">Yes
						<input <?php  if($active=="no"){ echo "Checked";} ?> type="radio" name="active" value="no">No
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="hidden" name="current_image" value="<?php echo $current_image;?>">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="submit" name="submit" value="Update category" class="btn_primary">
					</td>
				</tr>
			</table>
		</form>
		<!-- End Manage category form-->
		<?php
		if (isset($_POST['submit'])) {
			// echo "clicked";
			$id = mysqli_real_escape_string($con,$_POST['id']);
			$title = mysqli_real_escape_string($con,$_POST['title']);
			$current_image = mysqli_real_escape_string($con,$_POST['current_image']);
			$featured = mysqli_real_escape_string($con,$_POST['featured']);
			$active = mysqli_real_escape_string($con,$_POST['active']);
			//updating new image 
			//update the database 
			if (isset($_FILES['image']['name'])) {
				$image_name = $_FILES['image']['name'];
				if ($image_name!="") {
					//upload the new image 
					$ext = end(explode('.', $image_name));
					//rename the image 
					$image_name = "food_category_".rand(000,999).'.'.$ext; // e.g food_category.jpg

					$source_path = $_FILES['image']['tmp_name'];

					$destination_path = "../images/category/".$image_name;
					//upload the image 
					$upload= move_uploaded_file($source_path,$destination_path);
					//check if uploaded or not 
					if ($upload==FALSE) {
						$_SESSION['upload'] = "<div class='error'>Failed to upload image </div>";
						header('loaction:'.SITEURL.'admin/manage_category.php');
						die();
					}
					//remove the current image 
					if ($current_image !=="") {
						$remove_path = "../images/category/".$current_image;
				    	$remove =unlink($remove_path);
					    //check whether the image is removed or not if failed to remove diplay msg and stop th proccess
					    if ($remove==false) {
						//failed to remove the image 
						$_SESSION['failed_remove'] = "<div class='error'>Failed to remove current image.</div>";
						header('location:'.SITEURL.'admin/manage_category.php');	
						die();				}
					}
					
				}else{
					$image_name = $current_image;
				}
			}else{
				$image_name = $current_image;
			}


			$sql2= "UPDATE tbl_category SET 
			title = '$title',
			image_name='$image_name',
			featured = '$featured',
			active = '$active'
			WHERE id=$id
			";

			$res2 = mysqli_query($con,$sql2);

			if ($res2==TRUE) {
				$_SESSION['update'] = "<div class='success'> Category Updated successfully</div>";
				header('location:'.SITEURL.'admin/manage_category.php');
			}else{
			//redirect to manage category with  message 
			$_SESSION['noll'] = "<div class='error'> Category failed to updated</div>";
			header('location:'.SITEURL.'admin/manage_category.php');
		}
	}

		?>


	</div>
</div>
<?php include 'partials/footer.php'; ?>