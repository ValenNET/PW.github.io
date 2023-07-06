<?php include('partials/menu.php');?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <?php
        if(isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset ($_SESSION['add']);
        }
        if(isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }

        ?>
        <!-- Add category Form Start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table>
                <td>Title :</td>
                <td>
                <input type="text" name="title" placeholder="Category Title">
                </td>
 

                <tr>
                    <td>Select Image :</td>
                    <td><input type="file" name ="image"></td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                
                <tr>
                    <td>Active:</td>
                    <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td collspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>


            </table>
        </form>
        <!-- Add category Form End -->


        <?php
        if(isset($_POST['submit'])) {
            // echo "button clicked";
            //1.get the value from category form
           
            $title = $_POST['title'];

            //check for radio input the button is selected or not
            if(isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            }
            else 
            {
                // set default value
                $featured = "No";
            }
 
            if(isset($_POST['active'])) {
                $active = $_POST['active'];
            }
            else 
            {
                // set default value
                $active = "No";
            }

            //check kondisi apakah image is selected or not and set the value for image name
            // print_r($_FILES['image']);
            // die(); //break the code here

            if(isset($_FILES['image']['name'])) {
            //upload the image 
            // to upload image image we need image name,source path and destination path
             $image_name = $_FILES['image']['name'];
            

            // UPLOAD  THE IMAGE ONLY IF IMAGE IS SELECTED
            if($image_name != "") {
                 //AUTO RENAME OUR IMAGE
            // GET THE EKSTENSION OF OUR IMAGE (JPG,PNG,GIF,ETC) e.g "specialfood1.jpg"
            $ext = end(explode('.', $image_name));
            
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
                header('location:'.SITEURL.'admin/add-category.php');
                // stop process 
                die();
             }

            }

            }
            else 
            {
                //dont up image and set the image name as blank value
                $image_name =  "";
            }

            // 2.create the sql query to insert category to database
            $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            ";

            //3.execute the query for saving in database
            $res = mysqli_query($conn, $sql);

            // 4.check kondisi apakah query dapat dijalankan atau tidak
            if($res==true) {
                // query dijalanlkan dan category ditambah
                $_SESSION['add'] = "<div class = 'success'> Category berhasil ditambahkan </div>";
                // redirect to manage category
                header('location:'.SITEURL.'admin/manage-category.php');

            }
            else 
            {
                     // query erorr
                     $_SESSION['add'] = "<div class = 'error'> Category gagal ditambahkan </div>";
                     // redirect to manage category
                     header('location:'.SITEURL.'admin/add-category.php');
        
            }


        }
        
        ?>




    </div>
</div>

<?php include('partials/footer.php');?>
