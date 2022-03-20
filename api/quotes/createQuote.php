<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quotes.php';
include_once '../../models/Authors.php';
include_once '../../models/Categories.php';


$database = new Database();
$db = $database->connect();


$quote = new Quotes($db);

// get data

$data = json_decode(file_get_contents("php://input"));


$quote->id = $data->id;
$quote->quote = $data->quote;
$quote->authorId = $data->authorId;
$quote->categoryId = $data->categoryId;


// Create the post itself 



//  if(!isset($data->categoryId) || empty($data->categoryId)) {
//     echo json_encode(
//         array('message' => 'categoryId Not Found')
//     );
// }

// else if (!isset($data->id) || empty($data->id) || !isset($data->quote) || empty($data->quote)) {
//     echo json_encode(
//         array('message' => 'Missing Required Parameters')
//     );
//     exit();
// }
 

// if(!isset($data->authorId) || empty($data->authorId)) {
//     echo json_encode(
//         array('message' => 'authorId Not Found')
//     );
// }


if($quote->create()) {
    if(!isset($data->authorId) || empty($data->authorId)) {
    echo json_encode(
        array('message' => 'authorId Not Found')
    );
    exit();
}
    echo json_encode(

        array(

            'id' => $db->lastInsertId(),
            'quote' => $quote->quote,
            'authorId' => $quote->authorId,
            'categoryId' => $quote->categoryId)
    );
 } 
  

 else {
    echo json_encode(
        array('message' => 'quote Not Created')
    );
} 

 
?>