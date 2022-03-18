<?php

class Database {
    $url = getenv('JAWSDB_URL');
    $dbparts = parse_url($url);
    
    $hostname = $dbparts['host'];
    $username = $dbparts['user'];
    $password = $dbparts['pass'];
    $database = ltrim($dbparts['path'],'/');


public function connect() {
    $this->conn = null;

    try {
        $this->conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected Successfully";
        
    } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;

}

}



?>
