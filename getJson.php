<?php

header("Access-Control-Allow-Origin: *");
include_once './config.php';

$filter = filter_input(INPUT_GET, 'filter');
if(!$filter){
    $filter = '';
}

$con = connectDatabase();

$query = "SELECT messages.*, users.name FROM messages LEFT JOIN users ON messages.author_id = users.id WHERE message LIKE '%$filter%' ORDER BY created DESC";

$results = mysqli_query($con, $query);

$resultsArray = mysqli_fetch_all($results, MYSQLI_ASSOC);

echo json_encode($resultsArray);

