 <!-- including partials-front/menu.php -->
 <?php include('partials-front/menu.php'); ?>
 <link rel="stylesheet" href="userstyle.css">
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
         //get the search keyword
        //  $search = $_POST['search'];
        $search = mysqli_real_escape_string($conn, $_POST['search']);
        

        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-dark">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
           
            // SQL Query to Get foods based on search  keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
            // Execute the Query
            $res = mysqli_query($conn, $sql);

            // count rows
            $count = mysqli_num_rows($res);

            if($count>0) 
            {

            // check kondisi food is available or not
            while($row=mysqli_fetch_assoc($res)) {
                // get the details
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

<div class="food-menu-box">
                <div class="food-menu-img">
                
                <!-- check if image is available or not -->
                <?php
                if($image_name=="")
                {
                    // image not available
                    echo "<div class='error'>image is not found </div>";
                }
                else
                {
                    // image is available
                    ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
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
        }
        
            else
            {
                // =food not avalaible
                echo "<div class='error'>Food not Found </div>";
            }

            ?>
            



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
 <!-- including partials-front/footer.php -->
 <?php include('partials-front/footer.php'); ?>