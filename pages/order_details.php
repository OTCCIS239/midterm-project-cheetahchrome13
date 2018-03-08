<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database
require_once('../includes/db.php');

// get catagory ID***CHANGE PARAMS
$order_ID = filter_input(INPUT_GET, 'order_ID', FILTER_VALIDATE_INT);
if ($order_ID == NULL || $order_ID == FALSE) {
    $order_ID = 1;
}

// This page
$current = "orderDetails";
$title = "Guitars- order details";

// get all products
$orderItems = getMany("SELECT * FROM `orderItems` JOIN `products` ON `orderItems`.`productID` = `products`.`productID` WHERE `orderItems`.`orderID` = $order_ID", [], $conn);
$details = getMany("SELECT * FROM `orders` JOIN `orderItems` ON `orders`.`orderID` = `orderItems`.`orderID` WHERE `order`.`orderID` = $order_ID", [], $conn);
$customer = getOne("SELECT * FROM `orders` JOIN `customers` ON `orders`.`customerID` = `customers`.`customerID` WHERE `order`.`orderID` = $order_ID", [], $conn);

$customer_ID = $customer['customerID'];

$address = getOne("SELECT * FROM `customers` JOIN `addresses` ON `customers`.`customerID` = `addresses`.`customerID` AND `customer`.`billingAddressID` = `addresses`.`addressID` WHERE `customer`.`customerID` = $customer_ID", [], $conn);

// $item_price = $details['itemPrice'];
// $item_price_f = "$".number_format($item_price, 2);
// $discount_amount = $details['discountAmount'];
// $discount_amount_f = "$".number_format($discount_amount, 2);
// $tax_amount = $details['taxAmount'];
// $tax_amount_f = "$".number_format($tax_amount, 2);
// $shipping_amount = $details['shippingAmount'];
// $shipping_amount_f = "$".number_format($shipping_amount, 2);



//$billing_address = $address['addressID'];

// $queryAllUnshipped = 'SELECT * FROM orders WHERE shipDate is null ORDER BY orderID';
// $statement1 = $conn->prepare($queryAllUnshipped);
// $statement1->execute();
// $unshipped = $statement1->fetchAll();
// $statement1->closeCursor();

var_dump($orderItems);
?>


                    <?php include("../includes/header_nav.php") ?>
                    <!-- Unique page content here -->
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-sm"></div>
                <div class="col-sm-6">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center font-weight-bold text-white bg-info mb-3">
                            Discount Calculator
                        </div>
                        <div class="card-body">
                            
                            <div class="text-center">
                                <a href="/" class="btn btn-info">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
                    <?php include("../includes/footer.html") ?>


               