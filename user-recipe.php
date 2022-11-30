<style type="text/css">
    .recipe {
        border-bottom: 1px solid black;
    }
    
</style>

<?php
#require("style.css");
require("connect-db.php");
require("recipe-db.php");
require("base.php");
//require_once("config.php");

if (!isset($_SESSION['name'])) {    
    echo "Please log in to either view your recipes or add another";
} else {

$list_of_recipes = getUserRecipes($_SESSION['user']);
$recipe_to_update = null; 
$recipeingredients_to_update = null;
?> 

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') // standard object that keeps track of information of all requests that are coming in 
  // _SERVER is case sensitive, $ means variable 
  // REQUEST_METHOD keeps track of requests 
  // POST is checking that it's actually a POST method 
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Add') // if btnAction was clicked, it won't be empty and will have a value 
    // $_POST['btnAction] == 'Add' makes sure it's an actual Add value 
    {
      $recipe_id = $_POST['recipe_id'];
      $query = "SELECT * FROM Recipe WHERE recipe_id = '$recipe_id'";
      $statement = $db->prepare($query);
      $statement->execute();
      $result = $statement->fetch();
      $statement->closeCursor();

      if ($result) {
        echo "recipe_id already exists, choose a different one";
      } else {
        addRecipe($_POST['recipe_id'], $_POST['recipe_name'], $_POST['instructions']); // 3 input boxes; first is name, then major, then year 
        addFilterableCharacteristics($_POST['recipe_id'], $_POST['cuisine'], $_POST['servings'], $_POST['total_time']);  
        // Grabbing the inforamtion that we want to save 
      
        addRecipeIngredients($_POST['recipe_id'], $_POST['ingredients']);
        addRecipeType($_POST['recipe_id'], $_POST['type'], $_POST['recipeType']);
        addCreatedBy($_POST['recipe_id'], $_SESSION['user']);

        $list_of_recipes = getUserRecipes($_SESSION['user']);

          // Grabbing the inforamtion that we want to save 
          // Won't add anything yet because we haven't written any SQL 
        //$list_of_recipes = getAllRecipes(); // Once you add the new recipe, retrieve the table again 
          // to display all the recipes plus the newly submitted one 

        // For the selecting recipe type -- first making sure the value is selected in the select box
      }

       
      
    }

    

    // If you plan on having a lot of commands, separate SQL into a separate file 
    // else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Update')
    // {
    //   $recipe_to_update = getrecipeByName($_POST['recipe_to_update']); 
    // }
    // else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Confirm update') // Making sure there's actually something 
    // // to update 
    // {
    //   updaterecipe($_POST['recipe_name'], $_POST['major'], $_POST['year']);
    //   // Extract the information from the input boxes and pass it into the function
    //   $list_of_recipes = getAllRecipes(); // SELECT * from the table and display the info again
    // }
    else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'Delete') 
    {
      deleteRecipe($_POST['recipe_to_delete']);
      // Extract the information from the input boxes and pass it into the function
      $list_of_recipes = getUserRecipes($_SESSION['user']); // SELECT * from the table and display the info again
    }
}
?>
<!-- 1. create HTML5 doctype -->
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
  
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="author" content="Laurenn Lee(ll5edw), Nathan Park(ngp7ce), Gloria Sun(gs3tvs), Michael Yang(my6jdq)">
  <meta name="description" content="Dinterest is a Recipe Website written for UVA's CS4750 Database Systems course.">  
    
  <title>Dinterest</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  --> 
</head>

<body>
  <!-- Nav Bar -->
  <!-- <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="add-recipe.php">
      <img src="assets/DinterestLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Dinterest
    </a>
    <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  </nav> -->
<h2>
    <?php echo"Hi {$_SESSION['name']}"?>
</h2>

  <!-- Add Recipe -->
  <div class="container">
    <br>
  <h2>Add Recipe</h2>  


<form name="mainForm" method = "post"> <!-- form tag tells the boundaries of where the form starts and ends -->
<!-- Give a name so you can refer to the form later if needed 
action attribute: Grab the form data and send it somewhere; in this case, to ourselves (simpleform.php)
method: Allows yout to specify how the form data should be packaged
    Most commonly used are post and get 
        post: As soon as the form is submitted, form data is encapsulated / packaged and sent to the server, and server passes it to the action target 
        get: As soon as the form is submitted, form data is attached to URL as a parameter value; if you're going to do something confidential, don't use get -->

<div class="row mb-3 mx-3"> 
    Recipe ID: 
    <input type="number" class="form-control" name="recipe_id" required 
    value="<?php if ($recipe_to_update
  != null) echo $recipe_to_update
  ['recipe_id'] ?>"
    />
</div>

  <div class="row mb-3 mx-3"> <!-- This helps with formatting -->
    Recipe name: <!-- label on the screen -->
    <input type="text" class="form-control" name="recipe_name" required 
      value="<?php if ($recipe_to_update
    != null) echo $recipe_to_update
    ['recipe_name'] ?>"
    />  
    <!-- 
    name = "name": Give the name some name so you can refer to it later 
    required is an attribute of html that forces the user to enter information 
    If the user tries to submit a form without entering in this box, the browser will enforce this requirement 
-->
  </div>  

  <div class="row mb-3 mx-3"> 
    Ingredients: 
    <input type="text" class="form-control" name="ingredients" required
    value="<?php if ($recipeingredients_to_update
  != null) echo $recipeingredients_to_update
  ['ingredients'] ?>"
    />
</div>

  <div class="row mb-3 mx-3"> 
    Instructions: 
    <input type="text" class="form-control" name="instructions" required 
    value="<?php if ($recipe_to_update
  != null) echo $recipe_to_update
  ['instructions'] ?>"
    />
</div>

<div class="row mb-3 mx-3"> 
    Cuisine: 
    <input type="text" class="form-control" name="cuisine" required 
    value="<?php if ($recipe_to_update
   != null) echo $recipe_to_update
  ['cuisine'] ?>"
    />
</div>

<div class="row mb-3 mx-3"> 
    Servings: 
    <input type="number" class="form-control" name="servings" required 
    value="<?php if ($recipe_to_update
   != null) echo $recipe_to_update
  ['servings'] ?>"
    />
</div>

<div class="row mb-3 mx-3"> 
    Total time: 
    <input type="text" class="form-control" name="total_time" required 
    value="<?php if ($recipe_to_update
   != null) echo $recipe_to_update
  ['total_time'] ?>"
    />
</div>

<!-- Select the type of recipe it is so we know which database it needs to go into -->
<div class="row mb-3 mx-3"> 
  Select Recipe Category: 
<select name = "type" required> 
  <option value = "">Select...</option>
  <option value = "Drink">Drink</option> 
  <option value = "Appetizer">Appetizer</option>
  <option value = "Entree">Entree</option>
  <option value = "Dessert">Dessert</option>
</select>
</div>

<!-- Write the type of recipe it is --> 
<div class = "row mb-3 mx-3"> 
  Type of Recipe: 
  <input type="text" class="form-control" name="recipeType" required
  value="<?php if ($recipe_to_update
  != null) echo $recipe_to_update
  ['recipeType'] ?>"
  />
</div>



  <div>
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark"
        title="Insert a recipe into a recipe table" /> <!-- Create a submit button 
    value is used as the text that appears on the button 
    class is using a btn bootstrap
    btn-dark: Display it like a button but make it dark
    title: Allows you to pass in some string to be used as a hint - can be used for accessibility -->
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary"
        title="Update this recipe" /> <!-- Create a submit button --> 
</div>
    
</form>

</div>

<hr/><br><br> <!-- Horizontal --> 
<!-- Search function -->
<div class="text-center">
<form method="post" action="user-recipe.php">
  <input type="text" name="search" placeholder="Look up recipes by name" required/>
  <input type="submit" value="Search"/>
</form>
</div>



<?php
    // (B) PROCESS SEARCH WHEN FORM SUBMITTED
    if (isset($_POST["search"])) {
      // (B1) SEARCH FOR USERS
      require "search_byuser.php";
?>
    <h3> My Recipes</h3>
    <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
    <thead> <!-- For the table set up the header --> 
    <tr style="background-color:#B0B0B0">
        <th width="30%"><b>Recipe_id</b></th>       
        <th width="30%"><b>Name</b></th>      
        <th width="30%"><b>Instructions</b></th>  
        <th><b>Update?</b></th>
        <th><b>Delete?</b></th>
    </tr>
    </thead>
<?php
      // (B2) DISPLAY RESULTS
      if (count($results) > 0) { 

        // printf("<div>%s - %s</div>", $r["recipe_name"]);
        
        // printf($r["recipe_name"]);
        foreach ($results as $recipe_info) { ?>
        <tr class="recipe">
          <td><?php echo $recipe_info['recipe_id']; ?></td>
          <td><?php echo $recipe_info['recipe_name']; ?></td>        
    <td><?php echo $recipe_info['instructions']; ?></td>  
    <td>
      <form action="user-recipe.php" method="post">
    <!-- As soon as the button is clicked, send a request to simpleform.php so it can update --> 
      <input type="submit" value="Update" name="btnAction" class="btn btn-primary"
        title="Click to update this recipe" /> <!-- title attribute will display when mouse hovers over it -->
      <input type="hidden" name="recipe_to_update" 
        value="<?php echo $recipe_info['recipe_id']; ?>"
      />
      <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen --> 
    </form>
  </td> 
  <!-- DELETE BUTTON --> 
  <td><form action="user-recipe.php" method="post">
    <!-- As soon as the button is clicked, send a request to simpleform.php so it can update --> 
      <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" 
        title="Click to delete this recipe" /> <!-- title attribute will display when mouse hovers over it -->
      <input type="hidden" name="recipe_to_delete" 
        value="<?php echo $recipe_info['recipe_id']; ?>" 
      />
      <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen --> 
    </form></td>              
        </tr>

        <?php }

    } else { ?>

      <p>No results found.<br></p>
      </table>

    </div>
    
    <?php
    }
    unset($_POST["search"]);
    } else { ?>

<h3> My Recipes</h3> 
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead> <!-- For the table set up the header --> 
  <tr style="background-color:#B0B0B0">
    <th width="30%"><b>Recipe_id</b></th>       
    <th width="30%"><b>Name</b></th>      
    <th width="30%"><b>Instructions</b></th>
    <th><b>Update?</b></th>
    <th><b>Delete?</b></th>
  </tr>
  </thead>

<?php foreach ($list_of_recipes as $recipe_info): ?> <!-- Call each row as recipe_info -->
  <tr class="recipe"> 
    <td><?php echo $recipe_info['recipe_id']; ?></td>
    <td><?php echo $recipe_info['recipe_name']; ?></td>        
    <td><?php echo $recipe_info['instructions']; ?></td>  
    <td>
      <form action="user-recipe.php" method="post">
    <!-- As soon as the button is clicked, send a request to simpleform.php so it can update  -->
      <input type="submit" value="Update" name="btnAction" class="btn btn-primary"
        title="Click to update this recipe" /> <!-- title attribute will display when mouse hovers over it -->
      <input type="hidden" name="recipe_to_update" 
        value="<?php echo $recipe_info['recipe_id']; ?>"
      />
      <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen  -->
      </form>
  </td> 
  <!-- DELETE BUTTON  -->
  <td><form action="user-recipe.php" method="post">
    <!-- As soon as the button is clicked, send a request to simpleform.php so it can update  -->
      <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" 
        title="Click to delete this recipe" /> <!--title attribute will display when mouse hovers over it -->
      <input type="hidden" name="recipe_to_delete" 
        value="<?php echo $recipe_info['recipe_id']; ?>" 
      />
      <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen  -->
    </form></td>              
  </tr>
<?php endforeach; ?>
</table>
</div>
    <?php
    }
?>



  
<br>
<br>
    <!-- <?php echo "Hello World @^_^@"; ?> -->
</body>

</html>

<?php } ?>




<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html> -->