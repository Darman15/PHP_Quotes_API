<?php 

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin,Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');

// set the request method to a variable to use for redirect logic
$method = $_SERVER['REQUEST_METHOD'];

$isAnId = filter_input(INPUT_GET, "id");

// echo $isAnID;
// start of get all authors by ID redirect logic
 if (isset($isAnId) && $method == 'GET') {
    include('./author_read_single.php');
} 

// Start of Get all authors redirect logic
 else if ($method == 'GET') {
    include('./authors.php');

} 

else if ($method == 'PUT') {
    include('./updateAuthor.php');
}


else if ($method == 'DELETE') {
    include('./deleteAuthor.php');
}
// end of get all authors redirect logic

if ($method == 'POST') {
    include('./createAuthor.php');
}


?>