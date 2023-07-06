<?php include('partials/menu.php')?>
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/style3.css">
 
 <!-- main contain section starts -->
    <div class = "main-content">
        <div class = "wrapper">
        <h1>Manage Admin</h1>

        <?php
        if(isset($_SESSION ['add']))
        {
            echo $_SESSION['add']; //display sesi message
            unset( $_SESSION['add']); //remove sesi message
        
        }
        if(isset($_SESSION ['delete']))
        {
            echo $_SESSION['delete']; //display sesi message
            unset( $_SESSION['delete']); //remove sesi message
        
        }
        if(isset($_SESSION ['update']))
        {
            echo $_SESSION['update']; //display sesi message
            unset( $_SESSION['update']); //remove sesi message
        
        }
        if(isset($_SESSION ['user-not-found']))
        {
            echo $_SESSION['user-not-found']; //display sesi message
            unset( $_SESSION['user-not-found']); //remove sesi message
        
        }
        if(isset($_SESSION ['pwd-not-match']))
        {
            echo $_SESSION['pwd-not-match']; //display sesi message
            unset( $_SESSION['pwd-not-match']); //remove sesi message
        
        }
        if(isset($_SESSION ['change-pwd']))
        {
            echo $_SESSION['change-pwd']; //display sesi message
            unset( $_SESSION['change-pwd']); //remove sesi message
        
        }


        ?>



        <!-- button to add admin -->

        <a href="add-admin.php" class = "btn-primary">Add Admin</a>
        <br/>
        <br/>

        <table class = "tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>

            <!--DISLAYING ADMIN DATA FROM DATABASE -->

            <?php
            //query to get all admin
            $sql = "SELECT * FROM tbl_admin";
            // execute the query 
            $res = mysqli_query($conn,$sql);
            // checked if the query is excuteed or not 
            if($res==TRUE) 
            {
                $count = mysqli_num_rows($res); //to get all data row database
                $sn=1; //create a var and assign the value

                

           
            if($count>0)
            {
                //database ada
                while($rows=mysqli_fetch_assoc($res))
                {
                    //menggunakan looping untuk mendapatkan all database 

                    // get individual data
                    $id=$rows['id'];
                    $full_name= $rows['full_name'];
                    $username= $rows['username'];

            
                    // display the values
                    ?>
            <tr>
                <td><?php echo $sn++; ?></td>
                <td><?php echo $full_name ?></td>
                <td><?php echo $username ?></td>
                <td>

                <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                   <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class = "btn-secondary"> update admin </a>
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class = "btn-danger"> delete admin </a>
                </td>
            </tr>
                    <?php 
                    

                }
            }
            else 
            {
                //data kosong
            }
        }
                    ?>



        


        
        </table>

        </div>
    </div>
        
<body></body>
<!-- main contents  end -->

<?php include('partials/footer.php')?>