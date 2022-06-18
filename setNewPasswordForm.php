<?php
include_once './config.php';

$id = filter_input(INPUT_GET, 'id');
$key = filter_input(INPUT_GET, 'key');

$con = connectDatabase();
$id = mysqli_real_escape_string($con, $id);
$key = mysqli_real_escape_string($con, $key);

$query = "SELECT * FROM users WHERE id='$id' AND recoverykey='$key'";

$results = mysqli_query($con, $query);

$noRecords = mysqli_num_rows($results);

if($noRecords == 0){
    header('Location: index.php');
    exit();
}

$_SESSION['recovery_id'] = $id;


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Change Password</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <form action="changePassword.php" method="post">
            Your new Password <input name="password" type="password">
            <br>
            <button>Change password</button>
        </form>
    </body>
</html>
