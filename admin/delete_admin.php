<?php include '../config/connection.php'; ?>
<?php 
//1.get the id of  admin to delete
$id = $_GET['id'];
//2.create sql query to delete admin
$sql ="DELETE FROM tbl_admin WHERE  id=$id";
//excute the query
$res = mysqli_query($con,$sql);
//3.redirect to admin page 
if ($res==TRUE) {
//data deleted
// echo "data deleted";
//header('location:manage_admin.php');
$_SESSION['Delete'] = "<div class='success'>Admin deleted Successfully.</div>";
//redirect page admin manage
header("location:".SITEURL.'admin/manage_admin.php');
}else{
//data not deleted
$_SESSION['Delete'] = "<div class='error'>Failed To Delete Admin.</div>";
//redirect page add admin
header("location:".SITEURL.'admin/manage_admin.php');
}


 ?>