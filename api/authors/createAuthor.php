<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Authors.php';


$database = new Database();
$db = $database->connect();


$author = new Authors($db);


$data = json_decode(file_get_contents("php://input"));

$author->id = $data->id;
$author->author = $data->author;


if($author->create()) {
    echo(json_encode(
        array(
                'id' => $db->lastInsertId(),
                'author' => $author->author,
                'authorId' => $authorId->authorId.
                'categoryId' => $categoryId->categoryId)
    ));
} else {
    echo json_encode(
        array('message' => 'Author Not Created')
    );
}


// if($author->create()) {
//   $author_arr = array();

//   $author_item = array (
//       'id' => $id,
//       'author' => $author
//   );

//   array_push($author_arr, $author_item);

//   print_r(json_encode($author_arr));

// } else {
//     echo json_encode(
//         array('message' => 'Author Not Created')
//     );
// }


?>