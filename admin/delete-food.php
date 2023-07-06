<?php
// echo "delete food page";
 include('../config/constants.php');

//  check kondisi 
if(isset($_GET['id']) AND isset($_GET['image_name'])) 
{
    // process to delete
    // echo "proses to delete";

    // 1.get id and image here
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // 2.remove the image if available
    // check the image if image is available or not and delete only if available
    if($image_name != "") 
    {
        // it has image and has to remove from folder
        // get the image path
        $path = "../images/food/".$image_name;

        // remove image file from older
        $remove = unlink($path);

        // check kondisi the image is removed or not
        if($remove==false) 
        {
            // failed to remove the image
             $_SESSION['upload'] = "<div class = 'error'> gagal menghapus image</div>";

            // redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
            // stop the process
            die();
        }
    }

    // 3.delete food from database
     $sql = "DELETE FROM tbl_food WHERE id= $id";
    //  execute the query
    $res = mysqli_query($conn, $sql);
    
    //check kondisi the query is executed or not
     // 4. redirect to manage food with session manage
     if($res==true) 
     {
        // food deleted
        $_SESSION['delete'] = "<div class='success'>food berhasil dihapus</div>";
        header('location:'.SITEURL.'admin/manage-food.php');

     }
     else
     {
        // failed to delete food
        // feed deleted
        $_SESSION['delete'] = "<div class='error'> food gagal dihapus</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
     }

   

}
else
{
    // redirect to manage food page
    $_SESSION['unaothorize'] = "<div class='error'>akses tidak bisa digunakan</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}

?>