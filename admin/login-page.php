<?php include('../config/constants.php');?>

<html>
<head>
    <title>Website Login and Register</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/style1.css">
    
</head>
<body>


<br><br>
    <div class="box">
        <div class="innerbox">

            <!-- login start  -->
            
            <!--show message success or not from sign up and lupa password  -->
            <!-- form sign up -->
            <div class="form" id="lgform">
                <?php
                    if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset ($_SESSION['add']);
                }
                ?>
        
            <!-- form login -->
                <?php
                    if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                ?>
                
                <?php

                if(isset($_SESSION['no-login-message'])) 
                {
                    echo $_SESSION['no-login-message'];
                    unset ($_SESSION['no-login-message']);
                }
                
                ?>

            <!-- form lupa password -->
                <?php
                    if(isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset ($_SESSION['update']);
                }
                ?>

                
        

                <h2>Selamat datang di RM.Mba Yanti</h2>
                <!-- <p class="danger">Tolong Login terlebih dahulu</p> -->
                <br>
                <br>
                <form action="" method="POST">
                    <div class="inputBx">
                        <input type="text" name ="full_name" required="required">
                        <span>Nama</span>
                    </div>
                    
                    <div class="inputBx password">
                    <input type="password" name="password" id ="password-input" required="required" >
                        <span>Password</span>

                    </div>

                     <p>
                        <input type="checkbox" >
                        Ingat Saya 

                        <a href="lupa-password.php" style="float:right;">Lupa password?</a>
                     </p>

                     <div class="inputBx">
                     <input type="submit" name="submit" value="LOGIN" class="btn-primary">

                     </div>

                </form>

                

                <p class="p1">Baru Mendaftar? <a href="sign-up.php" id="signup">Buat akun baru !</a></p>
                
                <!-- <div class="or">
                    <span>or</span>
                </div> -->

                <!-- <div class="social-img">
                    <img src="image/insta.png"/>
                    <img src="image/wa.png"/>
                    <img src="image/fb.png"/>
                </div> -->

            </div>

            <!-- login ENd  -->

 
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
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);

    $raw_password = md5($_POST['password']);
    // mysqli_real_escape_string is for if theres a special char like (';,[.]) so it can ignore it
    $password = mysqli_real_escape_string($conn, $raw_password);

    
    // 2.SQL apakah username dan password tersedia atau tidak
    $sql = "SELECT * FROM tbl_admin WHERE full_name='$full_name' AND password='$password'";

    // 3.Execute the Query
    $res = mysqli_query($conn, $sql);
    // 4.count rows to check kondisi user ada
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user tersedia dan login success
        $_SESSION['login'] = "<div class='success'>Login Berhasil</div>";
        $_SESSION['user'] = $full_name; //check kondisi apakah user logout atau tidak
        // redirect to homepage/Dashboard
        header('location:'.SITEURL.'admin/');
    }
    else 
    {
           //user tidak tersedia dan login error
           $_SESSION['login'] = "<div class='error text-center'>Login gagal password atau nama salah </div>";
           // redirect to homepage/Dashboard
           header('location:'.SITEURL.'admin/login-page.php');
    }


}

?>

