<?php
include("../../lib/database.php");
session_start();

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login first.");
}

// Get product ID from URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Optional: check if this product belongs to the logged-in user
    $user_id = $_SESSION['user_id'];
    $check = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id' AND user_id='$user_id'");
    if (mysqli_num_rows($check) > 0) {
        $delete = mysqli_query($con, "DELETE FROM products WHERE product_id='$product_id'");
        if ($delete) {
            header("Location: ../../templates/supplier/index.php?msg=deleted"); // redirect back to products list
            exit;
        } else {
            echo "Error deleting product: " . mysqli_error($con);
        }
    } else {
        die("Product not found or you don't have permission.");
    }
} else {
    die("Product ID not specified.");
}
?>
