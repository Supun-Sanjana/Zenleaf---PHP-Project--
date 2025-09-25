<?php
session_start();
include("../lib/database.php");

// Check if product ID and quantity are sent
if (isset($_POST['product_id'], $_POST['qty'])) {
    $product_id = intval($_POST['product_id']);
    $qty = intval($_POST['qty']);

    // Fetch product details from DB
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $product_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($product = mysqli_fetch_assoc($result)) {
        // Create cart array if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // If product already in cart, update quantity
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['qty'] += $qty;
        } else {
            // Add new product to cart
            $_SESSION['cart'][$product_id] = [
                'name' => $product['product_name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'qty' => $qty
            ];
        }

        $_SESSION['success'] = "{$product['product_name']} added to cart!";
        header("Location: ../../public/shop.php");
        exit;
    } else {
        $_SESSION['error'] = "Product not found!";
        header("Location: products.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid request!";
    header("Location: ../../public/shop.php");
    exit;
}
