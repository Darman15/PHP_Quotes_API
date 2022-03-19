<?php 
    

    $method = $_SERVER['REQUEST_METHOD'];

    $isAnId = filter_input(INPUT_GET, "id");
    $isAnAuthorId = filter_input(INPUT_GET, "authorId");
    $isAnCategoryId = filter_input(INPUT_GET, "categoryId");
    

   if(!empty($isAnId) && $method == 'GET') {
     
    include('./quotes_read_single.php');
    }

    else if (!empty($isAnCategoryId) && !empty($isAnAuthorId) && $method == 'GET') {
        include('./quoteByCategoryIdAndAuthorId.php');
    }

    else if (!empty($isAnAuthorId) && $method == 'GET') {
        
        include('./quoteByAuthorID.php');
    }

    else if (!empty($isAnCategoryId) && $method == 'GET') {
      
        include('./quoteByCategoryId.php');
    }

    else if ($method == 'POST') {
        include('./createQuote.php');
    }

    else if ($method == 'PUT') {
        include('./updateQuote.php');
    }

    else if ($method == 'DELETE') {
        include('./deleteQuote.php');
    }

    

else if($method == 'GET') {
    include('./quotes.php');
} 








?>

 




    
