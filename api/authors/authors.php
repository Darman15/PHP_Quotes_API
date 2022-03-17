<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Authors.php';


$database = new Database();
$db = $database->connect();


$author = new Authors($db);


$result = $author->read();

$num = $result->rowCount();


if($num > 0) {
    // make an array of the quotes
    $author_arr = array();
    $author_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array( 
            'id' => $id,
            'author' => $author   
        );

        array_push($author_arr['data'], $author_item);
    
    }

    echo json_encode($author_arr);
    echo json_encode(
        array('message' => 'All authors with their id')
    );
} else {
    echo json_encode(
        array('message' => 'No authors found')
    );
}
