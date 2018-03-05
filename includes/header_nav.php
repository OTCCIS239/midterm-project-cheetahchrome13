<!--***Header/Nav****************************** -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href='<?php echo ($current == 'home') ? "./includes/main.css" : "../includes/main.css"; ?>'/>
</head>
    <body>
        <div class="container">
            <div class="text-center">
                <h1>Guitars</h1>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h4 class="navbar-brand">Categories</h4>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class='nav-item <?php if($current == 'home') {echo "current";} ?>'>
                            <a class="nav-link" href='<?php echo ($current == 'home') ? "index.php" : "/index.php"; ?>'>Home</a>
                        </li>
                        <li class='nav-item <?php if($current == 'orders') {echo "current";} ?>'>
                            <a class="nav-link" href='<?php echo ($current == 'home') ? "./pages/all_orders.php" : "all_orders.php"; ?>'>All Orders</a>
                        </li>
                        <li class='nav-item nav-item <?php if($current == 'unshipped') {echo "current";} ?>'>
                            <a class="nav-link" href='<?php echo ($current == 'home') ? "./pages/unshipped_orders.php" : "unshipped_orders.php"; ?>'>Unshipped Orders</a>
                        </li>
                        <li class='nav-item nav-item <?php if($current == 'products') {echo "current";} ?>'>
                            <a class="nav-link" href='<?php echo ($current == 'home') ? "./pages/all_products.php" : "all_products.php"; ?>'>Products</a>
                        </li>
                    </ul>
                </div>
            </nav>