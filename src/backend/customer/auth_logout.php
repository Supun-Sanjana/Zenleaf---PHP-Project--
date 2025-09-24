<?php
// Always start the session first
session_start();

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

echo "You have been logged out.";

// Redirect to public/index.php
// Use absolute path from web root
header("Location: ../../../public/index.php");
exit;
?>
