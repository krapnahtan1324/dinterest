<style type="text/css">
    .showrecipe {
      padding-left: 10px;
      padding-right: 10px;
    }

    .recipe {
        border-bottom: 1px solid black;
    }
    
</style>


<?php

require("connect-db.php");
require("recipe-db.php");
require("base.php");


$list_of_recipes = getEntrees();
$recipe_to_update = null; 
$recipeingredients_to_update = null; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == 'More Info') {
    #echo $_POST['recipe_to_view'];
    $_SESSION['recipe'] = $_POST['recipe_to_view'];
    header('Location: recipe-info.php');
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

<br>
<div class="showrecipe">
<h3> Entrees</h3> 
<div class="row justify-content-center">  
<table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
  <thead> <!-- For the table set up the header --> 
  <tr style="background-color:#B0B0B0">
    <th width="10%"><b>Recipe_id</b></th>       
    <th width="20%"><b>Name</b></th>      
    <th width="30%"><b>Instructions</b></th>
    <th style="padding-left:40px" width="20%"><b>Entree Type</th>
    <th width="10%"></th>
  </tr>
  </thead>
<?php foreach ($list_of_recipes as $recipe_info): ?> <!-- Call each row as recipe_info -->
  <tr class="recipe"> 
    <td><?php echo $recipe_info['recipe_id']; ?></td>
    <td><?php echo $recipe_info['recipe_name']; ?></td>        
    <td><?php echo $recipe_info['instructions']; ?></td>
    <td style="padding-left:40px"><?php echo $recipe_info['entreeType']; ?></td>
    <td style="padding-left:20px;">
      <form action="entree.php" method="post">
      <input type="submit" value="More Info" name="btnAction" class="btn btn-info"
        title="Click to view more info" /> <!-- title attribute will display when mouse hovers over it -->
      <input type="hidden" name="recipe_to_view" 
        value="<?php echo $recipe_info['recipe_id']; ?>" />
      </form>
    </td>  
                  
  </tr>
<?php endforeach; ?>
</table>
</div>
</div>

<br><br>
</body>

</html>

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