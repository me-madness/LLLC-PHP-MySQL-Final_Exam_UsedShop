<?php
include_once './config.php';

goToLoginIfNotLogged();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Message</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Add your product</h1>
        <form action="saveMessage.php" method="post" enctype="multipart/form-data">
            Name: <br> <input type="text" name="title">
            <br><br>
            Description: <br> <textarea name="message" rows="5" cols="30"></textarea>
            <br>
            Price: <br> <input type="text" name="price">
            <br><br>
            Image: <input type="file" name="images[]" multiple accept="images/*">
            <br><br>
            Contact: <br> <input type="text" name="contact">
            <br><br>
            <input type="submit" value="Upload">
        </form>
    </body>
</html>

