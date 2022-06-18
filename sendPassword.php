<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include_once './config.php';

$email = filter_input(INPUT_POST, 'email');

$email = trim($email);

$con = connectDatabase();

$email = mysqli_real_escape_string($con, $email);
$query = "SELECT * FROM users WHERE email='$email'";

$results = mysqli_query($con, $query);

$noRecords = mysqli_num_rows($results);

if ($noRecords > 0) {
    $row = mysqli_fetch_array($results);
    $id = $row['id'];
    $name = $row['name'];

    $key = generateRecoveryKey();
    $query = "UPDATE users SET recoverykey='$key' WHERE id='$id'";
    mysqli_query($con, $query);

    $url = "http://localhost/UsedShop/setNewPasswordForm.php?id=$id&key=$key";

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

//Set it to 1 if you want to see the debug output
    $mail->SMTPDebug = 0;

    $mail->SMTPAuth = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->Host = "w014e163.kasserver.com";
    $mail->Username = "student@lllc.info";
    $mail->Password = "b8Gfy6UvMfwJXRgc";

    $mail->IsHTML(true);
    $mail->AddAddress($email, $name);
    $mail->SetFrom("student@lllc.info", "Student LLLC");
    $mail->Subject = "The password remainder";
    $content = "In odrer to change your password klic on the lollowing link" .
            "<br><a href='$url'>$url</a>";

    $mail->MsgHTML($content);
    $mail->Send();
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Send new Password</title>
        <link rel="stylesheet" href="./style.css">
    </head>
    <body>
        <h1>Check your email in order to change your password</h1>
    </body>
</html>
