<?php

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="author" content="Laurenn Lee(ll5edw), Nathan Park(ngp7ce), Gloria Sun(gs3tvs), Michael Yang(my6jdq)">
    <meta name="description" content="Dinterest is a Recipe Website written for UVA's CS4750 Database Systems course.">

    <title>Dinterest</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />


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

    <!-- Retrieve Recipes -->
    <hr /> <!-- Horizontal -->
    <h3> List of Recipes</h3>
    <div class="row justify-content-center">
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
            <thead>
                <!-- For the table set up the header -->
                <tr style="background-color:#B0B0B0">
                    <th width="30%"><b>Recipe_id</b></th>
                    <th width="30%"><b>Name</b></th>
                    <th width="30%"><b>Instructions</b></th>
                    <th><b>Update?</b></th>
                    <th><b>Delete?</b></th>
                </tr>
            </thead>
            
                <tr>
                    <td><?php echo $_POST['recipe_id']; ?></td>
                    <td><?php echo $_POST['recipe_name']; ?>
                    </td>
                    <td><?php echo $_POST['recipe_instructions']; ?></td>
                    <td>
                        <form action="add-recipe.php" method="post">
                            <!-- As soon as the button is clicked, send a request to simpleform.php so it can update -->
                            <input type="submit" value="Update" name="btnAction" class="btn btn-primary" title="Click to update this recipe" /> <!-- title attribute will display when mouse hovers over it -->
                            <input type="hidden" name="recipe_to_update" value="<?php echo $recipe_info['recipe_name']; ?>" />
                            <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen -->
                        </form>
                    </td>
                    <!-- DELETE BUTTON -->
                    <td>
                        <form action="add-recipe.php" method="post">
                            <!-- As soon as the button is clicked, send a request to simpleform.php so it can update -->
                            <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" title="Click to delete this recipe" /> <!-- title attribute will display when mouse hovers over it -->
                            <input type="hidden" name="recipe_to_delete" value="<?php echo $recipe_info['recipe_name']; ?>" />
                            <!-- hidden input is submitted when the form is submitted, but it's not shown on the screen -->
                        </form>
                    </td>
                </tr>
        </table>
    </div>


</body>

</html>