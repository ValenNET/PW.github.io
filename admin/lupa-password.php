<?php include('../config/constants.php');?>

<html>
    
<head>
    <title>Lupa Password</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style1.css">

</head>
<body>
 

<!-- signin start -->
<div class="box">
    <div class="innerbox">
<div class="form" id="lgform">
             <!-- <div class="header">
                <img src="../image/header.png" alt="bg">
                </div> -->

                <h2>Lupa Password?</h2>
                <br><br>
                <?php
                    if(isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                ?>

                
                <form action="" method="POST">
                    <div class="inputBx">
                        <input type="text" name="full_name" required="required">
                        <span>Nama Lengkap</span>
                    </div>
                    
                    <div class="inputBx password">
                        <input type="password" id ="password-input" name="password_dulu" required="required">

                        <span>Password dulu</span>
               
                    </div>
                    <div class="inputBx password">
                        <input type="password" id ="password-input" name="password_baru" required="required">

                        <span>Password baru</span>
              
                    </div>

                     <p>
                        <input type="checkbox" >
                        saya mengetujui untuk mematuhi <a href="privacy-policy.php">privacy policy & terms</a>
                     </p>

                     <div class="inputBx">
                        <input type="hidden" name="username" value="<?php echo $username; ?>" class="btn-secondary">
                        <input type="submit" name="submit" value="GANTI" class="btn-secondary" >
                     </div>

                </form>

                <p class="p1">kamu sudah memiliki akun <a href="login-page.php" id="login">ingin login?</a></p>
                
                <!-- <div class="or">
                    <span>or</span>
                </div>

                <div class="social-img">
                    <img src="image/insta.png"/>
                    <img src="image/wa.png"/>
                    <img src="image/fb.png"/>
                </div> -->

            </div>
            <!-- signin end -->

            </div>
</div>
               
</body>
</html>





<?php
//check kondisi submit button
if(isset($_POST['submit']))
{
    //get all values from from to update
    $full_name= $_POST['full_name'];
    $password_lama= md5($_POST['password_dulu']);
    $password_baru= md5($_POST['password_baru']);



    //create sql query to update admin
    $sql = "UPDATE tbl_admin SET 
    password = '$password_baru'
    WHERE full_name = '$full_name'
    ";
    // execute the query 
    $res = mysqli_query($conn, $sql);
   
    // check kondisi query 
    if($res==true AND $password_baru != $password_lama)
    {  
        $_SESSION['update'] = "<div class='success'> Password berhasil diganti! </div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/login-page.php');
    }
    else 
    {
        $_SESSION['update'] = "<div class='error'>Password gagal diganti! </div>";
        // redirect to admin page
        header('location:'.SITEURL.'admin/lupa-password.php');
    }

}


?>