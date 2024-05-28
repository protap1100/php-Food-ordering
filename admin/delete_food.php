<?php include '../config/connection.php'; ?>
<?php 


if (isset($_GET['id']) AND  isset($_GET['image_name'])) {

	$id=$_GET['id'];
	$image_name=$_GET['image_name'];

	if ($image_name !== "") {
		 $path = "../images/food/".$image_name;
		 //remove the image
		 $remove = unlink($path); 
		 if ($remove==false) {
		 	$_SESSION['remove'] = "<div class='error'>failed to remove image</div>";
		 	header('location:'.SITEURL.'admin/manage_food.php');
		 	   die();
		 }
	}

	 $sql = "DELETE FROM tbl_food WHERE id='$id'";
	 $res=mysqli_query($con,$sql);

	 if ($res==TRUE) {
		 $_SESSION['remove'] = "<div class='success'> Food Removed Succesfully</div>";
	     header('location:'.SITEURL.'admin/manage_food.php');
	 }else{
	 	$_SESSION['failed'] = "<div class='error'> Failed To Remove Food </div>";
	     header('location:'.SITEURL.'admin/manage_food.php');
	 }
	
}else{
	echo "ok";
	header('location:'.SITEURL.'admin/manage_food.php');
}


 ?>

<!-- 
 $sql = "DELETE FROM tbl_category WHERE id='$id' AND image_name='$image_name";
	$res=mysqli_query($con,$sql); -->