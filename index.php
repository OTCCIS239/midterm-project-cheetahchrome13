<?php

// Dependencies/Whoops/Read .env
require_once('./includes/init.php');

// Connect to the database 
require_once('./includes/db.php');

// this page
$current = "home";
$title = "Guitars- home";

// get all categories
$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement1 = $conn->prepare($queryAllCategories);
$statement1->execute();
$categories = $statement1->fetchAll();
$statement1->closeCursor();

//var_dump($categories);
?>

                   
                    <?php include("./includes/header_nav.php") ?>
                    <!-- Unique page content here -->
                    <?php include("./includes/footer.html") ?>
               
