<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Authors.php';


$database = new Database();
$db = $database->connect();


$author = new Authors($db);


$data = json_decode(file_get_contents("php://input"));

// if(!property_exists($data, "author")) {
//     echo json_encode(
//         array('message' => 'Missing Required Parameters')
//     )
// }

if($author->create()) { 
    echo json_encode(
        array(
                'id' => $db->lastInsertId(),
                'author' => $author->author)
    );
} 


?>