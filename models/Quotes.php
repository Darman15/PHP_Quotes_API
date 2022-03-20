
<?php

class Quotes {
private $conn;
private $table = 'quotes';


// post properties or felids

public $id;
public $quote;
public $authorId;
public $categoryId;


// Database constructor
public function __construct($db) {
    $this->conn = $db;
}

// get and display the quotes

// start of get all quotes
public function read() {
    $query = 'SELECT
    q.id,
    q.quote,
    a.author,
    c.category
    From
    ' . $this->table . ' q
    LEFT JOIN authors a 
    ON
    q.authorId = a.id
    LEFT JOIN category c
    ON
    q.categoryId = c.id';
    

    // create statements
    

    $stmt = $this->conn->prepare($query);

    // execute query

$stmt->execute();

    return $stmt;
}
// end of get all quotes


// To read a single quote
public function read_single() {
    $query = 'SELECT
    q.id,
    q.quote,
    a.author,
    c.category
    From
    ' . $this->table . ' q
    LEFT JOIN authors a 
    ON
    q.authorId = a.id
    LEFT JOIN category c
    ON
    q.categoryId = c.id
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
    $this->quote = $row['quote'];
    $this->authorId = $row['authorId'];
    $this->categoryId = $row['categoryId'];
}

// end of single quote by id logic




// -----------------------
// Start Get all quotes by an author ID
public function getQuotesByAuthorID() {
    
    $query = 'SELECT 
    q.quote,
    q.authorId,
    a.id,
    a.author
    FROM
    ' . $this->table . ' q
   LEFT JOIN authors a ON  
   q.authorId = a.id
    WHERE
    q.authorId = :authorId';

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute 
    
  
    $stmt->bindParam(':authorId', $this->authorId);
   
    // $stmt->bindParam(':id', $this->id);
    // $stmt->bindParam(':author', $this->author);

    $stmt->execute();    
 return $stmt;

}
// ------------------
// End of quotes by author ID


// Start quotes by Category ID

public function getQuotesByCategoryId() {
    
    $query = 'SELECT 
    q.quote,
    q.categoryId,
    c.id,
    c.category
    FROM
    ' . $this->table . ' q
   LEFT JOIN category c ON  
   q.categoryId = c.id
    WHERE
    q.categoryId = :categoryId';

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute 
    
  
    $stmt->bindParam(':categoryId', $this->categoryId);
   


    $stmt->execute();    
 return $stmt;

}
// end quotes by category Id

// --------------------------
// Start get quotes by author and category ID
public function getQuotesByAuthorIdAndCategoryId() {
    
    $query = 'SELECT 
    q.quote,
    q.authorId,
    q.categoryId,
    a.id,
    c.category,
    c.id
    FROM
    ' . $this->table . ' q
   LEFT JOIN authors a 
   ON  
   q.authorId = a.id
   LEFT JOIN 
   category c
   ON 
   q.categoryId = c.id
    WHERE
      q.authorId = :authorId && q.categoryId = :categoryId' ;

    // prepare
    $stmt = $this->conn->prepare($query);
    
    // Execute 
    
  
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);
   


    $stmt->execute();    
 return $stmt;

}


// Create a quote

public function create() {
    $query = 'INSERT INTO ' . 
    $this->table . '
    SET
     id = :id,
     quote = :quote,
     authorId = :authorId,
     categoryId = :categoryId';

   $stmt = $this->conn->prepare($query);

//    Sanatize

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);




    if($stmt->execute()) {
        return true;
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    
}

// update a quote

public function update() {
    $query = 'UPDATE ' . 
    $this->table . '
    SET
     id = :id,
     quote = :quote,
     authorId = :authorId,
     categoryId = :categoryId
     WHERE 
     id = :id';

   $stmt = $this->conn->prepare($query);

//    Sanatize

    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->quote = htmlspecialchars(strip_tags($this->quote));
    $this->authorId = htmlspecialchars(strip_tags($this->authorId));
    $this->categoryId = htmlspecialchars(strip_tags($this->categoryId));

    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':quote', $this->quote);
    $stmt->bindParam(':authorId', $this->authorId);
    $stmt->bindParam(':categoryId', $this->categoryId);

    if($stmt->execute()) {
        return true;
    } 

    printf("Error: %s. \n", $stmt->error);
    return false;
    
}


// --------------------
// Delete a quote
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