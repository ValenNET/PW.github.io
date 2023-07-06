<?php include('partials/menu.php');?>
<link rel="stylesheet" href="../css/update.css">

<div class="main-content">
    <div class="wrapper">
        <h1 style="font-size: 32px; color: #333;"> UPDATE ORDER </h1>

        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            //get the order details
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                // get the details
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];
           

                 

            }
            else
            {
                //detail is not available
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        }   
        else
        {
            //redirect to manage order
            header('location:'.SITEURL.'admin/manage-order.php');
        }
        ?>

        <!-- FORM START HERE -->
         <form action="" method="POST">

         <table class="tbl-30">
            <tr>
                <td>Food Name</td>
                <td>
                <?php echo $food; ?>
                </td>
            </tr>

            

            <tr>
                <td> Price </td>
                <td>
                <?php echo $price; ?>
                </td>
            </tr>
            <tr>
                <td>Qty</td>
                <td>
                    <input type="number" name="qty" value="<?php echo $qty; ?>">
                </td>
            </tr>

            <tr>
                <td>Status</td>
                <td>
                    <select name="status" >
                        <option <?php if($status=="Ordered"){echo "selected"; }?> value="Ordered">Ordered</option>
                        <option <?php if($status=="On Delivery"){echo "selected"; }?> value="On Delivery">On Delivery</option>
                        <option <?php if($status=="Delivered"){echo "selected"; }?> value="Delivered">Delivered</option>
                        <option <?php if($status=="Cancelled"){echo "selected"; }?> value="Cancelled">Cancelled</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td>customer name</td>
                <td>
                    <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                </td>
            </tr>
            <tr>
                <td>customer contact</td>
                <td>
                    <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                </td>
            </tr>
            <tr>
                <td>customer Email</td>
                <td>
                    <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                </td>
            </tr>

            <tr> 
                <td>customer address</td>
                <td>
                    <textarea name="customer_address"  cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                </td>
            </tr>
            <tr>
                <td collspan ="2">
                    <input type="hidden" name ="id" value="<?php echo $id; ?>">
                    <input type="hidden" name ="price" value="<?php echo $price; ?>">

                    <input type="submit" name="submit" value="Update Order" class ="btn-secondary">
                </td>
            </tr>
         </table>
         </form>
        <!-- FORM END HERE -->

    <?php
    if(isset($_POST['submit'])) {
    // get all data 
    $id = $_POST['id'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;

    $status = $_POST['status'];
    $customer_name = $_POST['customer_name'];
    $customer_email = $_POST['customer_email'];
    $customer_contact = $_POST['customer_contact'];
    $customer_address = $_POST['customer_address'];
    
    //update the values
    $sql2 = "UPDATE tbl_order SET 
    qty = $qty,
    total = $total,
    status = '$status',
    customer_name = '$customer_name',
    customer_contact = '$customer_contact',
    customer_email = '$customer_email',
    customer_address = '$customer_address'
    WHERE id=$id
    ";

    $res2 = mysqli_query($conn, $sql2);
    if($res2==true){
        $_SESSION['update'] = "<div class='success'>Update Order berhasil </div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
    else
    {
        $_SESSION['update'] = "<div class='error'>Update Order gagal </div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }


    }

    ?>

    </div>
</div>
<?php include('partials/footer.php');?>