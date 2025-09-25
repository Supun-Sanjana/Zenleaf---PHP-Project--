<?php
include("../../lib/database.php"); // Your database connection file


session_start();
include("../../lib/database.php");

// Make sure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

$user_id = $_SESSION['user_id']; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Collect and sanitize input
    $business_name = trim($_POST['business-name']);
    $full_name = trim($_POST['full-name']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);

    // Handle file upload
    if (isset($_FILES['br-file']) && $_FILES['br-file']['error'] === 0) {
        $file_tmp = $_FILES['br-file']['tmp_name'];
        $file_name = time() . "_" . basename($_FILES['br-file']['name']); // Unique filename
        $target_dir = "uploads/business_files/"; // Make sure this folder exists and is writable
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            // File uploaded successfully, now insert data
            $stmt = $con->prepare("INSERT INTO business_reg (user_id, b_name, b_address, full_name, email, p_number, b_certificate) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $user_id,$business_name, $address, $full_name, $email, $phone, $target_file);

            if ($stmt->execute()) {
                echo "<p class='text-green-600 font-bold'>Business registered successfully!</p>";
            } else {
                echo "<p class='text-red-600 font-bold'>Error: " . $stmt->error . "</p>";
            }

            $stmt->close();
        } else {
            echo "<p class='text-red-600 font-bold'>Failed to upload file.</p>";
        }

    } else {
        echo "<p class='text-red-600 font-bold'>Please upload a valid file.</p>";
    }
}
?>