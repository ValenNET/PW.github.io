<?php
include('../config/constants.php');

// Check whether the order ID is set or not
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query to delete the order from the database
    $sql = "DELETE FROM tbl_order WHERE id = $id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query was successful or not
    if ($res) {
        // Order deleted successfully
        $_SESSION['delete'] = "<div class='success'>Order deleted successfully.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    } else {
        // Failed to delete the order
        $_SESSION['delete'] = "<div class='error'>Failed to delete the order. Please try again later.</div>";
        header('location:'.SITEURL.'admin/manage-order.php');
    }
} else {
    // Redirect to manage-order.php if the order ID is not provided
    header('location:'.SITEURL.'admin/manage-order.php');
}
?>
