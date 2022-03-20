<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

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