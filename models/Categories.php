<?php

class Categories {

    private $conn;
    private $table = 'category';


    public $id;
    public $category;


    public function __construct($db) {
        $this->conn = $db;
    }
// Start of get all categories
    public function read() {
        $query = 'SELECT 
        id,
        category
        From 
        ' . $this->table;


    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return $stmt;
    }
    // end of get all categories

    public function read_single() {
        $query = 'SELECT
        id,
        category
        
        FROM 
        ' . $this->table . '
        WHERE
        id = ?
        LIMIT 0,1';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
    
        // execute query
    
        $stmt->execute();
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    

        $this->id = $row['id'];
        $this->category = $row['category'];
        
    }
    // end of single category model


    // Start of create new category
    public function create() {
        $query = 'INSERT INTO ' . $this->table . '
        SET
        id = :id,
        category = :category';
        // above uses named parameters
    
        // prepare 
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
      
        
       if($stmt->execute()) {
        
          
            return true;
        }
    
        printf("Error: %s. \n", $stmt->error);
        return false;
        }


        // --------------------------
    // Start of update new category
    public function update() {
        $query = 'UPDATE ' . $this->table . '
        SET
        id = :id,
        category = :category
        WHERE id = :id';
        // above uses named parameters
    
        // prepare 
        $stmt = $this->conn->prepare($query);
    
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);
    
        if($stmt->execute()) {
            return true;
        } 
    
        printf("Error: %s. \n", $stmt->error);
        return false;
        }



        // Delete a category

        public function delete() {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);

            $this->id = htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            } 
        
            printf("Error: %s. \n", $stmt->error);
            return false;
        }
}
?>