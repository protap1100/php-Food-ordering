<?php include 'partials/header.php'; ?>

<div class="main-content">
	<div class="wrapper">	
	     <h1>Manage Order</h1>
	     <h2 class="success">
	     	<?php
	     	if (isset($_SESSION['success'])) {
	     		    echo $_SESSION['success'];
	     		    unset($_SESSION['success']);
	     	}
	     	if (isset($_SESSION['deletesuccess'])) {
	     		     echo $_SESSION['deletesuccess'];
	     		     unset($_SESSION['deletesuccess']);
	     	}

	     	?>

	     </h2>

		<table class="tbl_full">
			<tr>
				<th>Order ID:</th>
				<th>Customer Name:</th>
				<th>Customer Email:</th>
				<th>Customer Address:</th>
				<th>Customer Contact:</th>
				<th>Order Status:</th>
				<th>Food Name:</th>
				<th>Food Quantity:</th>
				<th>Food Price:</th>
				<th>Food Total:</th>
				<th>Order Date:</th>
				<th>Actions:</th>
			</tr>
			<tr>
				<?php

				$sql= "SELECT * FROM dbll_order";

				$res=mysqli_query($con,$sql);

				$count=mysqli_num_rows($res);

				if ($count>0) {
					while ($row=mysqli_fetch_assoc($res)) {
						  $id=$row['id'];
						  $food=$row['food'];
						  $price=$row['price'];
						  $qty=$row['qty'];
						  $total=$row['total'];
						  $order_date=$row['order_date'];
						  $status=$row['status'];
						  $customer_name=$row['customer_name'];
						  $customer_contact=$row['customer_contact'];
						  $customer_email=$row['customer_email'];
						  $customer_address=$row['customer_address'];
						  ?>
						  				<td><?php echo $id; ?></td>
								        <td><?php echo $customer_name; ?></td>
										<td><?php echo $customer_email; ?></td>
										<td><?php echo $customer_address; ?></td>
										<td><?php echo $customer_contact; ?></td>
										<td><?php echo $status; ?></td>
										<td><?php echo $food; ?></td>
										<td><?php echo $qty; ?></td>
										<td><?php echo $price; ?></td>
										<td><?php echo $total; ?></td>
										<td><?php echo $order_date; ?></td>	
										<td>
										   <a href="<?php echo SITEURL; ?>admin/update_order.php?id=<?php echo $id; ?>" class="btn_primary">Update</a>
										   <a href="<?php echo SITEURL; ?>admin/delete_order.php?id=<?php echo $id; ?>" class="btn_danger">Delete</a>
									    </td>
									</tr>
			

						  <?php
					}
				}


				 ?>

		</table>
	</div>
</div>

<?php include 'partials/footer.php'; ?>