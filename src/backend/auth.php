<!-- Single script to handle login for all roles -->

<?php
// Start a session to store user data if login is successful
session_start();

// Define a simple, hard-coded username and password for demonstration
$valid_email = 'admin@zenleaf.com';
$valid_password = 'password123'; // In a real app, use password_hash() and password_verify()

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Basic validation
    if (!empty($email) && !empty($password)) {
        // Check if credentials match
        if ($email === $valid_email && $password === $valid_password) {
            // Login successful
            $_SESSION['logged_in'] = true;
            $_SESSION['email'] = $email;

            // Redirect to the admin dashboard (index.php)
            header("Location: index.php");
            exit();
        } else {
            // Login failed
            echo '<div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 1rem; margin: 1rem; border-radius: 0.5rem; text-align: center;">';
            echo 'Invalid email or password. Please try again.';
            echo '</div>';
            // Include the login form again for the user to retry
            include '../../public/login.php';
        }
    } else {
        // Missing fields
        echo '<div style="background-color: #fef3c7; border: 1px solid #f59e0b; color: #92400e; padding: 1rem; margin: 1rem; border-radius: 0.5rem; text-align: center;">';
        echo 'Both email and password are required.';
        echo '</div>';
        include 'login.php';
    }
} else {
    // If the page is accessed directly without a POST request
    header("Location: login.php");
    exit();
}
?>