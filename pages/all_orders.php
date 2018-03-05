<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database 
require_once('../includes/db.php');

// This page
$current = "orders";
$title = "Guitars- all orders";

// get all products
$queryAllOrders = 'SELECT * FROM orders ORDER BY orderID';
$statement1 = $conn->prepare($queryAllOrders);
$statement1->execute();
$orders = $statement1->fetchAll();
$statement1->closeCursor();

//var_dump($orders);
?>


                    <?php include("../includes/header_nav.php") ?>
                    <!-- Unique page content here -->
                    <?php include("../includes/footer.html") ?>
            