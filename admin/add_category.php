<?php include 'partials/header.php'; ?>
<div class="main-content">
	<div class="wrapper">
		<h1>Add Category</h1>
		<br><br>
		<?php  
	     		if (isset($_SESSION['error'])) {
	     			echo $_SESSION['error'];
	     			unset($_SESSION['error']);
	     		}

	     		if (isset($_SESSION['upload'])) {
	     			echo $_SESSION['upload'];
	     			unset($_SESSION['upload']);
	     		}
	     	?>
		<!-- Start Add category form-->
		<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl_30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" placeholder="Enter your title" required="">
					</td>
				</tr>
				<tr>
					<td>Select Img:</td>
					<td>
						<input type="file" name="image">
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
					<input type="submit" name="submit" value="Add category" class="btn_primary">
					</td>
				</tr>
			</table>
		</form>
		<!-- End Add category form-->	
		<?php
		//1.check botton clicked or not 
		if (isset($_POST['submit'])) {
		//2.get the value from form 
			$title= mysqli_real_escape_string($con,$_POST['title']);
		//3.for radio input type we not check its clicked or not 
			if(isset($_POST['featured'])){
				//.get the value 
				$featured=$_POST['featured'];
			}else{
				$featured ="no";
			}
			if (isset($_POST['active'])) {

				$active=$_POST['active'];
			}else{
				$active="no";
			}
			//check image selected or not and set the value for image name 
			// print_r($_FILES['image']);

			// die(); // break the code here

			if (isset($_FILES['image']['name'])) {
				//upload the image
				// to upload the image we need image name and source path and destinesation path
				$image_name = $_FILES['image']['name'];
				//upload the image if the image is selected 
				if ($image_name != "") {
					
					//auto rename our image
					//get the extension  of our image (img,jpg) e.g. image.jpg
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
						header('loaction:'.SITEURL.'admin/add_category.php');
						die();
					}
				}
			}else{
				// image will be not be uploaded
				$image_name="";
			}

		    //4.create sql to enter this into database 

			$sql = "INSERT INTO tbl_category SET 
				title ='$title',
				image_name ='$image_name',
				featured = '$featured',
				active='$active'";

			//5.executed the query and save to database 
			$res = mysqli_query($con,$sql);
			//6.check the things
			if ($res==true) {
				$_SESSION['category'] = "<div class='success'>Category Added Successfully.</div>";
				header("location:".SITEURL.'admin/manage_category.php');
			}else{
				$_SESSION['error'] = "<div class='success'>Unable to Add Category.</div>";
				header("location:".SITEURL.'admin/add_category.php');
			}

		}

		?>

	</div>
</div>
<?php include 'partials/footer.php'; ?>