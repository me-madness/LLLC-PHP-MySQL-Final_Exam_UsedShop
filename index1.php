<?php
    include_once './config.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
<!--        <header>Welcome to <br> USED SHOP </header>-->
        
        <div style="text-align: right">
            <ul class="nav justify-content-end">
                 <li class="nav-item">
            <?php if (isLogged()): ?>
                Hello  <?= $_SESSION["userName"] ?> <br>
                <a class="nav-link" href="logout.php">Logout</a>
            <?php else: ?>
                </li>
                <br>
                <li class="nav-item">
                <a class="nav-link" href="registerForm.php">Register</a>
                </li>
                <br>
                <li class="nav-item">
                <a class="nav-link" href="loginForm.php">Login</a>
                </li>
                <br>
            <?php endif; ?>
                 </li>
            </ul>
        </div>
        <header>Welcome to <br> USED SHOP </header>
    </body>
</html>
