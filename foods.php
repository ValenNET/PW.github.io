 <!-- including partials-front/menu.php -->
 <?php include('partials-front/menu.php'); ?>
 <link rel="stylesheet" href="userstyle.css">

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        
            <?php 
            //display all the categories that are active
            //SQL query
            $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

            //execute the query
            $res2 = mysqli_query($conn, $sql2);
            // count rows
            $count2 = mysqli_num_rows($res2);

            //check kondisi if categories available or not
            if($count2>0)
            {
                //categories is available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //get the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                 
                    
                    ?>
                                
                <div class="food-menu-box">
                <div class="food-menu-img">

                     <!-- check if image is availble or not -->
                     <?php
                        if($image_name=="")
                        {
                            // image is not availble
                            echo "<div class = 'error'> images is not available</div>";
                        }
                        else
                        {
                            // image is available
                            ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
                            
                            <?php
                        }
                   ?>
                </div>


                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price">Rp.<?php echo $price; ?></p>
                    <p class="food-detail">
                       <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id; ?> " class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }
            }
            else
            {
                // categories is not available
                echo "<div class='error'> Food is not available </div>";
            }
            ?>
            

            
            

        
           




            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
 <!-- including partials-front/footer.php -->
 <?php include('partials-front/footer.php'); ?>