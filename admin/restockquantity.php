<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $item_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $restockQuantity = mysqli_real_escape_string($database, $_POST["totalquantity"]);
    $encounter = 'encounter'.rand(100, 900);
    $restockID = 'stock'.rand(100,9999);
    $restockItemQuery = "UPDATE `items` SET `quantity`= '". $restockQuantity ."' WHERE `itemID` = '" . $item_ID . "'";
    $restockinfoQuary = "INSERT INTO `itemdates`(`ID`, `encounterID`, `itemID`, `quantity`, `date`) VALUES ('".$restockID."','".$encounter."','".$item_ID."','".$restockQuantity."',DATE(NOW()))";
    //'".$restockID."', '".$encounter."', '".$item_ID."', '".$restockQuantity."', DATE(NOW())
    if(mysqli_query($database, $restockItemQuery) && mysqli_query($database, $restockinfoQuary)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}