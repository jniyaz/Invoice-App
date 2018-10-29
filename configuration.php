<?php


session_start();

define('BASE_PATH', 'http://localhost/tutorials/invoice/');

//Database credentials
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'invoice');
define('DB_USERNAME','root');
define('DB_PASSWORD','root');

$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
if( mysqli_connect_error()) echo "Failed to connect to MySQL: " . mysqli_connect_error();