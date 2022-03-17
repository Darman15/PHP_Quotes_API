<?php

class Database {
private $host = 'acw2033ndw0at1t7.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
private $db_name = 'r8y2bi4z7seeo5oq';
private $username = 'r7yi52dsre3so2hn';
private $password = getenv(db_password);
private $conn;


public function connect() {
    $this->conn = null;

    try {
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        
    } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
    }

    return $this->conn;

}

}



?>
