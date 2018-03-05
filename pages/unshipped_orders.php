<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database
require_once('../includes/db.php');

// This page
$current = "unshipped";
$title = "Guitars- unshipped orders";

// get all products
$queryAllUnshipped = 'SELECT * FROM orders WHERE shipDate is null ORDER BY orderID ';
$statement1 = $conn->prepare($queryAllUnshipped);
$statement1->execute();
$unshipped = $statement1->fetchAll();
$statement1->closeCursor();

//var_dump($unshipped);
?>


                    <?php include("../includes/header_nav.php") ?>
                    <!-- Unique page content here -->
                    <?php include("../includes/footer.html") ?>