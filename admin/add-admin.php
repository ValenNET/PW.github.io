<?php include('partials/menu.php')?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/update.css">



<div class = "main-content">
    <div class = "wrapper">
        <h1>Add Admin</h1>

        <br/>

        <?php
        if(isset($_SESSION ['add']))
        {
            echo $_SESSION['add']; //display sesi message
            unset( $_SESSION['add']); //remove sesi message
        
        }
        ?>


        <form action="" method= "POST">
        <table class = "tbl-30">
            <tr>
                <td>
                     Full Name :
                </td>
                <td> 
                    <input type="text" name = "full_name" placeholder = "enter your name"></td>
                </td>
                <tr>
                <td>
                     User name:
                </td>
                <td> 
                    <input type="text" name = "username" placeholder = "enter your username"></td>
                </td>
                </tr>
                <tr>
                <td>
                     password  :
                </td>
                <td> 
                    <input type="text" name = "password" placeholder = "enter your password"></td>
                </td>
                </tr>
                

                <tr>
                    <td colspan="2">
                        <input type="submit" name ="submit" value="Add Admin" class= "btn-secondary">

                    </td>
                </tr>

                </tr>
        </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php')?>


<?php
// PROCESS THE VALUE FROM FROM DAN SAVE IT IN DATABASE

// CHECK IF THE BUTTON DIKLIK ATAU TIDAK
if(isset($_POST['submit'])) 
{
    // button diklik 
    // echo "button clicked"

    //1. get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    // $password = md5($_POST['password']); //password encriksi dgn md5

    $raw_password = md5($_POST['password']);
    // mysqli_real_escape_string is for if theres a special char like (';,[.]) so it can ignore it
    $password = mysqli_real_escape_string($conn, $raw_password);

    //2.SQL SUERY TO SAVE THE DATA INTO DATABASE
    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
    ";


    //3.exceting query and saving data info to database
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4.check the (query ise executed or not) data dimasukan dan ditampilkan
    if ( $res ==TRUE) 
    {
        // echo 'berhasil memasukan data!'
        // create a session var to display the message
        $_SESSION['add'] = "ADMIN BERHASIL DITAMBAHKAN";
        // REDIRECT PAGE TO MANAGE ADMIN
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else 
    {
        // echo 'gagal memasukan data, coba lagi!'
             // create a session var to display the message
             $_SESSION['add'] = "ADMIN GAGAL DITAMBAHKAN";
             // REDIRECT PAGE TO MANAGE ADMIN
             header("location:".SITEURL.'admin/add-admin.php');
    }



}


?> 