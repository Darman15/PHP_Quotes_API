<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');
// Set teh request method to variable to use for redirect
$method = $_SERVER['REQUEST_METHOD'];

$isAnId = filter_input(INPUT_GET, "id");

if(isset($isAnId) && $method == 'GET') {
    include('./categories_read_single.php');
}

else if ($method == 'GET') {
    include('./categories.php');
}

else if ($method == 'POST') {
    include('./createCategory.php');
} 

else if ($method == 'PUT') {
    include('./updateCategory.php');
}

else if ($method == 'DELETE') {
    include('./deleteCategory.php');
}





else {
    echo json_encode(
        array('message' => 'No Quotes Found')
    );
}



?>