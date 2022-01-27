<?php

ob_start();
session_start();
//session_destroy();

// To Make it easier to reference
defined("DS") ? null: define("DS", DIRECTORY_SEPARATOR);
defined("TEMPLATE_FRONT") ? null: define("TEMPLATE_FRONT", __DIR__ . DS . "template/front");
defined("TEMPLATE_BACK") ? null: define("TEMPLATE_BACK", __DIR__ . DS . "template/back");
defined("UPLOAD_DIRECTORY") ? null: define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");

// For DB connection
defined("DB_HOST") ? null: define("DB_HOST","localhost");
defined("DB_USER") ? null: define("DB_USER","root");    // db username
defined("DB_PASS") ? null: define("DB_PASS","");    //db password
defined("DB_NAME") ? null: define("DB_NAME","ecom_db");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//To include these pages to every page, creating a stable connection
require_once("functions.php");
require_once("cart.php");

?>