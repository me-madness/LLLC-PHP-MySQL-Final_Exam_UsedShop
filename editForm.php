<?php
include_once './config.php';

$con = connectDatabase();

$id = filter_input(INPUT_GET, 'id');

$id = mysqli_escape_string($con, $id);

if(!isCurrentUserOwnerOfMessageOrAdmin($id)){
    header('Location: index.php');
    exit();
}

$query = "SELECT * FROM messages WHERE id='$id'";

        
$results = mysqli_query($con, $query);


$row = mysqli_fetch_array($results);

mysqli_close($con);
if(!$row){
    header('Location: index.php');
    exit();
}


?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Form</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Edit Product Details</h1>
        <form action="saveEditedMessage.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            
            Name:<br> <input type="text" name="title"  value="<?= $row['title']?>">
            <br>
            Description:<br> <textarea name="message" rows="5" cols="30"><?= $row['message']?></textarea>
            <br>
            Price: <br> <input type="text" name="price">
            <br>
            Contact: <br> <input type="text" name="contact">
            <br>
            <input type="submit" value="Save">
        </form>
    </body>
</html>
