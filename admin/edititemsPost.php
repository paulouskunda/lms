<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $item_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $item_Name = mysqli_real_escape_string($database, $_POST["itemName"]);
    $price = mysqli_real_escape_string($database, $_POST["price"]);
    $editItemQuery = "UPDATE `items` SET itemName = '".$item_Name."', `price`= '". $price ."' WHERE `itemID` = '" . $item_ID . "'";
    
    if(mysqli_query($database, $editItemQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}