<?php
require("connect-db.php");
require("recipe-db.php");
require("redirect.php");

$list_of_recipes = getAllRecipes();
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
      addRecipe($_POST['recipe_id'], $_POST['recipe_name'], $_POST['instructions']); // 3 input boxes; first is name, then major, then year 
      addFilterableCharacteristics($_POST['recipe_id'], $_POST['cuisine'], $_POST['servings'], $_POST['total_time']);  
      // Grabbing the inforamtion that we want to save 
      
      addRecipeIngredients($_POST['recipe_id'], $_POST['ingredients']);

        // Grabbing the inforamtion that we want to save 
        // Won't add anything yet because we haven't written any SQL 
      //$list_of_recipes = getAllRecipes(); // Once you add the new recipe, retrieve the table again 
        // to display all the recipes plus the newly submitted one 

      // For the selecting recipe type -- first making sure the value is selected in the select box 


      if(!isset($_POST['type'])) 
        {
        $errorMessage = "<li>You forgot to select your recipe type!</li>";
        }
        else {
          addRecipeType($_POST['recipe_id'], $_POST['type'], $_POST['recipeType']);
        }
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
  <nav class="navbar navbar-light bg-light justify-content-between">
    <a class="navbar-brand" href="#">
      <img src="assets/DinterestLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Dinterest
    </a>
    <!-- <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form> -->
  </nav>


  <div>
    <input type="submit" value="login" name="btnAction" class="btn btn-dark" href='".$client->createAuthUrl()."'
        title="Login with Google" /> 
   </div>
<!-- TOOD: link button to login -->

</body>

</html>

