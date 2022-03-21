<?php


function fail(String $modelType, String $op) {

 echo json_encode(
     array('message' => $modelType . ' Not ' . $op)
 );

}


?>