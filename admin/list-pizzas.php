<?php 
     include('../includes/session.php');
?>
<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza List - GrandmasPizza Admin</title>

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
                        <li><a href="list-ingredients.php">Ingredients</a></li>
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

        
        <h2>Pizzas</h2>

        <?php

        if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['p_id'])) {
            $pizza = $session->getPizza($_GET['p_id']);

            if (isset($_GET['confirmed']) && $_GET['confirmed'] === 'true') {
                $result = $session->deletePizza($_GET['p_id']);
                
                echo $result; // TODO styling for error/success
            } else {
                // ask for confirmation
                ?>
                <p>Are you sure you want to delete <?= $pizza['p_name'] ?>?</p>
                <p>
                    <a href="list-pizzas.php?action=delete&p_id=<?= $pizza['p_id'] ?>&confirmed=true">Yes</a> - 
                    <a href="list-pizzas.php">No</a>
                </p>
                <?php
            }
        }

        ?>


        <ul class="items-list clearfix">
            <?php
            $pizzas = $session->getPizzas();
                        
            foreach ($pizzas as $pizza):
            ?>
                <li>
                    <h3><?= $pizza['p_name'] ?></h3>

                    <div class="actions">
                        <a class="button icon delete" href="list-pizzas.php?action=delete&p_id=<?= $pizza['p_id'] ?>">Delete</a>
                        <a class="button icon edit" href="edit-pizza.php?p_id=<?= $pizza['p_id'] ?>">Edit</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>


        <p>
            <a class="button add" href="add-pizza.php">Add New Pizza</a>
        </p>


    </div><!-- /.page-body -->


</body>
</html>

