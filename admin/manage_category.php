<?php include 'partials/header.php'; ?>

<div class="main-content">
	<div class="wrapper">	
	     <h1>Manage Category</h1>
	     	<?php  
	     		if (isset($_SESSION['category'])) {
	     			echo $_SESSION['category'];
	     			unset($_SESSION['category']);
	     		} 
	     		if (isset($_SESSION['remove'])) {
	     			echo $_SESSION['remove'];
	     			unset($_SESSION['remove']);
	     		}
	     		if (isset($_SESSION['notdeleted'])) {
	     			echo $_SESSION['notdeleted'];
	     			unset($_SESSION['notdeleted']);
	     		}
	     		if (isset($_SESSION['nocategory'])) {
	     			echo $_SESSION['nocategory'];
	     			unset($_SESSION['nocategory']);
	     		}
	     		if (isset($_SESSION['update'])) {
	     			echo $_SESSION['update'];
	     			unset($_SESSION['update']);
	     		}
	     		if (isset($_SESSION['noll'])) {
	     			echo $_SESSION['noll'];
	     			unset($_SESSION['noll']);
	     		}
	     		if (isset($_SESSION['upload'])) {
	     			echo $_SESSION['upload'];
	     			unset($_SESSION['upload']);
	     		}
	     		if (isset($_SESSION['failed_remove'])) {
	     			echo $_SESSION['failed_remove'];
	     			unset($_SESSION['failed_remove']);
	     		}
	     	?>
	   		<br>
		<!-- BUtton add to admin -->
		<a href="add_category.php" class="btn_primary">Add Category</a>
		<br><br>
		<table class="tbl_full">
			<tr>
				<th>S.N</th>
				<th>Title</th>
				<th>Image</th>
				<th>Featured</th>
				<th>Active</th>
				<th>Action</th>
			</tr>
			   <?php
				$sql= "SELECT * FROM tbl_category";

				$res = mysqli_query($con,$sql);

				$count = mysqli_num_rows($res);
				$sn=1;

				if ($count>0) {
						while ($row=mysqli_fetch_assoc($res)) {
							$id=$row['id'];
							$title=$row['title'];
							$image_name=$row['image_name'];
							$featured=$row['featured'];
							$active=$row['active'];

							?>
								<tr>
									<td><?php echo $sn++;?></td>
									<td><?php echo $title; ?></td>

									<td>
										<?php 
											if ($image_name!=="") {
												?>
													<img src="<?php echo SITEURL;?>images/category/<?php  echo $image_name;?>" width="100px" height="auto">
												<?php
											}else{
												echo "Image not availabe";
											}

										?>	
									</td>

									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
									   <a href="<?php echo SITEURL;  ?>admin/update_category.php?id=<?php echo $id; ?>" class="btn_secondary">Update Category</a>
									   <a href="<?php echo SITEURL;  ?>admin/delete_category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Category</a>
								    </td>
								</tr>

							<?php
						}
					
				}else{
					?>
					<tr>
						<td colspan="6" ><div class="error">No Category Added</div></td>
					</tr>
					<?php

				}
				?>
		</table>
	</div>
</div>

<?php include 'partials/footer.php'; ?>