<?php
include("../../lib/database.php");
?>
<?php

if (isset($_POST['submit'])) {
    echo "Form submitted successfully!";

    $email = $_POST['email'];
    $password = md5($_POST['password']);


    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if ($result) {
        header("location:../../../public/index.php");
    } else {
        echo "Something went wrong!! 🥲";
    }


}


?>