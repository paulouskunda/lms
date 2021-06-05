<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $item_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $restockQuantity = mysqli_real_escape_string($database, $_POST["totalquantity"]);
    $smallquantity = mysqli_real_escape_string($database, $_POST["smallquantity"]);
    $mediumquantity = mysqli_real_escape_string($database, $_POST["mediumquatity"]);
    $largequantity = mysqli_real_escape_string($database, $_POST["largequantity"]);
    $encounter = 'encounter'.rand(100, 900);
    $restockID = 'stock'.rand(100,9999);
    $restockItemQuery = "UPDATE `items` SET `quantity`= '". $restockQuantity ."', small= '". $smallquantity ."', medium = '". $mediumquantity ."', large = '". $largequantity ."' WHERE `itemID` = '" . $item_ID . "'";
    $restockinfoQuary = "INSERT INTO `itemdates`(`ID`, `encounterID`, `itemID`, `quantity`, `date`) VALUES ('".$restockID."','".$encounter."','".$item_ID."','".$restockQuantity."',DATE(NOW()))";
    //'".$restockID."', '".$encounter."', '".$item_ID."', '".$restockQuantity."', DATE(NOW())
    if(mysqli_query($database, $restockItemQuery)){
        echo 'successful';
    } else {
        echo '<script>console.log(here '.mysqli_error($database).')</script>';
    }
}