
<?php

// authorization - acces control 
// chechk kondisi user is logged or not
if(!isset($_SESSION['user'])) {
    // user isnt logged in
    // redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error'>tolong login terlebih dahulu </div>";
    // redirect to login page
    header('location:'.SITEURL.'admin/login-page.php');
    
}
?>