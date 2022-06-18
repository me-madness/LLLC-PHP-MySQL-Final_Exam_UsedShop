<?php

include_once './config.php';

$name = filter_input(INPUT_POST, 'name');
$password = filter_input(INPUT_POST, 'password');
$email = filter_input(INPUT_POST, 'email');

$con = connectDatabase();
$name = mysqli_real_escape_string($con, $name);
$password = mysqli_real_escape_string($con, $password);
$email = mysqli_real_escape_string($con, $email);

$salt_temp = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
$salt = '$2a$10$' . substr($salt_temp, 0, 22);

$enc_password = crypt($password, $salt);

$source = $_FILES["avatar"]["tmp_name"];

$info = getimagesize($source);

if ($info !== false) {
    
    $mime = mime_content_type($source);

    $content = file_get_contents($source);

    $textContent = base64_encode($content);

    $query = "INSERT INTO users (name, password, email, avatar, mime) VALUES ('$name','$enc_password','$email', '$textContent', '$mime')";

    mysqli_query($con, $query);
}


mysqli_close($con);

header('Location: index.php');
