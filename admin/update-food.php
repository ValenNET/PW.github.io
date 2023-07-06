<?php include('partials/menu.php'); ?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">

 <?php
 if(isset($_GET['id']))
 {
    // GET ALL DETAILS
    $id = $_GET['id'];
    // SQL Query to get the selected food
    $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
    // execute the Query
    $res2 = mysqli_query($conn, $sql2);
    //get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);

    // Get the individual values of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
 }
 else 
 {
    // redirect to manage food
    header('location:'.SITEURL.'admin/manage-food.php');
 }
 ?>



<div class="main-content">
    <div class="wrapper">
    <h1 style="font-size: 32px; color: #333;">UPDATE FOOD</h1>
        <br> <br>

        <!-- FORM START HERE -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr> 
                    <td> Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current  image:</td>
                    <td>

                    <?php
                    if($current_image=="")
                    {
                    // image is not available
                    echo "<div class='error'> Image not available </div>";
                    }
                    else
                    {

                        //image is available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">

                        <?php

                    }
                    ?>
                        <!-- display image if available -->
                         
                </td>
                </tr>
                <tr>
                    <td>Select new image :</td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                        
                        <?php

                        //query to get active categories
                        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                        // execute the query
                        $res = mysqli_query($conn, $sql);
                        //count rows
                        $count = mysqli_num_rows($res);
                        
                        //check kondisi category available or not
                        if($count>0)
                        {
                            // category is availabe
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $category_title = $row['title'];
                                $category_id = $row['id'];

                                // echo "<option value='$category_id'>$category_title</option>";
                               ?>

                                <option <?php if($current_category==$category_id){echo "selected"; }?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                               
                               <?php
                                
                            }
                        }
                        else 
                        {
                            // category is not available
                            echo "<option value='0'>Category Not available </option>";
                        }
                        
                        ?>

                 
                        </select>
                    </td>
                </tr>

                <tr> 
                    <td>Featured :</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo"checked";} ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured=="No") {echo"checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active :</td>
                    <td>
                    <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes" > Yes                  
                    <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No" > No    
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>


        <!-- FORM END HERE -->

        <?php  
        if(isset($_POST['submit']))
                    {
                        // echo "button clicked";
                        //1. get all the details from the form
                        $id = $_POST['id'];
                        $title = $_POST['title'];
                        $description = $_POST['description'];
                        $price = $_POST['price'];
                        $current_image = $_POST['current_image'];
                        $category = $_POST['category'];

                        $featured = $_POST['featured'];
                        $active = $_POST['active'];


                        // 2.upload the image if selected
                        // check kondisi upload button is clicked or not
                        if(isset($_FILES['image']['name']))
                        {
                            // upload button is clicked
                            $image_name = $_FILES['image']['name']; // new image name

                            //check kondisi file image is availabel or not
                            if($image_name!= "")
                            {
                                // image is available
                                // rename the image
                                $ext_array = explode('.', $image_name);
                                $ext = end($ext_array); //get the extension of the image
                                
                                $image_name = "Food-name-".rand(0000,9999).'.'.$ext; //this will be renamed image

                                //get the source path and destination path
                                $src_path = $_FILES['image']['tmp_name']; //source path
                                $dest_path = "../images/food/".$image_name; //destination path

                                // upload the image
                                $upload = move_uploaded_file($src_path, $dest_path);

                                //check kondisi the image is uploaded or not
                                if($upload==false) 
                                {
                                    //failed to upload
                                    $_SESSION['upload'] = "<div class='error'> gagal untuk mengupload image baru</div>";
                                    // redirect to manage food
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    // stop the process
                                    die();
                                }

                                // 3.remove the image if new image is uploaded and current image exist
                                // B.remove current image if availabel
                                if($current_image!="")
                                {
                                    // current image is availlabe
                                    // redirect to manage food.php
                                 $remove_path = "../images/food/" . $current_image;
                                 
                                 if(file_exists($remove_path)) 
                                 {
                                 $remove = unlink($remove_path);

                                // check kondisi imagee is removed or not
                                if($remove==false)
                                {
                                    //failed to remove current image 
                                    $_SESSION['remove-failed'] = "<div class='error'>failed to remove current image</div>";
                                    //redirect to manage food
                                    header('location:'.SITEURL.'admin/manage-food.php');
                                    //stop the procees
                                    die();
                                     }
                                }
                            }
                            else 
                            {
                                $image_name = $current_image;
                            }

                        
                            }
                        
                        else 
                        {
                            $image_name = $current_image;
                        }
                    

                        }

                        // 4. update the food database
                        $sql3 = " UPDATE tbl_food SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id ";

                        // execute the sql Query
                        $res3 = mysqli_query($conn, $sql3);

                        // check kondisi query is executed or not
                        if($res3==true)
                        {
                            // query executed
                            $_SESSION['update'] = "<div class='success'> Food berhasil diupdate </div>";
                            // redirect to manage food
                            header('location:'.SITEURL.'admin');
                        }
                        else
                        {
                            // query  not executed
                        // redirect to manage food with session message
                            $_SESSION['update'] = "<div class='error'> Food gagal diupdate</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                        }


                    }
                
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>