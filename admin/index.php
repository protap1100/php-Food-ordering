<?php include 'partials/header.php'; ?>
	<!-- Main content section starts -->
	<div class="main-content">
		<div class="wrapper">
		<h1>Dashboard</h1>

		<?php
			if (isset($_SESSION['login'])) {
			 echo $_SESSION['login'];
			 unset($_SESSION['login']);
		}
		?>
		<div class="col-4 text-center dashboard">
			<?php 
			$sql = "SELECT * FROM tbl_category";

			$res=mysqli_query($con,$sql);

			$count= mysqli_num_rows($res);

			 ?>
			<h1><?php echo $count;?></h1>
			<br>
			  Categories
		</div>
		<div class="col-4 text-center dashboard">
			<?php 
			$sql2="SELECT * FROM tbl_food";

			$res2=mysqli_query($con,$sql2);

			$count2 = mysqli_num_rows($res2);
			 ?>
			<h1><?php echo $count2; ?></h1>
			<br>
			  Food Available
		</div>
		<div class="col-4 text-center dashboard">
			<?php 
			$sql3="SELECT * FROM dbll_order";

			$res3=mysqli_query($con,$sql3);

			$count3 = mysqli_num_rows($res3);
			 ?>
			<h1><?php echo $count3; ?></h1>
			<br>
			  Total Order
		</div>
		<div class="col-4 text-center dashboard">
			<?php  	

			$sql4 = "SELECT  SUM(total) AS  Total FROM dbll_order WHERE status='Delivered'"; 

			$res4=mysqli_query($con,$sql4);

			$row4=mysqli_fetch_assoc($res4);

			$total_revenu = $row4['Total'];

			  ?>

			<h1><?php if ($total_revenu=="") { echo "No Revenu";}else{echo $total_revenu;}  ?></h1>
			<br>
			  Revenu Generator
		</div>
		<div class="clearfix">
			
		</div>
		</div>
	</div>
	<!-- Main content section end -->
<?php  include 'partials/footer.php';  ?>