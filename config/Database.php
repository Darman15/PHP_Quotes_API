<?php

class Database {



  

public function connect() {
   
    $hostname = getenv('DB_HOST');
    $username = getenv('DB_PASSWORD');
    $password = getenv('DB_NAME');
    $database = getenv('DB_USER');
    $conn;

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected Successfully";
        
    } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }

    return $conn;

}

}



?>
