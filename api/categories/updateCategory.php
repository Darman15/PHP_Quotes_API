<?php



include_once '../../config/Database.php';
include_once '../../models/Categories.php';


$database = new Database();
$db = $database->connect();

$category = new Categories($db);


$data = json_decode(file_get_contents("php://input"));

$category->id = $data->id;
$category->category = $data->category;


if($category->update()){
    echo json_encode(
        array('message' => 'category updated id is ' . $category->id . ' category is ' . $category->category)
    );
} else {
    echo json_encode(
        array('message' => 'category Not updated')
    );
}