<?php

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