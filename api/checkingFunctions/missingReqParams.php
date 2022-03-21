<?php


function missingParams() {
    echo json_encode( 
        array('message' => 'Missing Required Parameters')
    );
}

?>