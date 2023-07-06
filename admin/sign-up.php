<?php include('../config/constants.php');?>
<html>
    <head>
    <title>Website Login and Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style1.css">
    
    </head>
    <body>
    <div class="box">
        <div class="innerbox">
<!-- signin start -->
 <div class="form" id="lgform">
                <h2>Silahkan daftar</h2>
                <br><br>
                
         <?php
        if(isset($_SESSION ['add']))
        {
            echo $_SESSION['add']; //display sesi message
            unset( $_SESSION['add']); //remove sesi message
        }
        ?>
                <form action="" method="POST">
                    <div class="inputBx">
                        <input type="text" name="full_name" required="required">
                        <span>Nama Lengkap</span>
                    </div>
                    <div class="inputBx">
                        <input type="text" name="username" required="required">
                        <span>Nickname</span>
                    </div>
                    
                    <div class="inputBx password">
                        <input type="password" id ="password-input" name="password" required="required">

                        <span>Password</span>
                        <!-- <a href="#" class="password-control" onclick="return show_hide_password(this); "> -->

                        </a>
                    </div>

                     <p>
                        <input type="checkbox" >
                        saya mengetujui untuk mematuhi
                        <a href="privacy-policy.html">privacy policy & terms</a>
                     </p>

                     <div class="inputBx">
                        <input type="submit" name="submit" value="SIGN UP" class="btn-primary">
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
//check kondisi the submit button is clicked or not
if(isset($_POST['submit']))
{
    // echo "button clicked";
    // proses untuk login
    // 1.get data from login form
    $full_name = $_POST['full_name'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $raw_password = md5($_POST['password']);
    // mysqli_real_escape_string is for if theres a special char like (';,[.]) so it can ignore it
    $password = mysqli_real_escape_string($conn, $raw_password);

    
    // 2.SQL apakah username dan password tersedia atau tidak
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";
    // 3.Execute the Query
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4.check the (query ise executed or not) data dimasukan dan ditampilkan
    if ($res ==TRUE) 
    {
        // echo 'berhasil memasukan data!'
        // create a session var to display the message
        $_SESSION['add'] = "<div class='success'>Daftar Berhasil</div>";
        // REDIRECT PAGE TO MANAGE ADMIN
        header("location:".SITEURL.'admin/login-page.php');
    }
    else 
    {
        // echo 'gagal memasukan data, coba lagi!'
             // create a session var to display the message
             $_SESSION['add'] = "<div class='error'>Daftar Gagal</div>";
             // REDIRECT PAGE TO MANAGE ADMIN
             header("location:".SITEURL.'admin/sign-up.php');
    }



}

?>