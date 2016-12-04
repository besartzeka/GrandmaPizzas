<?PHP 
    include('../includes/session.php');
?>
<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Ingredients List - GrandmasPizza Admin</title>

    <link rel="stylesheet" type="text/css" href="ui/css/admin.css" />

</head>


<body>

    <div id="header" class="page-header">
        <a href="frontPage.php" class="logo-home">
            <img id="logo" src="../ui/images/logo.png" alt="Grandmas Pizza" />
        </a>
        
        <h1>Grandmas Pizza Administration</h1>

        <div class="navbar">
            <ul class="nav">
                <li class="right"><a href="../" target="_blank">View Live Site</a></li>
                <li class="active"><a href="list-pizzas.php">Pizzas</a>
                    <ul class="subnav">
                        <li><a href="list-categories.php">Categories</a></li>
                        <li class="active"><a href="list-ingredients.php">Ingredients</a></li>
                        <li><a href="list-sizes.php">Sizes</a></li>
                    </ul>
                </li>
                <li><a href="index.php?action=manageotherfood">Other Food</a></li>
                <li><a href="index.php?action=managedrinks">Drinks</a></li>
                <li><a href="imagelibrary.php?type=relprod">Image Library</a></li>
            </ul>
        </div>

    </div><!-- /.page-header -->


    <div class="page-body">

        
        <h2>Pizza Ingredients</h2>
        <?php

        if (isset($_POST['action']) && $_POST['action'] === 'addIngredient') {
            
            $ingredientName = $_POST['ingredient-name'];

            $result = $session->addIngredient($ingredientName);
            
            echo $result;
        }

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['i_name'])) {
            $ingredient = $session->getOneIngredient($_GET['i_name']);

            if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
                $result = $session->deleteIngredient($_GET['i_name']);
                
                echo $result; // TODO styling for error/success
            } else {
                // ask for confirmation
                ?>
                <p>Are you sure you want to delete <?= $ingredient['i_name'] ?>?</p>
                <p>
                    <a href="list-ingredients.php?action=delete&i_name=<?= $ingredient['i_name'] ?>&confirmed=true">Yes</a> - 
                    <a href="list-ingredients.php">No</a>
                </p>
                <?php
            }
        }

        ?>

        <ul class="items-list clearfix">
           <?php
            $ingredients = $session->getIngredients();
                       
            foreach ($ingredients as $ing):
            ?>
                <li>
                    <h3><?= $ing['i_name'] ?></h3>

                    <div class="actions">
                        <a class="button icon delete" href="list-ingredients.php?action=delete&i_name=<?= $ing['i_name'] ?>">Delete</a>
                        <a class="button icon edit" href="edit-ingredients.php?p_id=<?= $ing['i_name'] ?>">Edit</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>


        <form class="admin-form" method="post" action="../includes/process.php">
            <input type="hidden" name="action" value="doaddingredient" /><!-- you might not want this - I used it to specify what the next action would be after submitting the form -->

            <input type="text" id="ingredient-name" name="ingredient-name" />
            <button type="submit" class="button add" title="Add ingredient" value="addIngredient" name="action">Add new Pizza ingredient</button>
        </form>

    </div><!-- /.page-body -->


</body>
</html>

