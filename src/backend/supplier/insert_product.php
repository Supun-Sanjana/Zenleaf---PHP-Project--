<?php
include("../../lib/database.php");
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // logged-in user
} else {
    // redirect or show error if not logged in
    die("User not logged in");
}

if (isset($_POST['submit'])) {
    $product_name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    if (!empty($_POST['category'])) {
        $categories = $_POST['category']; // this will be an array
        // Convert to comma-separated string
        $category_str = implode(',', $categories);


    }

    /** IMAGE UPLOAD **/
    $imageToSave = ''; // fallback just in case
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $targetDir = "../../../public/uploads/products/";
        $targetFile = $targetDir . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $imageToSave = $imageName; // uploaded file
        }
    }

    // Product ID generator
    function generateProductId($con)
    {
        do {
            // P + 5 random digits (e.g., P12345)
            $product_id = 'P' . rand(10000, 99999);

            // check if already exists
            $check = mysqli_query($con, "SELECT product_id FROM products WHERE product_id='$product_id'");
        } while (mysqli_num_rows($check) > 0);

        return $product_id;
    }

    $product_id = generateProductId($con);

    // Example: save to DB
    $sql = "INSERT INTO products (product_id ,user_id, product_name, categories,discription, price,image, qty ) 
            VALUES ('$product_id','$user_id', '$product_name', '$category_str','$description', '$price','$imageToSave', '$quantity')";
    mysqli_query($con, $sql);

    header("Location: ../../templates/supplier/index.php?msg=added");

}
?>