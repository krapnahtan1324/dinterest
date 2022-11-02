<?php
function addRecipe($recipe_id, $name, $instructions) // Need to pass this in the right order (depends on POST in simpleform.php) 
{
    global $db; // Keep using one connection to save space and prevent suspension (this is similar to memory leak)
    // $db is the variable name of the PDO instance that we made in connect-db.php
    // global in PHP allows us to expand the scope to link to other variales in other files 
    $query = "INSERT INTO Recipe VALUES (:recipe_id, :name, :instructions)"; // Minimizes the chance of being attacked 
    // If you use double quotes, you can use both strings and variables 
    // SQL injection will all be compiled - all the bad code and good code will impact DB 
        // To minimize the chance of being attacked, use a prepare statement 
    // Make DBMS compile these template variables --> only compile once 
    try {
    $statement = $db->prepare($query); //prepare function is part of PDO 
    // Get this query and compile; once it compiles, prepare function will return an 
        // executable version of the query 
    $statement->bindValue(':recipe_id', $recipe_id); 
    $statement->bindValue(':name', $name); 
    $statement->bindValue(':instructions', $instructions);
    //$statement->bindValue(':year', $year); // Fill in the blank with the real value 
    $statement->execute(); // Tell DBMS to actually run 
    $statement->closeCursor(); // We executed the query so release it so other users can make use of that instance
    }
    catch (PDOException $e)
    {
        if ($statement->rowCount() == 0)
            echo "Failed to add a friend <br/"; 
    }
    catch (Exception $e)
    {
        echo $e->getMessage(); 
    }
}
?>