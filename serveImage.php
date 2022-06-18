<?php

$id = filter_input(INPUT_GET, 'id');
$name = filter_input(INPUT_GET, 'name');

$filename = "images/messages/$id/$name";
$mime = mime_content_type($filename);

header ("Content-Type: $mime"); 
readfile($filename);