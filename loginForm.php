<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Login Here</h1>
        <form action="login.php" method="post">
            Username: <input name="name"><br>
            Password: <input type="password" name="password"><br><br>
            <button type="submit">Login</button>    
        </form>
        <a href="restorePasswordForm.php">Forgoten password</a>
    </body>
</html>
