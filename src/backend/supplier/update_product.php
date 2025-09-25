<?php
include("../../lib/database.php");
session_start();

include("../../lib/admin_auth.php");

// This will check if admin is logged in, otherwise redirect
checkAdmin();

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please login first.");
}

// Get product ID from URL
if (!isset($_GET['id'])) {
    die("Product ID not specified.");
}

$product_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Fetch product details
$result = mysqli_query($con, "SELECT * FROM products WHERE product_id='$product_id' AND user_id='$user_id'");
if (mysqli_num_rows($result) == 0) {
    die("Product not found or you don't have permission.");
}

$product = mysqli_fetch_assoc($result);

// If form submitted, update product
if (isset($_POST['update_product'])) {
    $name = mysqli_real_escape_string($con, $_POST['product_name']);
    $categories = isset($_POST['category']) ? implode(',', $_POST['category']) : '';
    $qty = intval($_POST['qty']);
    $price = floatval($_POST['price']);

    $update = mysqli_query($con, "UPDATE products SET 
        product_name='$name',
        categories='$categories',
        qty='$qty',
        price='$price'
        WHERE product_id='$product_id' AND user_id='$user_id'");

    if ($update) {
        header("Location: ../../templates/supplier/index.php?msg=updated");
        exit;
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
}
?>

<!-- HTML Form -->
<form method="POST" class="space-y-4">
    <label>Product Name:</label>
    <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

    <label>Categories:</label>
    <?php
    $all_categories = ['indoor', 'flowering', 'miniature', 'accessories'];
    $selected_categories = explode(',', $product['categories']);
    foreach ($all_categories as $cat) {
        $checked = in_array($cat, $selected_categories) ? 'checked' : '';
        echo "<label><input type='checkbox' name='category[]' value='$cat' $checked> $cat</label> ";
    }
    ?>

    <label>Quantity:</label>
    <input type="number" name="qty" value="<?php echo $product['qty']; ?>" required>

    <label>Price:</label>
    <input type="text" name="price" value="<?php echo $product['price']; ?>" required>

    <button type="submit" name="update_product">Update Product</button>
</form>
