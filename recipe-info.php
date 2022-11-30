<style>
h1 {
        text-decoration: underline;
    }
</style>

<?php
require("connect-db.php");
require("recipe-db.php");
require("base.php");


    #echo $_SESSION['recipe'];


    global $db; 

    $query = "SELECT * FROM Recipe NATURAL JOIN Recipe_ingredients NATURAL JOIN Filterable_characteristics 
        WHERE recipe_id = '".$_SESSION['recipe']."'";

    $statement = $db->prepare($query); 
    $statement->execute(); 
    $result = $statement->fetch(); 
    // fetchAll fetches all the rows that you got as a result of running the query 
    // fetch() only retrieves 1 row 
    $statement->closeCursor();
?>

<br><br>
<div style="padding-left: 10px;">
<h1><?php echo $result['recipe_name']?></h1>
<p><b>Cuisine:</b> <?php echo $result['cuisine'] ?></p>
<p><b>Servings:</b> <?php echo $result['servings'] ?></p>
<p><b>Total Time:</b> <?php echo $result['total_time'] ?></p><br>
<p><b>Ingredients:</b> <?php echo $result['ingredients'] ?></p>
<p><b>Instructions:</b> <?php echo $result['instructions'] ?></p>
<p><b>

</div>