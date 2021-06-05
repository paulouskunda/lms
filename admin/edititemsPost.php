<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $item_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $item_Name = mysqli_real_escape_string($database, $_POST["itemName"]);
    $price = mysqli_real_escape_string($database, $_POST["price"]);
    $editItemQuery = "UPDATE items, brand SET brand.brand_name = '".$item_Name."', items.price = '".$price."' WHERE 
    items.itemID = '" . $item_ID . "' AND items.brandID = brand.brandID";
    
    if(mysqli_query($database, $editItemQuery)){
        echo 'successful';
    } else {
        echo mysqli_error($database);
    }
}