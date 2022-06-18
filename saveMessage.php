<?php
include_once './config.php';
goToLoginIfNotLogged();


$title = filter_input(INPUT_POST, 'title');
$message = filter_input(INPUT_POST, 'message');
$price = filter_input(INPUT_POST, 'price');
$contact = filter_input(INPUT_POST, 'contact');

$con = connectDatabase();
$title = mysqli_real_escape_string($con, $title);
$message = mysqli_real_escape_string($con, $message);
$price = mysqli_real_escape_string($con, $price);
$contact = mysqli_real_escape_string($con, $contact);

$author_id = getUserID();



$query = "INSERT INTO messages (author_id, title, message, price, contact) VALUES ('$author_id', '$title', '$message', '$price', '$contact')";


mysqli_query($con, $query);

$id = mysqli_insert_id($con);

$folder = "images/messages/$id";
mkdir($folder);

foreach ($_FILES["images"]["tmp_name"] as $value) {
    $imageName = getRandomImageName();
    move_uploaded_file($value, "$folder/$imageName");
}

mysqli_close($con);

header('Location: index.php');