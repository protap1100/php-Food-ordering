<?php include 'partials_frontent/header.php'; ?>


    <?php 
    if (isset($_GET['food_id'])) {
        $food_id=$_GET['food_id'];


        $sql="SELECT * FROM tbl_food WHERE id=$food_id";

        $res= mysqli_query($con,$sql);

        $count=mysqli_num_rows($res);

        if($count==1){

                $row=mysqli_fetch_assoc($res);
                $title=$row['title'];
                $price=$row['price'];
                $image_name=$row['image_name'];
        }else{
            echo "data not availabe";
           
          }
      }else{
        echo "null";
        }

     ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form method="POST" action="" class="order">
                <fieldset>
                    <legend>Selected Food</legend>
                    
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
                                    <h3><?php echo $title; ?></h3>
                                    <input type="hidden" name="food" value=" <?php echo $title; ?>">
                                    <p class="food-price"><?php $tk="Taka"; $pricee=$price.$tk; echo $pricee ; ?></p>
                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                    <div class="order-label">Quantity</div>
                                    <input type="number" name="qty" class="input-responsive" value="1" required>
                                   <span class="price">Total Price:</span>
                                </div>
                </fieldset>
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Protap Biswas" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 01957290874" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. protapb23@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>
            <?php 
            if (isset($_POST['submit'])) {
                      $food=$_POST['food'];
                      $price=$_POST['price'];
                      $qty=$_POST['qty'];
                      $total = $price*$qty;
                      $order_date = date('Y-m-d H:i:s');

                      $status="ordered";

                      $customer_name=$_POST['full-name'];

                      $customer_contact =$_POST['contact'];

                      $customer_email =$_POST['email'];

                      $customer_address =$_POST['address'];

                      $sql2 ="INSERT INTO dbll_order SET
                      food='$food',
                      price=$price,
                      qty='$qty',
                      total='$total',
                      order_date='order_date',
                      status='$status',
                      customer_name='$customer_name',
                      customer_contact='$customer_contact',
                      customer_email='$customer_email',
                      customer_address ='$customer_address'";

                      $res3=mysqli_query($con,$sql2);
                      echo $res3;
                      if ($res3==TRUE) {
                          $_SESSION['order'] = "<div class='success text-center' >Food Ordered Successfully</div>";
                          header('location:'.SITEURL);
                      }else{
                          $_SESSION['order'] = "<div class='error text-center' >Failed to Order food</div>";
                          header('location:'.SITEURL);
                      }

            }

             ?>

        </div>
    </section>
    <!-- food search Section Ends Here -->

<?php include 'partials_frontent/footer.php'; ?>
 