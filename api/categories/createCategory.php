<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Categories.php';


$database = new Database();
$db = $database->connect();

$category = new Categories($db);


$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;
$category->category = $data->category;



 if($category->create()){
     
   echo json_encode(
        array('message' => 'Category Created',
                'id' => $category->id,
                'category' => $category->category)
    );
} else {
    echo json_encode(
        array('message' => 'Category Not Created')
    );
}