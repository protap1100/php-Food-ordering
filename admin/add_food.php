<?php include 'partials/header.php'; ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>
		<br><br>
		<?php 
			if (isset($_SESSION['upload'])) {
				      echo $_SESSION['upload'];
				      unset($_SESSION['upload']);
			}

		?>

		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl_30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Enter your title" required="">
					</td>
				</tr>
				<tr>
					<td>Description:</td>
					<td>
						<textarea name="description" placeholder="Enter your Description" required=""></textarea>
					</td>
				</tr>
				<tr>
					<td>Price:</td>
					<td>
						<input type="number" name="price" placeholder="Enter your Price" required="">
					</td>
				</tr>
				<tr>
					<td>Select Img:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Category:</td>
					<td>
						<select name="category">
							<?php 
							//create sql to show category from database 
							//1.create sql to get data from sql
							$sql = "SELECT * FROM tbl_category WHERE active='yes'";

							$res = mysqli_query($con,$sql);

							$count = mysqli_num_rows($res);
							if ($count>0) {
								//we have cateogry
								while ($row=mysqli_fetch_assoc($res)) {
									//get the value of category details 
									$id = $row['id'];
									$title = $row['title'];
									?>
							          <option value="<?php echo $id;?>"><?php echo "$title";  ?></option>
									<?php
								}
							}else{
								//we don not have any category
								?>
							     <option value="0">No category found </option>
								<?php
							}

							  ?>
							
						</select>
					</td>
				</tr>
				<tr>
					<td>Featured:</td>
					<td>
						<input type="radio" name="featured" value="yes">Yes
						<input type="radio" name="featured" value="no">No
					</td>
				</tr>
				<tr>
					<td>Active:</td>
					<td>
						<input type="radio" name="active" value="yes">Yes
						<input type="radio" name="active" value="no">No
					</td>
				</tr>
				<tr>
					<td colspan="2">
					<input type="submit" name="submit" value="Add Food" class="btn_primary">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'partials/footer.php'; ?>


<?php

if (isset($_POST['submit'])) {
	       $title=mysqli_real_escape_string($con,$_POST['title']);
	       $description=mysqli_real_escape_string($con,$_POST['description']);
	       $price=mysqli_real_escape_string($con,$_POST['price']);
	       $category=mysqli_real_escape_string($con,$_POST['category']);
	       
	       if (isset($_POST['featured'])) {
	       	         $featured=$_POST['featured'];
	       }else{
	       	$featured="no";
	       }
	       if (isset($_POST['active'])) {
	       	         $active=$_POST['active'];
	       }else{
	       	$active="no";
	       }
	       //check whethear  seleted image is cliked or not 
	       if (isset($_FILES['image']['name'])) {
	       	    //get the details of the selected image e
	       	$image_name = $_FILES['image']['name'];
	       	if ($image_name!="") {
	       		//image is selected
	       		//rename the image 
	       		//get the extension 
			    $ext = end(explode('.', $image_name));
	       		$image_name = "Food-Name-".rand(0000,9999).".".$ext; // new image name like image-name-90 
	       		//reupload the image 
	       		$src = $_FILES['image']['tmp_name'];

	       		$dst = "../images/food/".$image_name;

	       		//now upload image 
	       		$upload = move_uploaded_file($src, $dst);
	       		//checke whether image uploaded or not
	       		if ($upload==false) {
	       			//failed to upload image 
	       			//redirect to add food page with error message 
	       			$_SESSION['upload'] = "<div class='error'>Failed to upload the image </div>";
	       			header('location:'.SITEURL.'admin/add_food.php');
	       			//stop the process
	       			die();	
	       		}
	       	}
	       }else{
	       	$image_name = ""; //we will selected default value as blank
	       }

	       //need to create sql fo ruploading to this into database 

	       $sql2 = "INSERT INTO tbl_food SET
	       	title =' $title',
	       	description = '$description',
	       	price = '$price',
	        image_name = '$image_name',
	        category_id = $category, 
	        featured = '$featured',
	        active = '$active'
	       ";
	       //for numeraical value we dont need to put single quetos 

	       $res2 = mysqli_query($con,$sql2);
	       if ($res2==TRUE) {
	       	//DATA Inserted successfully
	       	$_SESSION['add'] = "<div class='success'>Food Added successfully </div>";
	       	header('location:'.SITEURL.'admin/manage_food.php');
	       }else{
	       	//data not inserted successfully
	       	$_SESSION['error'] = "<div class='eror'>Failed to add food  </div>";
	       }

}

?>