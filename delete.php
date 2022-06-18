<?php

include_once './config.php';

$con = connectDatabase();

//$id = $_GET['id'];

$id = filter_input(INPUT_GET, 'id');

$id = mysqli_escape_string($con, $id);

if(!isCurrentUserOwnerOfMessageOrAdmin($id)){
    header('Location: index.php');
    exit();
}


$query = "DELETE FROM messages WHERE id='$id'";

mysqli_query($con, $query);

mysqli_close($con);

header('Location: index.php');

