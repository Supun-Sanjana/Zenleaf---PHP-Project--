<?php
include("../../lib/database.php");

if (isset($_POST['submit'])) {
    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $user_name  = trim($_POST['user_name']);
    $type       = trim($_POST['type']);

    // Password match check
    if ($_POST['password'] !== $_POST['password_confirmation']) {
        header("Location: ../../../public/login.php?pass_error=true");
        exit;
    }

    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // User ID generator
    function generateUserId($type) {
        $type = strtolower(trim($type));
        $prefix = $type === 'customer' ? 'C' : ($type === 'supplier' ? 'S' : '');
        if (!$prefix) throw new InvalidArgumentException("Invalid user type");
        return $prefix . rand(1000, 99999);
    }

    // Ensure unique user_id
    do {
        $user_id = generateUserId($type);
        $check = mysqli_query($con, "SELECT user_id FROM users WHERE user_id='$user_id'");
    } while (mysqli_num_rows($check) > 0);

    /** IMAGE UPLOAD **/
    $image_path = null;
    if (!empty($_FILES['profile_image']['name'])) {
        $upload_dir  = "../../../public/uploads/";
        $file_name   = basename($_FILES['profile_image']['name']);
        $target_file = $upload_dir . time() . "_" . preg_replace("/[^A-Za-z0-9._-]/", "_", $file_name);

        // Validate image type and size (2MB limit)
        $allowed_types = ['image/jpeg','image/png','image/gif'];
        if (!in_array($_FILES['profile_image']['type'], $allowed_types)) {
            die("Invalid image type. Only JPG, PNG, GIF allowed.");
        }
        if ($_FILES['profile_image']['size'] > 2*1024*1024) {
            die("Image too large. Max size is 2MB.");
        }

        if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
            die("Image upload failed.");
        }

        $image_path = $target_file; // Save path to DB
    }

    /** INSERT USER **/
    $stmt = $con->prepare("INSERT INTO users 
        (user_id, first_name, last_name, user_name, email, password, type, image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind all 8 values
    $stmt->bind_param(
        "ssssssss",
        $user_id,
        $first_name,
        $last_name,
        $user_name,
        $email,
        $password,
        $type,
        $image_path
    );

    if ($stmt->execute()) {
        header("Location: ../../../public/index.php");
        exit;
    } else {
        echo "Something went wrong!! 🥲 Error: " . $stmt->error;
    }
}
?>
