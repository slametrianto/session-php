<?php
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST["login"])) {


    $username = $_POST["names"];
    $password = $_POST["password"];


    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    //cek username ada beberapa baris di result
    if (mysqli_num_rows($result) === 1) {

        //cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            //set session
            $_SESSION["login"] = true;

            header("location: index.php");
            exit;
        }
    }

    $error = true;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
</head>

<body>

    <h1>Halaman Login</h1>

    <?php if (isset($error)) : ?>
        <p style="color:red; font-style:italic;">username / password salah</p>

    <?php endif; ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="names">Username :</label>
                <input type="text" name="names" id="names">

            </li>
            <br>

            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <br>
            <li>

                <button type="login" name="login">Login</button>
            </li>
        </ul>

    </form>



</body>

</html>