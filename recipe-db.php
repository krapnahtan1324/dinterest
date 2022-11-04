<?php
function addRecipe($recipe_id, $recipe_name, $instructions) // Need to pass this in the right order (depends on POST in simpleform.php) 
{
    global $db; // Keep using one connection to save space and prevent suspension (this is similar to memory leak)
    // $db is the variable name of the PDO instance that we made in connect-db.php
    // global in PHP allows us to expand the scope to link to other variales in other files 
    $query = "INSERT INTO Recipe VALUES (:recipe_id, :recipe_name, :instructions)"; // Minimizes the chance of being attacked 
    // If you use double quotes, you can use both strings and variables 
    // SQL injection will all be compiled - all the bad code and good code will impact DB 
        // To minimize the chance of being attacked, use a prepare statement 
    // Make DBMS compile these template variables --> only compile once 
    try {
    $statement = $db->prepare($query); //prepare function is part of PDO 
    // Get this query and compile; once it compiles, prepare function will return an 
        // executable version of the query 
    $statement->bindValue(':recipe_id', $recipe_id); 
    $statement->bindValue(':recipe_name', $recipe_recipe_name); 
    $statement->bindValue(':instructions', $instructions);
    //$statement->bindValue(':year', $year); // Fill in the blank with the real value 
    $statement->execute(); // Tell DBMS to actually run 
    $statement->closeCursor(); // We executed the query so release it so other users can make use of that instance
    }
    catch (PDOException $e)
    {
        if ($statement->rowCount() == 0)
            echo "Failed to add a recipe <br/"; 
    }
    catch (Exception $e)
    {
        echo $e->getMessage(); 
    }
}

function addRecipeIngredients($recipe_id, $ingredients) 
{
    global $db; 
    $query = "INSERT INTO Recipe_ingredients VALUES (:recipe_id, :ingredients)";  
    try {
    $statement = $db->prepare($query); 
    $statement->bindValue(':recipe_id', $recipe_id); 
    $statement->bindValue(':ingredients', $ingredients);
   
    $statement->execute(); 
    $statement->closeCursor(); 
    }
    catch (PDOException $e)
    {
        if ($statement->rowCount() == 0)
            echo "Failed to add to recipe_ingredients <br/"; 
    }
    catch (Exception $e)
    {
        echo $e->getMessage(); 
    }
}


function addFilterableCharacteristics($recipe_id, $cuisine, $servings, $total_time) // Need to pass this in the right order (depends on POST in simpleform.php) 
{
    global $db; // Keep using one connection to save space and prevent suspension (this is similar to memory leak)
    // $db is the variable name of the PDO instance that we made in connect-db.php
    // global in PHP allows us to expand the scope to link to other variales in other files 
    $query = "INSERT INTO Filterable_characteristics VALUES (:recipe_id, :set_id, :cuisine, :servings, :total_time)"; // Minimizes the chance of being attacked 
    // If you use double quotes, you can use both strings and variables 
    // SQL injection will all be compiled - all the bad code and good code will impact DB 
        // To minimize the chance of being attacked, use a prepare statement 
    // Make DBMS compile these template variables --> only compile once 
    try {
    $statement = $db->prepare($query); //prepare function is part of PDO 
    // Get this query and compile; once it compiles, prepare function will return an 
        // executable version of the query 
    $statement->bindValue(':recipe_id', $recipe_id); 
    $statement->bindValue(':set_id', $recipe_id); 
    $statement->bindValue(':cuisine', $cuisine);
    $statement->bindValue(':servings', $servings); 
    $statement->bindValue(':total_time', $total_time);
    //$statement->bindValue(':year', $year); // Fill in the blank with the real value 
    $statement->execute(); // Tell DBMS to actually run 
    $statement->closeCursor(); // We executed the query so release it so other users can make use of that instance
    }
    catch (PDOException $e)
    {
        if ($statement->rowCount() == 0)
            echo "Failed to add a filterable characteristic <br/"; 
    }
    catch (Exception $e)
    {
        echo $e->getMessage(); 
    }
}


function getAllRecipes()
{
    global $db; 
    $query = "SELECT * FROM Recipe";
    $statement = $db->prepare($query); 
    $statement->execute(); 
    $result = $statement->fetchAll(); 
    // fetchAll fetches all the rows that you got as a result of running the query 
    // fetch() only retrieves 1 row 
    $statement->closeCursor(); 
    return $result; 
}

function getAllRecipeIngredients()
{
    global $db; 
    $query = "SELECT * FROM Recipe_ingredients";
    $statement = $db->prepare($query); 
    $statement->execute(); 
    $result = $statement->fetchAll(); 
    // fetchAll fetches all the rows that you got as a result of running the query 
    // fetch() only retrieves 1 row 
    $statement->closeCursor(); 
    return $result; 
}

function addRecipeType($recipe_id, $type, $recipeType){
    global $db; 
    if ($type == 'Drink'){
        $query = "INSERT INTO Drink VALUES (:recipe_id, :recipeType)";
    }
    else if ($type == 'Appetizer'){
        $query = "INSERT INTO Appetizer VALUES (:recipe_id, :recipeType)";
    }
    else if ($type == 'Entree'){
        $query = "INSERT INTO Entree VALUES (:recipe_id, :recipeType)";
    }
    else if ($type == 'Dessert'){
        $query = "INSERT INTO Dessert VALUES (:recipe_id, :recipeType)";
    }

    try {
        $statement = $db->prepare($query); 
        $statement->bindValue(':recipe_id', $recipe_id); 
        $statement->bindValue(':recipeType', $recipeType); 
        $statement->execute(); // Tell DBMS to actually run 
        $statement->closeCursor(); // We executed the query so release it so other users can make use of that instance
        }
        catch (PDOException $e)
        {
            if ($statement->rowCount() == 0)
                echo "Failed to add recipe type <br/"; 
        }
        catch (Exception $e)
        {
            echo $e->getMessage(); 
        }


}





?>
