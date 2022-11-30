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
    $statement->bindValue(':recipe_name', $recipe_name); 
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

function addUser($username, $name) {
    global $db;
    $query = "SELECT * FROM User WHERE username = '$username'";
    $statement = $db->prepare($query);
    $statement->execute();
    $result = $statement->fetch();
    $statement->closeCursor();
    if ($result) {
        header('Location: add-recipe.php');
    } else {
        $query = "INSERT INTO User VALUES (:username, :name)";

        try {
            $statement = $db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':name', $name);
            $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            if ($statement->rowCount() == 0)
                echo "Failed to add user <br/"; 
        } catch (Exception $e) {
            echo $e->getMessage(); 
        }
    }


}

function getRecipeType($recipe_id){
    global $db; 
    try{
        $query1 = "SELECT * FROM Drink dk WHERE dk.recipe_id = :recipe_id";
        $statement1 = $db->prepare($query1);
        $statement1->bindValue(':recipe_id', $recipe_id);
        $statement1->execute();
        $result1 = $statement1->fetch();
        $statement1->closeCursor();

    } catch (Exception $e) {
        echo "problem in result1";
    }
    
    try{
        $query2 = "SELECT * FROM Appetizer a WHERE a.recipe_id = :recipe_id";
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':recipe_id', $recipe_id);
        $statement2->execute();
        $result2 = $statement2->fetch();
        $statement2->closeCursor();

    } catch (Exception $e) {
        echo "problem in result2";
    }

    try{
        $query3 = "SELECT * FROM Entree e WHERE e.recipe_id = :recipe_id";
        $statement3 = $db->prepare($query3);
        $statement3->bindValue(':recipe_id', $recipe_id);
        $statement3->execute();
        $result3 = $statement3->fetch();
        $statement3->closeCursor();

    } catch (Exception $e) {
        echo "problem in result3";
    }

    try{
        $query4 = "SELECT * FROM Dessert dt WHERE dt.recipe_id = :recipe_id";
        $statement4 = $db->prepare($query4);
        $statement4->bindValue(':recipe_id', $recipe_id);
        $statement4->execute();
        $result4 = $statement4->fetch();
        $statement4->closeCursor();

    } catch (Exception $e) {
        echo "problem in result4";
    }

    if($result1) {
        echo "Drink";
        return array("Drink", $result1);
    }
    else if($result2){
        echo "Appetizer";
        return array("Appetizer", $result2);
    }
    else if($result3){
        echo "Entree";
        return array("Entree", $result3);
    }
    else if($result4){
        echo "Dessert";
        return array("Dessert", $result4);
    } else {
        echo $result1;
        echo "Not found";
    }
    // else{
    //     return "something is wrong";
    // }

    // if ($type == 'Drink'){
    //     $query = "SELECT * FROM Drink";
    // }
    // else if ($type == 'Appetizer'){
    //     $query = "SELECT * FROM Appetizer";
    // }
    // else if ($type == 'Entree'){
    //     $query = "SELECT * FROM Entree";
    // }
    // else if ($type == 'Dessert'){
    //     $query = "SELECT * FROM Dessert";
    // }

    // $statement = $db->prepare($query); 
    // $statement->bindValue(':recipe_id', $recipe_id);  
    // $statement->execute(); // Tell DBMS to actually run 
    // $result = $statement->fetch();
    // $statement->closeCursor(); // We executed the query so release it so other users can make use of that instance

}

function getRecipeByID($recipe_id) {
    global $db;
    $query = "SELECT * FROM Recipe rp 
    INNER JOIN Recipe_ingredients ri ON rp.recipe_id = ri.recipe_id 
    INNER JOIN Filterable_characteristics fc ON rp.recipe_id = fc.recipe_id
    WHERE rp.recipe_id = :recipe_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':recipe_id', $recipe_id);
    $statement->execute();
    $result = $statement->fetch(); 
    $statement->closeCursor();    
    return $result;
}


function editRecipe($recipe_id, $recipe_name, $instructions, $ingredients, $cuisine, $servings, $total_time) {
    global $db;
    $query = "UPDATE Recipe SET recipe_name=:recipe_name, instructions=:instructions WHERE recipe_id=:recipe_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':recipe_name', $recipe_name);
        $statement->bindValue(':instructions', $instructions);
        $statement->execute();

        $statement->closeCursor();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "recipe not working";
    }

    $query = "UPDATE Recipe_ingredients SET ingredients=:ingredients WHERE recipe_id=:recipe_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':ingredients', $ingredients);
        $statement->execute();

        $statement->closeCursor();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "ingredients not working";
    }

    $query = "UPDATE Filterable_characteristics SET cuisine=:cuisine, servings=:servings, total_time=:total_time WHERE recipe_id=:recipe_id";
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':cuisine', $cuisine);
        $statement->bindValue(':servings', $servings);
        $statement->bindValue(':total_time', $total_time);
        $statement->execute();

        $statement->closeCursor();
    } catch (PDOException $e) {
        echo $e->getMessage();
        echo "char not working";
    }


    // $query = "SELECT * FROM Recipe NATURAL JOIN Recipe_ingredients";
   
}


// function getRecipe_ingredients($recipe_id) {
//     global $db;
//     $query = "SELECT * FROM Recipe_ingredients where recipe_id = :recipe_id";
//     $statement = $db->prepare($query);
//     $statement->bindValue(':recipe_id', $recipe_id);
//     $statement->execute();
//     $result = $statement->fetch(); 
//     $statement->closeCursor();    
//     return $result;

// }


?>
