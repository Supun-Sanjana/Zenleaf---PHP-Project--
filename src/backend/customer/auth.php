<?php
include("../../lib/database.php");
session_start();

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    $stmt = $con->prepare("SELECT user_id, user_name, first_name, password, type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {

        if (password_verify($password, $row['password'])) {

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['type'] = $row['type'];

            if ($row['type'] === 'supplier') {
                header("Location: ../../templates/supplier/index.php");
            } else {
                header("Location: ../../../public/index.php");
            }
            exit;

        } else {
            header("Location: ../../../public/login.php?error=wrong_password");
            exit;
        }

    } else {
        header("Location: ../../../public/login.php?error=user_not_found");
        exit;
    }
}
?>
