<?php

include './databaseconnector/dbConnector.php';
///Check if user exists
if(isset($_POST['username'])){
$username = $_POST['username'];
$checkexistinguser = "SELECT `userID` FROM `users` WHERE `username` = '$username'";

$result = mysqli_query($database, $checkexistinguser);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);

    if($count > 0){
        echo 'exists';
    }
}