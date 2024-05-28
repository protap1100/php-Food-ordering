<?php include 'partials/header.php'; ?>

<div class="main-content">
	<div class="wrapper">	
	     <h1>Manage Food</h1>
	     <?php
	     if (isset($_SESSION['add'])) {
	     	echo $_SESSION['add'];
	     	unset($_SESSION['add']);
	     }
	      if (isset($_SESSION['remove'])) {
	     	echo $_SESSION['remove'];
	     	unset($_SESSION['remove']);
	     }
	     if (isset($_SESSION['failed'])) {
	     	echo $_SESSION['failed'];
	     	unset($_SESSION['failed']);
	     }
	     if (isset($_SESSION['upload'])) {
	     	echo $_SESSION['upload'];
	     	unset($_SESSION['upload']);
	     }
	      if (isset($_SESSION['success'])) {
	     	echo $_SESSION['success'];
	     	unset($_SESSION['success']);
	     }
	     ?>
	     <br>

		<!-- BUtton add to admin -->
		<a href="add_food.php" class="btn_primary">Add Food</a>
		<br><br>
		<table class="tbl_full">
			<tr>
				<th class="text-center">S.N</th>
				<th class="text-center">Title</th>
				<th class="text-center">Price</th>
				<th class="text-center">Image_name</th>
				<th class="text-center">Featured</th>
				<th class="text-center">Active</th>
				<th class="text-center">Actions</th>
			</tr>
			 <?php
				$sql= "SELECT * FROM tbl_food";

				$res = mysqli_query($con,$sql);

				$count = mysqli_num_rows($res);
				$sn=1;

				if ($count>0) {
						while ($row=mysqli_fetch_assoc($res)) {
							$id=$row['id'];
							$title=$row['title'];
							$price=$row['price'];
							$image_name=$row['image_name'];
							$featured=$row['featured'];
							$active=$row['active'];

							?>
								<tr>
									<td class="text-center"><?php echo $sn++;?></td>
									<td class="text-center"><?php echo $title; ?></td>
									<td class="text-center"><?php echo $price; ?></td>

									<td class="text-center" width="10px">
										<?php 
											if ($image_name!=="") {
												?>
													<img  style="width:120px; height=120px;" src="<?php echo SITEURL;?>images/food/<?php  echo $image_name;?>" height="auto">
												<?php
											}else{
												echo "Image not availabe";
											}

										?>	
									</td>
									<td class="text-center" ><?php echo $featured; ?></td>
									<td class="text-center" ><?php echo $active; ?></td>
									<td class="text-center">
									   <a href="<?php echo SITEURL;  ?>admin/update_food.php?id=<?php echo $id; ?>" class="btn_secondary">Update</a>
									   <a href="<?php echo SITEURL;  ?>admin/delete_food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete</a>
								    </td>
								</tr>

							<?php
						}
					
				}else{
					?>
					<tr>
						<td colspan="6" ><div class="error">No Food Added</div></td>
					</tr>
					<?php

				}
				?>
		</table>
	</div>
</div>

<?php include 'partials/footer.php'; ?>



