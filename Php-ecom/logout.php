<?php

session_start();

require('database/controller.php');
require('database/Auth.php');

$db = new DBController();
$auth = new Auth($db);

$auth->logout();
header("Location: index.php");
die();