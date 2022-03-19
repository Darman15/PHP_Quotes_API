<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Quotes.php';


$database = new Database();
$db = $database->connect();

// instantiation of the quote/quotes

$quote = new Quotes($db);

// call the query from read method to get properties
// All post logic
$result = $quote->read();

$num = $result->rowCount();

if($num > 0) {
    // make an array of the quotes
    $quote_arr = array();
    $quote_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array( 
            'id' => $id,
            'quote' => html_entity_decode($quote),
            'authorId' => $authorId,
            'categoryId' => $categoryId
        );

        array_push($quote_arr, $quote_item);
    
    }

    echo json_encode($quote_arr);
    // echo json_encode(
    //     array('message' => 'All quotes are returned')
    // );
// } else {
//     echo json_encode(
//         array('message' => 'No quotes found')
//     );
// }
// End of all quotes logic



?>