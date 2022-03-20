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
    $author_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $author_item = array( 
            'id' => $id,
            'author' => $author   
        );

        array_push($author_arr, $author_item);
    
    }

   print_r(json_encode($author_arr));

} else {
    echo json_encode(
        array('message' => 'No authors found')
    );
}


?>