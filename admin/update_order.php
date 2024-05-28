<?php include 'partials/header.php'; ?>

<div class="main-content">
	<div class="wrapper">	
	     <h1>Update Order Status</h1>
	     <br>
	     <?php 
			if (isset($_GET['id'])) {
				     $id = $_GET['id'];

				$sql = "SELECT * FROM dbll_order WHERE id=$id";  
					
				$res=mysqli_query($con,$sql);

				$count=mysqli_num_rows($res);

				if ($count==1) {
					   $row=mysqli_fetch_assoc($res);
					   $status = $row['status'];
					   $price=$row['price'];
						
					   }   
			}

		?>
		<form method="POST">
		<table class="tbl_30">

			
			<tr>
				<td>Order Status:</td>
				<td>
				<select name="status">
					<option <?php if($status =="Ordered"){echo 'selected="selected"';} ?> value="Ordered">Ordered</option>
					<option <?php if($status =="ON delivery"){echo 'selected="selected"';} ?>value="ON delivery">ON delivery</option>
					<option <?php if($status =="Delivered"){echo 'selected="selected"';} ?>value="Delivered">Delivered</option>
					<option <?php if($status =="Cancelled"){echo 'selected="selected"';} ?>value="Cancelled">Cancelled</ootion>
				</select>
				</td>
				<td><?php echo $status; ?></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Update Order"></td>
			</tr>
		</table>
	</form>
	<?php 
// 'selected="selected"'

	if (isset($_POST['submit'])) {
		     $status = $_POST['status'];

		     $sql2 = "UPDATE dbll_order SET 
		     	status='$status' WHERE id=$id";

		     $res2=mysqli_query($con,$sql2);

		     if ($res2==true) {
		     	$_SESSION['success'] = "<div>Status Updated successfully</div>";
		     	header('location:'.SITEURL.'admin/manage_order.php');
		     }
	}


	  ?>

	</div>
</div>

<?php include 'partials/footer.php'; ?>