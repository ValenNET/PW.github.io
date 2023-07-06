
<?php include('partials/menu.php');?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">
<div class = "main-content">
    <div class ="wrapper" >
        <h1 style="font-size: 32px; color: #333;"> UPDATE ADMIN </h1>
        <br><br>

        <?php 
     // 1.get the id of selected admin
    $id=$_GET['id']; 
    //  2.create sql query to get detail
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    // execute the query
    $res=mysqli_query($conn, $sql);
    // check kondisi 
    if($res==TRUE)
    {
        $count =mysqli_num_rows($res);
        // check apakah ada admin data
        if($count==1)
        {
            // get details
            // echo "admin tersedia";
            $row=mysqli_fetch_assoc($res);
            $full_name = $row['full_name'];
            $username = $row['username'];
        }
        else 
        {
            echo "admin tidak tersedia";
            // redirect to admin page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
        ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>FULL NAME :</td>
                <td><input type="text" name="full_name" value="<?php echo $full_name; ?>"></td>
            </tr>
            <tr>
                <td>USER NAME :</td>
                <td><input type="text" name="username" value="<?php echo $username; ?>"></td>
            </tr>
            


            <tr>
                <td colspan="2">
                    
                <input type="hidden" name="id" value="<?php echo $id; ?>" class="btn-secondary">
                <input type="submit" name="submit" value="Update admin" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
    </div>
</div>

<?php
//check kondisi submit button
if(isset($_POST['submit']))
{
    //get all values from from to update
    $id= $_POST['id'];
    $full_name= $_POST['full_name'];
    $username= $_POST['username'];

    //create sql query to update admin
    $sql = "UPDATE tbl_admin SET 
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id';
    ";
    // execute the query 
    $res = mysqli_query($conn, $sql);
   
    // check kondisi query 
    if($res==true)
    {
        $_SESSION['update'] = "<div class='success'> Admin Berhasil diUpdate </div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else 
    {
        $_SESSION['update'] = "<div class='error'> Admin gagal diUpdate </div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }

}


?>


<?php include('partials/footer.php');
?>