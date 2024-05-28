<?php include '../config/connection.php'; ?>
<?php 
 

if (isset($_GET['id'])) {
	     $id=$_GET['id'];

	     $sql = "DELETE FROM dbll_order WHERE id=$id";

	     $res=mysqli_query($con,$sql);

	     if ($res==true) {
	     	$_SESSION['deletesuccess'] = "<div class='error' >Deleted Successfully</div>"; 
	     	header('location:'.SITEURL.'admin/manage_order.php');	
	     }
}


 ?>