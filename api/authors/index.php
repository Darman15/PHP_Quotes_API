<?php 


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