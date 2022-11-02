<?php
function addFriend($name, $major, $year) // Need to pass this in the right order (depends on POST in simpleform.php) 
{
    global $db; // Keep using one connection to save space and prevent suspension (this is similar to memory leak)
    // $db is the variable name of the PDO instance that we made in connect-db.php
    // global in PHP allows us to expand the scope to link to other variales in other files 
    $query = "INSERT INTO friends VALUES (:name, :major, :year)"; // Minimizes the chance of being attacked 
    // If you use double quotes, you can use both strings and variables 
    // SQL injection will all be compiled - all the bad code and good code will impact DB 
        // To minimize the chance of being attacked, use a prepare statement 
    // Make DBMS compile these template variables --> only compile once 
    try {
    $statement = $db->prepare($query); //prepare function is part of PDO 
    // Get this query and compile; once it compiles, prepare function will return an 
        // executable version of the query 
    $statement->bindValue(':name', $name); 
    $statement->bindValue(':major', $major);
    $statement->bindValue(':year', $year); // Fill in the blank with the real value 
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

function getAllFriends()
{
    global $db; 
    $query = "SELECT * FROM friends";
    $statement = $db->prepare($query); 
    $statement->execute(); 
    $result = $statement->fetchAll(); 
    // fetchAll fetches all the rows that you got as a result of running the query 
    // fetch() only retrieves 1 row 
    $statement->closeCursor(); 
    return $result; 
}

function getFriendBYName($name)
{
    global $db; 
    $query = "SELECT * FROM friends WHERE name = :name";
    $statement = $db->prepare($query); 
    $statement->bindValue(":name", $name); 
    $statement->execute(); 
    $result = $statement->fetch(); 
    // fetchAll fetches all the rows that you got as a result of running the query 
    // fetch() only retrieves 1 row 
    $statement->closeCursor(); 
    return $result; 
}

function updateFriend($name, $major, $year)
{
    // Get instance of PDO to interact with database 
    // Use prepare statement 
        // 1) Prepare 
        // 2) bindValue, execute 
    global $db; 
    $query = "UPDATE friends SET major=:major, year=:year WHERE name=:name"; 
    // Can't update primary keys - can't update name 
    $statement = $db->prepare($query); 
    $statement->bindValue(":name", $name);
    $statement->bindValue(":major", $major); 
    $statement->bindValue(":year", $year);
    $statement->execute(); 
    $statement->closeCursor(); 
}

function deleteFriend($name)
{
    global $db; 
    $query = "DELETE FROM friends WHERE name=:name";
    $statement = $db->prepare($query); // Call a prepare statement so 
    // it can create an executable version 
    $statement->bindValue(":name", $name); 
    $statement->execute(); 
    $statement->closeCursor(); 
}
?>