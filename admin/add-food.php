<?php
include('partials/menu.php');
?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">

<div class="main-content">
    <div class="wrapper">
        <h1> add food </h1>
    </div>

<br> <br> 

<!--show the messsage -->
<?php
if(isset($_SESSION['upload'])) 
{
    echo $_SESSION['upload'];
    unset ($_SESSION['upload']);
}

?>

<form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
        <tr>
            <td>Title :</td>
            <td> 
                <input type="text" name="title" placeholder ="title of the food">
            </td>
        </tr>

        <tr>
            <td> Description :</td>
            <td> 
                <textarea name="description"  cols="30" rows="5" placeholder="description of the food"></textarea>
            </td>
        </tr>

        <tr> 
            <td>Price :</td>
            <td>
                <input type="number" name="price">
            </td>
        </tr>

        <tr>
            <td>Select image :</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>

        <tr>
            <td>Category:</td>
            <td>
                <select name= "category" >
                <!-- CREATE PHP CODE TO DISPLAY CATEGORIES -->
                <?php
                // create php code to display categories from database
                // 1.crete sql to get all active categories from database
                $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                
                //Executing query 
                $res =  mysqli_query($conn, $sql);
                // count row to check kondisi if we have categories or not
                $count = mysqli_num_rows($res);

                //if count is greater than zero , we have cateogories else we dont have 
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details of categories
                        $id = $row['id'];
                        $title = $row['title'];

                        ?>

                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                        
                        <?php
                    }
                }
                else
                {
                    // we donot have categori
                    ?>
                    <option value="0">No categories Found</option>
                    <?php
                }
                // 2.Display on dropdown

                ?>

               
                </select>
            </td>
        </tr>

        <tr>
            <td>Featured :</td>
            <td>
                <input type="radio" name="featured" value="Yes"> Yes
                <input type="radio" name="featured" value="No"> No

            </td>
        </tr>
        <tr>
            <td>Active :</td>
            <td>
                <input type="radio" name="active" value="Yes"> Yes
                <input type="radio" name="active" value="No"> No

            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Food" class="btn-secondary">
            </td>
        </tr>


    </table>
</form>

<!-- check the kondisi the button is clicked or not -->
<?php
// check kondisi apakah button is clicked or not
if(isset($_POST['submit'])) 
{
// add the food in database
// echo "clicked";
 
//1.get the data from form
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$category = $_POST['category'];

//check kondisi radio button for featured and active and selected or not
if(isset($_POST['featured'])) {
    $featured = $_POST['featured'];
}
else 
{
    $featured = "No"; //setting the default value

}

if(isset($_POST['active'])) {

    $active = $_POST['active'];
}
else
{
    $active = "No" ; //setting default value
}
// 2.upload the image if selected
// check whether the select image is clicked or not and upload the image only if image is selected
if(isset($_FILES['image']['name'])) 
{

// get the details of selected images
$image_name = $_FILES['image']['name'];
//check kondisi the image is selected or not and upload image only if selected
if($image_name!= "") {
//image is selected
//A.rename the image
// get the extension of selected image (jpg, png, gif, etc)
$extArray = explode('.', $image_name);
$ext = end($extArray);

// create new name for image 
$image_name = "Food-name-".rand(0000,9999).".".$ext; //new image name be "Food-Name-123.jpg"

// B.Upload the image
// get the source path and destination
// source path is the current locations of the image
$src = $_FILES['image']['tmp_name'];
// destination  path for the image to be uploaded
$dst = "../images/food/". $image_name;

// finnally upload the food image
$upload = move_uploaded_file($src, $dst);

// check kondisi image is uploaded or not
if($upload==false) 
{
    //failed to upload the image
    // redirect to a add food page with error message
    $_SESSION['upload'] = " <div class='error'>gagal untuk upload image</div>";
    header('location:'.SITEURL.'admin/add-food.php');
    //stop the process
    die();
}

}

}

else 
{
 $image_name = ""; //setting default value as blank
}
// 3.insert into database
//create a SQL Querry to save or add food
//for numerical we do not need to passs value inside quotes '' but for string value it is compulsory to add quotes ''


$sql2 = "INSERT INTO tbl_food SET 
title = '$title',
description = '$description',
price = '$price',
image_name = '$image_name',
category_id = '$category',
featured = '$featured',
active = '$active'
";


// execute the query
$res2 = mysqli_query($conn, $sql2);
//kondisi kondisi data is inserted or not
// 4.redirect with message to manage food page
if($res2==true) 
{
    //data inserted succes
    $_SESSION['add'] = "<div class = 'success'> Food berhasil ditambahkan </div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
//data inserted failed
$_SESSION['add'] = "<div class = 'error'> Food gagal ditambahkan </div>";
header('location:'.SITEURL.'admin/manage-food.php');
}

 
}
?>


</div>


<?php
include('partials/footer.php');
?>