
<?php include('partials/menu.php');?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">


<div class="main-content">
    <div class="wrapper">
    <h1 style="font-size: 32px; color: #333;"> UPDATE CATEGORY</h1>
    <br><br> 

    <?php
    //  check kondisi the id is set or not
     if(isset($_GET['id'])) 
     {
        //get the id and all other details
        $id = $_GET['id'];
        // create sql query to get all data
        $sql = "SELECT * FROM tbl_category WHERE id= $id";
        // execute the query
        $res = mysqli_query($conn, $sql);

        // count the rows to check kondisi the id is valid or not
        $count = mysqli_num_rows($res);

        if($count==1) 
        {
            //get all the data
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        }
        else
        {
            // redirect to manage category
            $_SESSION['no-category-found'] = "<div class = 'error'> category not found </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
     }
     else
     {
        // redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
     }
    ?>

    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-30">
    <tr>
        <td> Title :</td>
        <td>
            <input type="text" name="title" value="<?php echo $title; ?>">

        </td>
    </tr>

    <tr>
        <td> Current Image :</td>
        <td> 
            <!-- image will display here -->
            <?php
            if($current_image != "") 
            {
                // DISPLAY THE IMAGE
                ?>
                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" >
                <?php
            }
            else
            {
                // DISPLAY THE MESSAGE
                echo "<div class='error'> image not added </div>";

            }
            ?>
        </td>
    </tr>

    <tr>
        <td> New image :</td>
        <td>
            <input type="file" name="image">

        </td>
    </tr>

    <tr>
        <td> Featured :</td>
        <td> 
            <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
        </td>
    </tr>

    <tr>
        <td> Active : </td>
        <td> 
            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
        </td>
    </tr>

    <tr>
        <td>

            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-secondary">

        </td>
    </tr>

    </table>
    </form>
    
    <?php 
     if(isset($_POST['submit'])) {
        
        echo "clicked";
        // 1.get all the values from form
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        // 2. updating new image if selected
        //check kondisi the image is selected or not
        if(isset($_FILES['image']['name'])) 
        {
            //GET THE IMAGE DETAILS
            $image_name = $_FILES['image']['name'];

            //check kondisi the image is available or not
            if($image_name != "") 
            {
                //A. upload the new image
                 //AUTO RENAME OUR IMAGE
                 $ext_array = explode('.', $image_name);
                 $ext = end($ext_array); //get the extension of the image
                 
            
            // RENAME THE IMAGE 
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g Food_Category_111.jpg


            // MENGATUR SOURCE PATH DAN DESTINATION PATH 
             $source_path = $_FILES['image']['tmp_name'];
             $destination_path = "../images/category/".$image_name;

            //  finnaly upload the image
             $upload = move_uploaded_file($source_path, $destination_path);

            //  check kondisi apakah image teupload atau tidak dan jika tidak maka up akan berhenti dan redirect dengan pesan error
             if($upload==false) {
                // set message
                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                // redirect to add category
                header('location:'.SITEURL.'admin/manage-category.php');
                // stop process 
                die();
             }
                
                //B.remove the current images
                if($current_image != "") 
                {
                    $remove_path = "../images/category/" . $current_image;

                    $remove = unlink($remove_path);
   
                   //check kondisi the image is removed  or not
                   //if failed to remove then display message and stop the proccess
                   if($remove==false) 
                   {
                       //failed to remove the image
                       $_SESSION['failed-remove'] = "<div class ='error'> failed to remove current image </div>";
                       header('location:'.SITEURL.'admin/manage-category.php');
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

        
        // 3. update the database
        $sql2 = "UPDATE tbl_category SET 
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
        ";

        // execute the query
        $res2 = mysqli_query($conn, $sql2);


        // 4. redirect to manage category with message
        // check kondisi executed or not
        if($res2 == true) 
        {
        // category updated
         $_SESSION['update'] = "<div class='success'> category update berhasil </div>";
         header('location:'.SITEURL.'admin/manage-category.php');
        }
        else 
        {
            // category gagal updated
         $_SESSION['update'] = "<div class='error'> category update gagal </div>";
         header('location:'.SITEURL.'admin/manage-category.php');
        }
        
    }


    ?>
        
        
        </div>
    </div>
    
    <?php include('partials/footer.php');?>