 <!-- including partials-front/menu.php -->
 <?php include('partials-front/menu.php'); ?>
<link rel="stylesheet" href="userstyle.css">

<!-- check kondisi id is passed or not -->
<?php
if(isset($_GET['category_id']))
{
    // category is passed
     $category_id = $_GET['category_id'];
    // get the category title based on category ID
    $sql = "SELECT * FROM tbl_category WHERE id=$category_id";
    // execute the query
    $res = mysqli_query($conn, $sql);
    // get the value from  database
    $row = mysqli_fetch_assoc($res);
    // get the title 
    $category_title = $row['title'];


}
else
{
    // category not passed and redirect to homepage
    header('location:'.SITEURL);
}
?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        //  create sql query to get food based on selected category 
        $sql2 = "SELECT * FROM tbl_food WHERE category_id= $category_id";
        //execute the qurry
         $res2 = mysqli_query($conn, $sql2);
        // count the rows
        $count2 = mysqli_num_rows($res2);

        // check the kondisi food is availabe or not
        if($count2>0)
        {
            // food is available
            while($row2=mysqli_fetch_assoc($res2))
            {
               $id = $row2['id'];
               $title = $row2['title'];
               $price = $row2['price'];
               $description = $row2['description'];
               $image_name = $row2['image_name'];

               ?>
                      <div class="food-menu-box">
                <div class="food-menu-img">

                <!--check the image is available or not -->
                <?php
                if($image_name=="")
                {
                    // image is not available
                    echo "<div class='error'>image is not found </div>";
                }
                else
                {
                    // image is available
                    ?>

                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" >
                    
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

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

               <?php
            }
        }
        else
        {
                // fodd is not available
                echo "<div class='error'> Food not available </div>"; 
        }
        
        ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
 <!-- including partials-front/footer.php -->
 <?php include('partials-front/footer.php'); ?>