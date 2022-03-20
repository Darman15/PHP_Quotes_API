<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Categories.php';



$database = new Database();
$db = $database->connect();

$category = new Categories($db);

$result = $category->read();

$num = $result->rowCount();

if($num > 0) {
    // make an array of the quotes
    $category_arr = array();
    $category_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $category_item = array( 
            'id' => $id,
            'category' => $category   
        );

        array_push($category_arr, $category_item);
    
    }

    print_r(json_encode($category_arr));

} else {
    echo json_encode(
        array('message' => 'No categories found')
    );
}


?>















?>
