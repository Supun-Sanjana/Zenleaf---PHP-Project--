<?php
include("../../lib/database.php");
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password']; // raw password input

    // Prepare statement to prevent SQL injection
    $stmt = $con->prepare("SELECT user_id, user_name, password, type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        // Verify password (bcrypt recommended)
        if (password_verify($password, $row['password'])) {

            // Check if user is admin
            if (strtolower($row['type']) === 'admin') {
                // Set session variables
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['type'] = trim($row['type']); // ✅ fixed

                // Redirect to admin dashboard
                header("Location: ../../templates/admin/index.php");
                exit;
            } else {
                // Not an admin
                header("Location: ../../templates/admin/login.php?error=invalid_type");
                exit;
            }

        } else {
            // Wrong password
            header("Location: ../../templates/admin/login.php?error=wrong_password");
            exit;
        }
    } else {
        // User not found
        header("Location: ../../templates/admin/login.php?error=user_not_found");
        exit;
    }
}

// Admin check function
function checkAdmin()
{
     
    if (!isset($_SESSION['type']) || strtolower($_SESSION['type']) !== 'admin') {
        header("Location: login.php?error=not_logged_in");
        exit;
    }
}
?>
