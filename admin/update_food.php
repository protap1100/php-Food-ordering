<?php include 'partials/header.php'; ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Update Food</h1>
		<br><br>
		<?php
		if (isset($_GET['id'])) {
			$id=$_GET['id'];

			$sql = "SELECT * FROM tbl_food WHERE id=$id";
			$res = mysqli_query($con,$sql);

			$count = mysqli_num_rows($res);

			if ($count==1) {
				$row = mysqli_fetch_assoc($res);
				$title = $row['title'];
				$description = $row['description'];
				$price = $row['price'];
				$current_category = $row['category_id'];
				$current_image = $row['image_name'];
				$featured = $row['featured'];
				$active = $row['active'];
			}
		}
		?>
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl_30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Enter your title" value="<?php echo $title; ?>" required="">
					</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>
						<textarea name="description" placeholder="Enter your Description"  value="" required=""><?php echo $description; ?></textarea>
					</td>
				</tr>
				<tr>
					<td>Price:</td>
					<td>
						<input type="number" name="price" placeholder="Enter your Price" value="<?php echo $price; ?>" required="">
					</td>
				</tr>
				<tr>
					<td>Current Img:</td>
					<td>
					<img width="100px" src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>">
					</td>
				</tr>
				<tr>
					<td>New Img:</td>
					<td>
					<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Category:</td>
					<td>
						<select name="category">
							     <?php 

							     $sql3 = "SELECT * FROM tbl_category WHERE active='yes'";
							     $res3 = mysqli_query($con,$sql3);

							     $count = mysqli_num_rows($res3);

							     if ($count>0) {
							     	while ($row=mysqli_fetch_assoc($res3)) {
							     		$category_title = $row['title'];
							     		$category_id=$row['id'];
							     		// echo "<option value='$category_id'>$category_title</option>";
							     		?>
							     		<option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo"$category_id"; ?>" ><?php echo $category_title; ?></option>
							     		<?php 
							     	}
							     }else{
							     	echo "<option value='0'>Category Not Availabe </option>";
							     }


							      ?>
							     <option value="0">No category found </option>
						</select>
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
					    <input type="submit" name="submit" value="Update Food" class="btn_primary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'partials/footer.php'; ?>



<?php

if (isset($_POST['submit'])) {
          $id=mysqli_real_escape_string($con,$_POST['id']);
	      $title=mysqli_real_escape_string($con,$_POST['title']);
	      $description = mysqli_real_escape_string($con,$_POST['description']);
	      $price = mysqli_real_escape_string($con,$_POST['price']);
	      $current_image = mysqli_real_escape_string($con,$_POST['current_image']);
	      $category = mysqli_real_escape_string($con,$_POST['category']);
		  $featured = mysqli_real_escape_string($con,$_POST['featured']);
		  $active = mysqli_real_escape_string($con,$_POST['active']);

		  if (isset($_FILES['image']['name'])) {
				$image_name = $_FILES['image']['name'];
				if ($image_name!="") {
					//upload the new image 
					$ext = end(explode('.', $image_name));
					//rename the image 
					$image_name = "food-name-".rand(000,999).'.'.$ext; // e.g food_category.jpg

					$source_path = $_FILES['image']['tmp_name'];

					$destination_path = "../images/food/".$image_name;
					//upload the image 
					$upload= move_uploaded_file($source_path,$destination_path);
					//check if uploaded or not 
					if ($upload==FALSE) {
						$_SESSION['upload'] = "<div class='error'>Failed to upload image </div>";
						header('loaction:'.SITEURL.'admin/manage_food.php');
						die();
					}
					//remove the current image 
					if ($current_image !="") {
						$remove_path = "../images/food/".$current_image;
				    	$remove =unlink($remove_path);
					    //check whether the image is removed or not if failed to remove diplay msg and stop th proccess
					    if ($remove==false) {
						//failed to remove the image 
						$_SESSION['failed_remove'] = "<div class='error'>Failed to remove current image.</div>";
						header('location:'.SITEURL.'admin/manage_food.php');	
						die();				}
					}
					
				}else{
					$image_name = $current_image;
				}
			}else{
				$image_name = $current_image;
			}


			$sql2= "UPDATE tbl_food SET
				title='$title',
				description='$description',
				price='$price',
				image_name ='$image_name',
				category_id='$category',
				featured ='$featured',
				active = '$active'
				WHERE id=$id";


				$res = mysqli_query($con,$sql2);

				if ($res==TRUE) {
					$_SESSION['success'] = "<div class='success'> Food Updated Susccessfully </div>";
					header('location:'.SITEURL.'admin/manage_food.php');
				}else{
					$_SESSION['nodone'] = "<div class='error'>Failed to Updated Food</div>";
					header('location'.SITEURL.'admin/manage_food.php');
				}





}

?>


