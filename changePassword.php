<?php
include_once './config.php';

if(!isset($_SESSION['recovery_id'])){
    header('Location: index.php');
    exit();
}

$password = filter_input(INPUT_POST, 'password');

$salt_temp = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
$salt = '$2a$10$' . substr($salt_temp, 0, 22);

$enc_password = crypt($password, $salt);

$id = $_SESSION['recovery_id'];

$con = connectDatabase();
$query = "UPDATE users SET password='$enc_password', recoverykey=NULL WHERE id='$id'";


mysqli_query($con, $query);

mysqli_close($con);

unset($_SESSION['recovery_id']);

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Your password was changed successfully</h1>
        <a href="loginForm.php">Login</a>
    </body>
</html>
