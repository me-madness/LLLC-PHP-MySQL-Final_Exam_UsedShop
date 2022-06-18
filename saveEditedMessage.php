<?php

include_once './config.php';


$title = filter_input(INPUT_POST, 'title');
$message = filter_input(INPUT_POST, 'message');
$price = filter_input(INPUT_POST, 'price');
$contact = filter_input(INPUT_POST, 'contact');
$id = filter_input(INPUT_POST, 'id');


$con = connectDatabase();
$title = mysqli_real_escape_string($con, $title);
$message = mysqli_real_escape_string($con, $message);
$price = mysqli_real_escape_string($con, $price);
$contact = mysqli_real_escape_string($con, $contact);
$id = mysqli_real_escape_string($con, $id);

if(!isCurrentUserOwnerOfMessageOrAdmin($id)){
    header('Location: index.php');
    exit();
}


$query = "UPDATE messages SET title='$title', message='$message', price='$price', contact='$contact', modified=now() WHERE id='$id'";

mysqli_query($con, $query);

mysqli_close($con);

header('Location: index.php');