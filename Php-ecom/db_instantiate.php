<?php

session_start();

require('database/controller.php');

require('database/Product.php');

require('database/Auth.php');

require('database/Cart.php');

require('database/ShipAddress.php');

require('database/BillingAddress.php');

require('database/Order.php');

$db = new DBController();

$product = new Product($db);

$auth = new Auth($db);

$cart = new Cart($db);

$shipAddress = new ShipAddress($db);

$billAddress = new BillingAddress($db);

$order = new Order($db);

