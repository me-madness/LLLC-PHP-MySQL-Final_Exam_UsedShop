<?php
include_once './config.php';

$id = filter_input(INPUT_GET, 'id');

$con = connectDatabase();

$query = "SELECT * FROM users WHERE id='$id'";


$results = mysqli_query($con, $query);

$row = mysqli_fetch_array($results);

if($row){
    $avatar = base64_decode($row['avatar']);
    
    $mime = $row['mime'];
    
    header ("Content-Type: $mime"); 
    
    echo $avatar;
}

mysqli_close($con);