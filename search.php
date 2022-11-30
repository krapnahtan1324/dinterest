<?php
require("connect-db.php");
// require("recipe-db.php");

// $link = mysqli_connect("35.236.223.136", "root", "Dinterestproject1234", "dinterest") or die($link);

// $list_of_recipes = getAllRecipes();
// $list_of_recipeingredients = getAllRecipeIngredients();
// $recipe_to_update = null;
// (A) DATABASE CONFIG - CHANGE TO YOUR OWN!
// define("DB_HOST", "localhost");
// define("DB_NAME", "test");
// define("DB_CHARSET", "utf8");
// define("DB_USER", "root");
// define("DB_PASSWORD", "");
 
// // (B) CONNECT TO DATABASE
// try {
//   $pdo = new PDO(
//     "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
//     DB_USER, DB_PASSWORD, [
//       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//     ]
//   );
// } catch (Exception $ex) { exit($ex->getMessage()); }

// (C) SEARCH

// function searchRecipe($recipe_name) {
global $db;
// $query = "SELECT * FROM Recipe WHERE recipe_name LIKE \"%" . $recipe_name . "%\"";
// NATURAL JOIN Recipe_ingredients NATURAL JOIN Filterable_characteristics
$query = "SELECT * 
FROM Recipe
WHERE recipe_name LIKE ?";
try {
    $statement = $db->prepare($query);
    $statement->execute(["%".$_POST["search"]."%"]);
    // $statement->execute();
    $results = $statement->fetchAll();
    if (isset($_POST["ajax"])) { echo json_encode($results); }
    $statement->closeCursor();
} catch (PDOException $e) {
    if ($statement->rowCount() == 0)
        echo "There are no recipes with the given search query."; 
}
catch (Exception $e) {
    echo $e->getMessage(); 
}
// }


// $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `name` LIKE ? OR `email` LIKE ?");
// $stmt->execute(["%".$_POST["search"]."%", "%".$_POST["search"]."%"]);
// $results = $stmt->fetchAll();
// if (isset($_POST["ajax"])) { echo json_encode($results); }

?>