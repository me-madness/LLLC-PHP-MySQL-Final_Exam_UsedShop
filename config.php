<?php

session_start();

define('host', "localhost");
define('user', "root");
define('password', "");
define('dataBase', "blog");
define('amount', 3);

function connectDatabase() {
    $con = mysqli_connect(host, user, password, dataBase);
    mysqli_set_charset($con, "utf8");
    return $con;
}

function h($param) {
    return htmlspecialchars($param);
}

function isLogged() {
    $isLogged = isset($_SESSION["userID"]);
    return $isLogged;
}

function getUserID() {
    if (isLogged()) {
        return $_SESSION["userID"];
    } else {
        return -1;
    }
}

function isAdmin() {
    if (isLogged()) {
        return $_SESSION["isAdmin"];
    } else {
        return false;
    }
}

function getUserNameById($id) {
    $con = connectDatabase();

    $query = "SELECT * FROM users WHERE id='$id'";

    $results = mysqli_query($con, $query);

    $noRecords = mysqli_num_rows($results);

    if ($noRecords == 0) {
        $out = '';
    } else {
        $row = mysqli_fetch_array($results);
        $out = $row['name'];
    }

    mysqli_close($con);
    return $out;
}

function getUsersDropdown() {
    $con = connectDatabase();

    $query = "SELECT * FROM users";

    $results = mysqli_query($con, $query);

    $usersArray = mysqli_fetch_all($results, MYSQLI_ASSOC);
    mysqli_close($con);

    $out = "<select name='author_id'>";
    foreach ($usersArray as $user) {
        $name = h($user['name']);
        $id = $user['id'];
        $out = $out . "<option value='$id'>$name</option>";
    }

    $out = $out . "</select>";

    return $out;
}

function goToLoginIfNotLogged() {
    if (!isLogged()) {
        header('Location: loginForm.php');
    }
}

function isCurrentUserOwnerOfMessageOrAdmin($message_id) {
    if (!isLogged()) {
        return false;
    }

    if (isAdmin()) {
        return true;
    }

    $curretUserId = getUserID();

    $con = connectDatabase();

    $query = "SELECT * FROM messages WHERE id='$message_id'";

    $results = mysqli_query($con, $query);

    $row = mysqli_fetch_array($results);
    mysqli_close($con);

    if ($row['author_id'] == $curretUserId) {
        return true;
    } else {
        return false;
    }
}

function getRandomImageName() {
    $temp = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
    $out = substr($temp, 0, 12);

    return $out;
}

function getImagesForMessage($message_id) {
    $names = [];

    $dir = "images/messages/$message_id/";

    if (file_exists($dir)) {
        $dh = opendir($dir);

        while ($file = readdir($dh)) {
            if (!is_dir($file)) {
                $names[] = $file;
            }
        }
    }

    return $names;
}

function generateRecoveryKey(){
    $key = str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
    return $key;
}
