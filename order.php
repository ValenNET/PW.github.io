 <!-- including partials-front/menu.php -->
 <?php include('partials-front/menu.php'); ?>


 <?php
//   check kondisi food id is set or not
 if(isset($_GET['food_id'])){
    //get the food id details of the selected food
    $food_id = $_GET['food_id'];
    
    // get the details of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    // count the rows
    $count = mysqli_num_rows($res);
    // check kondisi the data is available or not
    if($count>0)
    {
        // have the data
        $row = mysqli_fetch_assoc($res);
        
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    }
    else{
        // donot have the data
        header('location:'.SITEURL);
    }
 }
 else{
    //  redirect to homepage
    header('location:'.SITEURL);
 }
 ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Detail Pesanan</h2>

            <form action="" method ="POST" class="order">
                <fieldset>
                    <legend>Pesanan</legend>

                    <div class="food-menu-img">
                        <?php
                        //check kondisi the image is available or not
                        if($image_name=="")
                        {
                            //image is not available
                            echo "<div class='error'>image is not available </div>";
                        }
                        else
                        {
                            // image is availble
                            ?>

                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                            <?php
                        }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">Rp.<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Jumlah</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>

                    <div class="order-label">Nama Lengkap </div>
                    <input type="text" name="full-name" placeholder="nama lengkap" class="input-responsive" required>

                    <div class="order-label">Nomor Handphone</div>
                    <input type="number" name="contact" placeholder="089843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="@example.com" class="input-responsive" required>

                    <div class="order-label">Alamat</div>
                    <textarea name="address" rows="10" placeholder="jalan, Rumah" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Kirim" class="btn btn-primary">
                </fieldset>

            </form>

         <?php

         if(isset($_POST['submit'])) {
        //Get the all the data details from the form
        $food = $_POST['food'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $total =  $price * $qty;
        $order_date = date("Y-m-d h:i:sa");
        
        
        $status = "Ordered";
        $customer_name = $_POST['full-name'];
        $customer_contact = $_POST['contact'];
        $customer_email = $_POST['email'];
        $customer_address = $_POST['address'];
         

        //save the order in database
        //create sql to save the data
        $sql2 = "INSERT INTO tbl_order SET 
                 food = '$food',
                 price = $price,
                 qty = $qty,
                 total = $total,
                 order_date = '$order_date',
                 status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'

        ";


        //execute the query
        $res2 = mysqli_query($conn, $sql2);

        //check kondisi quqry is executed or not
        if($res2==true)
        {
            // Query is executed and order saved
            $_SESSION['order'] = "<div class='success text-center'> Pesanan berhasil ! </div>";
            header('location:'.SITEURL);

        }
        else{
            // failed to save order
            $_SESSION['order'] = "<div class='error text center'> Pesanan gagal silahkan coba lagi ! </div>";
            header('location:'.SITEURL);
        }

    }       
         ?>



        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    
 <!-- including partials-front/footer.php -->
 <?php include('partials-front/footer.php'); ?>