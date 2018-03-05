<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database
require_once('../includes/db.php');

// This page
$current = "products";
$title = "Guitars- all products";

// Queries for pertinent tables
$categories = getMany("SELECT * FROM categories", [], $conn);
//$products = getMany("SELECT * FROM products", [], $conn);

//// get all products
// $queryAllProducts = 'SELECT * FROM products ORDER BY productID';
// $statement1 = $conn->prepare($queryAllProducts);
// $statement1->execute();
// $products = $statement1->fetchAll();
// $statement1->closeCursor();

//var_dump($products);
?>

                    <!-- Header/Nav -->
                    <?php include("../includes/header_nav.php") ?>

                    <!-- Unique page content here -->
                    <div class="row align-items-center" style="height: 100%;">
        <div class="col-sm"></div>
        <div class="col-sm-6">
            <div class="card text-white bg-dark mb-3">
                <div class="card-header text-center font-weight-bold text-white bg-info mb-3">
                    <h2>Products</h2>
                </div>
                <div class="card-body">
                    <div>
                    <?php foreach ($categories as $category) : ?>
                        <h5><?php echo $category['categoryName']; ?></h5>
                        <?php $currentCategory = $category['categoryID']; ?> 
                        <?php $currentID = getMany("SELECT * FROM  products WHERE categoryID = $currentCategory", [], $conn); ?>
                        <table class="table table-striped table-dark">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                            </tr>
                            <?php foreach ($currentID as $product) : ?>
                            <tr>
                                <td><a href="#"><?php echo $product['productName']; ?></a></td>
                                <td>$<?php echo $product['listPrice']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm"></div>
</div>
                    <!-- Footer -->
                    <?php include("../includes/footer.html") ?>