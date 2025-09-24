<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['type'])) {
    // Not logged in, redirect to login
    header("Location: ../../../public/login.php?error=not_logged_in");
    exit;
}

// Check if user is admin
if (strtolower($_SESSION['type']) !== 'admin') {
    // Logged in but not admin
    header("Location: ../../../public/login.php?error=access_denied");
    exit;
}

// If this point is reached, the user is an admin and can access the page
?>
