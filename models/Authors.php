<?php 

class Authors {

    private $conn;
    private $table = 'authors';

    public $id;
    public $author;

    public function __construct($db) {
        $this->conn = $db;
    }
// To get all authors
    public function read() {
        $query = 'SELECT
        id,
        author
        From
        ' . $this->table;


$stmt = $this->conn->prepare($query);


$stmt->execute();

return $stmt;

}
// end of get all authors model 


// To get single author by ID
public function read_single() {
    $query = 'SELECT
    id,
    author
   
    From
    ' . $this->table . '
    WHERE 
    id = ?
    LIMIT 0,1';

    // prepare the statment
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    // execute query

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set Properties

    $this->id = $row['id'];
    $this->author = $row['author'];
 
}
//  end of get single author by id


// create or post new author

public function create() {
    $query = 'INSERT INTO ' . $this->table . '
    SET
    id = :id,
    author = :author';
    // above uses named parameters

    // prepare 
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->author = htmlspecialchars(strip_tags($this->author));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':author', $this->author);

    


    if($stmt->execute()) {
        return true;
    } 

   

    printf("Error: %s. \n", $stmt->error);
    return false;
    }
    // -----------------------

    // Delete author

public function update() {
    $query = 'UPDATE ' . $this->table . '
    SET
    id = :id,
    author = :author
    WHERE
    id = :id'
    ;
    // above uses named parameters

    // prepare 
    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->author = htmlspecialchars(strip_tags($this->author));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':author', $this->author);

    if($stmt->execute()) {
        return true;
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    }

    // -------------------
    // Delete

    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

        $stmt = $this->conn->prepare($query);
 // sanatize
        $this->id = htmlspecialchars(strip_tags($this->id));

        // binde
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        } 
    
        printf("Error: %s. \n", $stmt->error);
        return false;
        
    }
}

?>