<?php include 'partials_frontent/header.php'; ?>
<?php 

if (isset($_GET['category_id'])) {
    $category_id=$_GET['category_id'];
    //GET THE CATEGORY TITLE BASED  ON  ID 
    $sql ="SELECT title FROM tbl_category WHERE  id=$category_id";

    $res= mysqli_query($con,$sql);

    $row= mysqli_fetch_assoc($res);

    $category_title = $row['title'];

}else{
    header('location:'.SITEURL);
}


    ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php  

            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

             $res2=  mysqli_query($con,$sql2);

             $count=mysqli_num_rows($res2);

             if ($count>0) {
                 while ($row2=mysqli_fetch_assoc($res2)) {
                       $id=$row2['id'];
                       $title=$row2['title'];
                       $price=$row2['price'];
                       $description=$row2['description'];
                       $image_name=$row2['image_name'];
                       $title=$row2['title'];
                       ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                               <?php
                            //check if the image is availabe or not 
                            if($image_name == ""){
                                //display the msg
                                echo"<div class='error' >image not availabe</div>";
                            }else{
                                // echo "we will show the image ";
                                ?>
                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?> " alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }

                             ?>
                            </div>
                            <div class="food-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?></p>
                                <p class="food-detail">
                                   <?php echo $description; ?>
                                </p>
                                <br>
                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                       <?php
                 }
             }else{
                echo "<div class='error'>Food not availabe</div>";
             }

            ?>

          
            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include 'partials_frontent/footer.php'; ?>
 