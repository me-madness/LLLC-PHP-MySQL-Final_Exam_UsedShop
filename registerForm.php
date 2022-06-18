<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registry Form</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Register</h1>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            Name: <input name="name" required><br>
            Password: <input type="password" required name="password"><br>
            Email: <input type="email" required name="email"><br>
            Your Avatar: <input type="file" name="avatar" accept="images/*"><br>
            <button type="submit">Register</button>          
        </form>
    </body>
</html>
