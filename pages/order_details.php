<?php

// Dependencies/Whoops/Read .env
require_once('../includes/init.php');

// Connect to the database
require_once('../includes/db.php');

// get order ID from anchor click
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
                JOIN `categories` ON `products`.`categoryID` = `categories`.`categoryID`
                JOIN `addresses` ON `customers`.`billingAddressID` = `addresses`.`addressID`
                WHERE `orders`.`orderID` = $order_ID", [], $conn);

//$details = json_decode(json_encode($order_details),true);

//Variables for calculation purposes ***These throw a Whoops exception (undefined index)
$list_price1 = $details[0]['listPrice'];
$list_price1_f = "$".number_format($list_price1, 2);
$discount_percent1 = $details[0]['discountPercent'];
$discount_percent1_f = number_format($discount_percent1, 0)."%";
$discount_price1 = $list_price1 - ($list_price1 * $discount_percent1 / 100);
$discount_price1_f = "$".number_format($discount_price1, 2);
$tax_amount = $details[0]['taxAmount'];
$tax_amount_f = "$".number_format($tax_amount, 2);
$ship_amount = $details[0]['shipAmount'];
$ship_amount_f = "$".number_format($ship_amount, 2);
$ship_date1 = $details[0]['shipDate'];
$quantity1 = $details[0]['quantity'];
$total1 = ($quantity1 * $discount_price1) + $tax_amount + $ship_amount;
$total1_f = "$".number_format($total1, 2);

// This is a temporary band-aid. Gotta find a way to test for multidiminsional array length. 
// A for loop that creates all these variables based on the amount of inner arrays maybe?
if($order_ID == 3){
    $list_price2 = $details[1]['listPrice'];
    $list_price2_f = "$".number_format($list_price2, 2);
    $discount_percent2 = $details[1]['discountPercent'];
    $discount_percent2_f = number_format($discount_percent2, 0)."%";
    $discount_price2 = $list_price2 - ($list_price2 * $discount_percent2 / 100);
    $discount_price2_f = "$".number_format($discount_price2, 2);
    $ship_date2 = $details[1]['shipDate'];
    $quantity2 = $details[0]['quantity'];
    $total2 = ($quantity2 * $discount_price2);  
}

// var_dump($details);
?>

                    <?php include("../includes/header_nav.php") ?>
                    <!-- Unique page content here -->
            <div class="row align-items-center" style="height: 100%;">
                <div class="col-sm"></div>
                <div class="col-sm-9">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header text-center font-weight-bold text-white bg-info mb-3">
                        <h2 class="text-center">Order Details</h2>
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-6">Order Date:</dt>
                                <dd class="col-6"><?= $details[0]['orderDate'] ?></dd>

                                <dt class="col-6">Ship Date</dt>
                                <dd class="col-6"><?= $ship_date1 == NULL ? "<a href='unshipped_orders.php' class='text-warning'>Unshipped</a>" : $ship_date1 ?></dd>

                                <dt class="col-6">CC Used:</dt>
                                <dd class="col-6"> Card# <?= $details[0]['cardNumber']." Card Type: ".$details[0]['cardType'] ?></dd>

                                <dt class="col-6">Billing Address:</dt>
                                <dd class="col-6"><?= $details[0]['firstName']." ".$details[0]['lastName']."<br>".$details[0]['line1']." ".$details[0]['city']." ".$details[0]['state']." ".$details[0]['zipCode'] ?></dd>

                                <hr>

                                <dt class="col-6 text-right">Order Item: </dt>
                                <dd class="col-6"><a href="product_details.php?product_ID=<?= $details[0]['productID'];?>"><?= $details[0]['productName'] ?></a></dd>

                                <dt class="col-6">Category:</dt>
                                <dd class="col-6"><?= $details[0]['categoryName'] ?></dd>
                                
                                <dt class="col-6">Item Quantity:</dt>
                                <dd class="col-6"><?= $details[0]['quantity'] ?></dd>
                                
                                <dt class="col-6">Item Price:</dt>
                                <dd class="col-6"><?= $list_price1_f ?></dd>

                                <dt class="col-6">Discount Price (<?= $discount_percent1_f." off!" ?>):</dt>
                                <dd class="col-6"><?= $discount_price1_f ?></dd>

                                <hr>

                                <?php if($order_ID == 3) : ?>
                                        <dt class="col-6 text-right">Order Item:</dt>
                                        <dd class="col-6"><a href="product_details.php?product_ID=<?= $details[1]['productID'];?>"><?= $details[1]["productName"] ?></a></dd>

                                        <dt class="col-6">Category:</dt>
                                        <dd class="col-6"><?= $details[1]['categoryName'] ?></dd>
                                        
                                        <dt class="col-6">Item Quantity:</dt>
                                        <dd class="col-6"><?= $details[1]["quantity"] ?></dd>
                                        
                                        <dt class="col-6">Item Price:</dt>
                                        <dd class="col-6"><?= $list_price2_f ?></dd>

                                        <dt class="col-6">Discount Price (<?= $discount_percent2_f." off!" ?>):</dt>
                                        <dd class="col-6"><?= $discount_price2_f ?></dd>
                                        <hr>
                                    <?php endif; ?>

                                <dt class="col-6">Order Tax Amount:</dt>
                                <dd class="col-6"><?= $tax_amount_f ?></dd>

                                <dt class="col-6">Order Shipping Amount:</dt>
                                <dd class="col-6"><?= $ship_amount_f ?></dd>

                                <dt class="col-6">Total Price:</dt>
                                <dd class="col-6"><?= $order_ID == 3 ? "$".number_format($total1 + $total2, 2) : $total1_f ?></dd>
                                </dl> 
                            <div class="text-center">
                                <a href="javascript:history.back()" class="btn btn-info">&#8678;Back to Previous Page</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm"></div>
            </div>
                    <?php include("../includes/footer.html") ?>


               