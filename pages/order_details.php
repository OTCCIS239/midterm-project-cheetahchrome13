<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database
require_once('../includes/db.php');

// get category ID
$order_ID = filter_input(INPUT_GET, 'order_ID', FILTER_VALIDATE_INT);
if ($order_ID == NULL || $order_ID == FALSE) {
    $order_ID = 1;
}

// This page
$current = "orderDetails";
$title = "Guitars- order details";

// Get all the details of one order from 3 tables
$details = getMany("SELECT * FROM `orders`
                JOIN `customers` ON `orders`.`customerID` = `customers`.`customerID`
                JOIN `orderItems` ON `orders`.`orderID` = `orderItems`.`orderID`
                JOIN `products` ON `orderItems`.`productID` = `products`.`productID`
                JOIN `addresses` ON `customers`.`billingAddressID` = `addresses`.`addressID`
                WHERE `orders`.`orderID` = $order_ID", [], $conn);


// // Variables for calculation purposes ***These throw a Whoops exception (undefined index)
// $item_price = $details['itemPrice'];
// $item_price_f = "$".number_format($item_price, 2);
// $discount_amount = $details['discountAmount'];
// $discount_amount_f = "$".number_format($discount_amount, 2);
// $tax_amount = $details['taxAmount'];
// $tax_amount_f = "$".number_format($tax_amount, 2);
// $shipping_amount = $details['shippingAmount'];
// $shipping_amount_f = "$".number_format($shipping_amount, 2);


var_dump($details);
var_dump($order_ID);
?>


                    <?php include("../includes/header_nav.php") ?>
                    <!-- Unique page content here -->
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-sm"></div>
                <div class="col-sm-6">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center font-weight-bold text-white bg-info mb-3">
                            Order Details
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


               