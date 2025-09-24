<?php
include("../../lib/database.php");
session_start(); // Start session to store login info

if (isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password']; // Raw password input

    // Use prepared statement to prevent SQL injection
    $stmt = $con->prepare("SELECT user_id, user_name, password, type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {

        // Verify password (assuming bcrypt hash stored in DB)
        if (password_verify($password, $row['password'])) {

            // Check if user is a customer
            if (strtolower($row['type']) === 'customer') {

                // Set session variables
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['type'] = $row['type'];

                // Redirect to customer dashboard or homepage
                header("Location: ../../../public/index.php");
                exit;

            } else {
                // Not a customer
                header("Location: ../../../public/login.php?error=invalid_type");
                exit;
            }

        } else {
            // Wrong password
            header("Location: ../../../public/login.php?error=wrong_password");
            exit;
        }

    } else {
        // User not found
        header("Location: ../../../public/login.php?error=user_not_found");
        exit;
    }
}
?>
