<?php include('partials/menu.php');
?>

<div class = "main-content">
    <div class ="wrapper" >
        <h1> Update Password</h1>
        <br><br>

        <?php 
     // 1.get the id of selected admin
    $id=$_GET['id'];  ?>

        <form action="" method="POST">
        <table class="tbl-30">
            <tr>
                <td>CURRENT PASSWORD :</td>
                <td><input type="password" name="current_password" placeholder = "Old Password" ></td>
            </tr>
            <tr>
                <td>NEW PASSWORD :</td>
                <td><input type="password" name="new_password" placeholder = "New Password" ></td>
            </tr>
            <tr>
                <td> CONFIRM PASSWORD :</td>
                <td><input type="password" name="confirm_password" placeholder = "Confirm Password" ></td>
            </tr>

            <tr>
                <td colspan="2">
                    
                <input type="hidden" name="id" value="<?php echo $id; ?>" class="btn-secondary">
                <input type="submit" name="submit" value="Change Password" class="btn-secondary">
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
    $current_password= md5($_POST['current_password']);
    $new_password= md5($_POST['new_password']);
    $confirm_password= md5($_POST['confirm_password']);

    //create sql query to update admin
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

    // execute the query 
    $res = mysqli_query($conn, $sql);
   
    // check kondisi query 
    if($res==true)
    {

        //Check kondisi data tersedia atau tidak 
        $count = mysqli_num_rows($res);
     
        if($count==1)
        {
        // echo "user found";
        // check kondisi apakah new pass dan confirm pass sama
         if($new_password==$confirm_password)
         {
        //  update pass
            // echo "password match";
            $sql2 = "UPDATE tbl_admin SET 
            password = '$new_password'
            WHERE id=$id
            ";
            //execute the query
            $res2 = mysqli_query($conn, $sql2);

            //check apakah berfungsi 
            if($res2==true)
            {
                // dislplay succes
                
             //user exist and redirect to admin page
    $_SESSION['change-pwd'] = "<div class='success'>password berhasil diganti</div>";
    // redirect 
    header('location:'.SITEURL.'admin/manage-admin.php');
      
            }
            else 
            {
                // display error
                //user dont exist and redirect to admin page
    $_SESSION['change-pwd'] = "<div class='error'>password gagal diganti</div>";
    // redirect 
    header('location:'.SITEURL.'admin/manage-admin.php');

            }
         } 
         else 
         {

             //user dont exist and redirect to admin page
    $_SESSION['pwd-not-match'] = "<div class='error'>password not match</div>";
    // redirect 
    header('location:'.SITEURL.'admin/manage-admin.php');
      
         }  
        }
           
        else 
        {
        
    //user dont exist and redirect to admin page
    $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
    // redirect 
    header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

}


?>


<?php include('partials/footer.php');
?>