<style>
    nav {
    padding-left: 10px;
    padding-right: 10px;
    border-bottom: 2px solid #000;
    }
</style>


<?php
require_once("config.php");
?>


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
  <nav class="navbar navbar-light bg-light navbar-expand-sm justify-content-between">
    <a class="navbar-brand" href="recipe.php">
      <img src="assets/DinterestLogo.png" width="30" height="30" class="d-inline-block align-top" alt="">
      Dinterest
    </a>
    <ul class="navbar-nav">
        <li class="nav-item-active">
            <a class="nav-link" href="recipe.php">All Recipes</a>
        </li>
        <li class="nav-item-active">
            <a class="nav-link" href="user-recipe.php">My Recipes</a>
        </li>
        <li class="nav-item-active" style="padding-left:100px">
            <a class="nav-link" href="entree.php">Entrees</a>
        </li>
        <li class="nav-item-active">
            <a class="nav-link" href="appetizer.php">Appetizers</a>
        </li>
        <li class="nav-item-active">
            <a class="nav-link" href="drink.php">Drinks</a>
        </li>
        <li class="nav-item-active">
            <a class="nav-link" href="dessert.php">Desserts</a>
        </li>
    </ul>
    <!-- <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Look for recipes" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
    <?php
        if (isset($_SESSION['user'])) { ?>
            <a href="logout.php">
                <button title="logout" class="btn btn-danger my-2 my-sm-0" type="button">Logout</button>
            </a>
    <?php    
        } else { ?>
            <a href="redirect.php">
                <button title="login with Google" class="btn btn-primary my-2 my-sm-0" type="button">Login</button>
            </a>
    <?php
        }   
    ?>
    <!-- <a href="redirect.php">
        <button title="login with Google" class="btn btn-primary my-2 my-sm-0" type="button">Login</button>
    </a> -->
  </nav>
  </body>