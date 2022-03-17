<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, 
Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Quotes.php';
include_once '../../models/Authors.php';


$database = new Database();
$db = $database->connect();


$quote = new Quotes($db);

$quote->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();

$result = $quote->getQuotesByCategoryId();

$num = $result->rowCount();
echo $num;

 if($num > 0) {
    $quote_arr = array();
    $quote_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $quote_item = array( 
            
            'quote' => html_entity_decode($quote),
            'categoryId' => $categoryId,
            'id' => $id,
            'category' => $category
           
        );

        array_push($quote_arr['data'], $quote_item);
 }
 echo json_encode($quote_arr);
    echo json_encode(
        array('message' => 'All quotes in categoryId=' . $categoryId)
    );
} else {
    echo json_encode(
        array('message' => 'No quotes found')
    );
}
    


   
