   <?php include 'partials_frontent/header.php'; ?>

    <section class="food-search text-center">
        <div class="container">
          
            <form action="food-search.php"  method="POST">
                <input type="search" name="search" class="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
      <?php 
            if (isset($_SESSION['order'])) {
                echo $_SESSION['order'];
                unset($_SESSION['order']);
            }
             ?>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php   
            //create sql query fto show data from database 

            $sql = "SELECT * FROM tbl_category WHERE active='yes' and featured ='yes' LIMIT 3";

            $res = mysqli_query($con,$sql);

            $count = mysqli_num_rows($res);
            //check the rows is availabe or not 
            if ($count>0){
                
                while ($row=mysqli_fetch_assoc($res)) {
                    //get the values 
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                    <a href="category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                            //check if the image is availabe or not 
                            if($image_name == ""){
                                //display the msg
                                echo"<div class='error' >image not availabe</div>";
                            }else{
                                // echo "we will show the image ";
                                ?>
                                   <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?> " alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }

                             ?>
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                    </a>
                    <?php
                }
            }else{
                echo "<div class='error'>No Categories availabe</div>";
            }
               ?>

           
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <div class="food-menu-main">

            <?php 
            $sql ="SELECT * FROM tbl_food WHERE featured='yes' AND active='yes' limit 4 ";

            $res= mysqli_query($con,$sql);

            $count=mysqli_num_rows($res);

            if ($count>0) {
                while ($row=mysqli_fetch_assoc($res)) {
                       $id=$row['id'];
                       $title=$row['title'];
                       $price=$row['price'];
                       $description=$row['description'];
                       $image_name=$row['image_name'];
                       ?>
                     <div class="food-menu-box">
                            <div class="food-menu-img">
                                <img src="<?php echo SITEURL; ?>/images/food/<?php echo $image_name;?>" alt="Chicke Hawain Pizza" style="height:100px; width:100px;" class="img-responsive img-curve">
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
            }
            

            ?>
            </div>


         
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->
<?php include 'partials_frontent/footer.php'; ?>
