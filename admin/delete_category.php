<?php include '../config/connection.php'; ?>

<?php 


if (isset($_GET['id']) AND  isset($_GET['image_name'])) {

	$id=$_GET['id'];
	$image_name=$_GET['image_name'];

	if ($image_name !== "") {
		 $path = "../images/category/".$image_name;
		 //remove the image
		 $remove = unlink($path); 
		 if ($remove==false) {
		 	$_SESSION['remove'] = "<div class='error'>failed to remove image</div>";
		 	header('location:'.SITEURL.'admin/manage_category.php');
		 	   die();
		 }
	}

	 $sql = "DELETE FROM tbl_category WHERE id='$id'";
	 $res=mysqli_query($con,$sql);

	 if ($res==TRUE) {
		 $_SESSION['remove'] = "<div class='error'> Category Removed Succesfully</div>";
	     header('location:'.SITEURL.'admin/manage_category.php');
	 }else{
	 	$_SESSION['notdeleted'] = "<div class='error'> Failed To Removed </div>";
	     header('location:'.SITEURL.'admin/manage_category.php');
	 }
	
}else{
	echo "ok";
	header('location:'.SITEURL.'admin/manage_category.php');
}


 ?>

<!-- 
 $sql = "DELETE FROM tbl_category WHERE id='$id' AND image_name='$image_name";
	$res=mysqli_query($con,$sql); -->