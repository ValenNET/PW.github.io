<?php
// include constants.php for siteurl
include('../config/constants.php');
//1.Session destroy 
session_destroy();
// 2.redirect to homepage login
header('location:'.SITEURL.'admin/login-page.php');
?>