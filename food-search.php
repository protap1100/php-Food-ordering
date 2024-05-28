 <?php include 'partials_frontent/header.php'; ?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        
        <h2>Foods on Your Search <a href="#" class="text-white"><?php $searchkeyword=$_POST['search']; echo $searchkeyword; ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->
    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 
            
            //get the search keyword 
            $search = mysqli_real_escape_string($con,$_POST['search']);

            //sql query base on search 
            //$search = burger
            // select * from dbll_food title like '%search%' or description like '%%'
            $sql ="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            $res = mysqli_query($con,$sql);

            $count=mysqli_num_rows($res);

            if ($count>0) {
                //Food is Avalible
                while ($row=mysqli_fetch_assoc($res)) {
                       $id=$row['id'];
                       $title=$row['title'];
                       $price=$row['price'];
                       $description=$row['description'];
                       $image_name=$row['image_name'];
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
              echo "No food availabe based on your search "; 
            }

              ?>

            <div class="clearfix"></div>
        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include 'partials_frontent/footer.php'; ?>
