<?php
require("connect-db.php");
require("recipe-db.php");

$recipe_to_update = null; 
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
  
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
    
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
    <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
  </nav>


  <!-- Add Recipe -->
  <div class="container">
  <h1>Add Recipe</h1>  

<form name="mainForm" method = "post"> <!-- form tag tells the boundaries of where the form starts and ends -->
<!-- Give a name so you can refer to the form later if needed 
action attribute: Grab the form data and send it somewhere; in this case, to ourselves (simpleform.php)
method: Allows yout to specify how the form data should be packaged
    Most commonly used are post and get 
        post: As soon as the form is submitted, form data is encapsulated / packaged and sent to the server, and server passes it to the action target 
        get: As soon as the form is submitted, form data is attached to URL as a parameter value; if you're going to do something confidential, don't use get -->
  <div class="row mb-3 mx-3"> <!-- This helps with formatting -->
    Recipe name: <!-- label on the screen -->
    <input type="text" class="form-control" name="name" required 
      value="<?php if ($recipe_to_update
     != null) echo $recipe_to_update
    ['name'] ?>"
    />  
    <!-- 
    name = "name": Give the name some name so you can refer to it later 
    required is an attribute of html that forces the user to enter information 
    If the user tries to submit a form without entering in this box, the browser will enforce this requirement 
-->
  </div>  
  <div class="row mb-3 mx-3"> 
    Major: 
    <input type="text" class="form-control" name="major" required 
    value="<?php if ($recipe_to_update
   != null) echo $recipe_to_update
  ['major'] ?>"
    />
</div>
<div class="row mb-3 mx-3">
    Year: 
    <input type="number" max="4" min="1" class="form-control" name="year" required 
    value="<?php if ($recipe_to_update
   != null) echo $recipe_to_update
  ['year'] ?>"
    /> <!-- type="number": Browser will enforce the type input to be number --> 
    <!-- max and min -->
</div>

  <div>
    <input type="submit" value="Add" name="btnAction" class="btn btn-dark"
        title="Insert a friend into a friend table" /> <!-- Create a submit button 
    value is used as the text that appears on the button 
    class is using a btn bootstrap
    btn-dark: Display it like a button but make it dark
    title: Allows you to pass in some string to be used as a hint - can be used for accessibility -->
    <input type="submit" value="Confirm update" name="btnAction" class="btn btn-primary"
        title="Update this friend" /> <!-- Create a submit button --> 
</div>
    
</form>

    <!-- <?php echo "Hello World @^_^@"; ?> -->
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