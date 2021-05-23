<?php
session_start();

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'lmdb');

$database = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

require 'functions.php';

// check for the dress (this would have been better if it was cron job)
checkPastReturnDate($database);
