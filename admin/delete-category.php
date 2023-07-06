<?php 
// include constants file
include('../config/constants.php');

//check kondisi the id and image name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
// get the value and delete
$id = $_GET['id'];
$image_name = $_GET['image_name'];

// remove the pshychal image file is available
if($image_name != "") {
    // IMAGE IS AVAILABLE so remove it
    $path = "../images/category/" .$image_name;
    // remove the image
    $remove = unlink($path);

    // if failed to remove then add an error message adn stop the process
    if($remove==false) 
    {
    // set the session message 
    $_SESSION['remove'] = "<div class ='error'> gagal menghapus category image</div>";
    // redirect to manage category page
    header('location:'.SITEURL.'admin/manage-category.php');
    // stop the procces
    die();
    }


}

// DELETE Data from database
// SQL Query to delete data from database
$sql = "DELETE FROM tbl_category WHERE id= $id";

// execute the query
$res = mysqli_query($conn, $sql);

// check kondisi data is delete from database or not
if($res == true) {
    // set success message and redirect
    $_SESSION['delete'] = "<div class = 'success'> category berhasil dihapus</div>";
    header('location:'.SITEURL.'admin/manage-category.php');

} else {
    //  set fail meesage and redirect
    $_SESSION['delete'] = "<div class = 'error'> category gagal dihapus</div>";
    header('location:'.SITEURL.'admin/manage-category.php');

}

// Redirect to manage category page with message

}
else
{
    // redirect tp manage category  page
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>