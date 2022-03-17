<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Authors.php';


$database = new Database();
$db = $database->connect();


$author = new Authors($db);

$author->id = isset($_GET['id']) ? $_GET['id'] : die();


$author->read_single();


$author_arr = array (
    'id' => $author->id,
    'author' => $author->author
);

// convert to json

if($author->id !== null) {
print_r(json_encode($author_arr));
} 
else {
    echo json_encode(
        array('message' => 'authorId Not Found')
    );
}
 


?>