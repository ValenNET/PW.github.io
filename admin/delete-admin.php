<?php 
//include constants.php file
include('../config/constants.php');

// 1.get the id of a admin to deleted
$id = $_GET['id'];

//2. create sql query to delete admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";
//3. redirect to manage admin page wtih message (succes/error)
$res =mysqli_query($conn,$sql);

//check the query 
if($res==TRUE)
{
    // berhasil
    // echo "admin dihapus";
    // create session to manage admin
    $_SESSION['delete'] = "<div class='success'> admin berhasil dihapus. </div>";
    // redirect to manage admin page
    header ('location: '.SITEURL.'admin/manage-admin.php');


}
else 
{
    // echo "gagal menghapus admin";
    $_SESSION['delete'] = "<div class='error'>admin gagal dihapus silahkan coba lagi. </div>";
    // redirect to manage admin page
    header ('location: '.SITEURL.'admin/manage-admin.php');


}


?>