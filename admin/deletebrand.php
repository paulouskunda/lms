<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $brand_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $deactivateBrandQuery = "UPDATE `brand` SET `status`=0 WHERE `brandID` = '" . $brand_ID . "'";

    $discontinueitem = "UPDATE `items` SET `status`=0 WHERE `brandID` = '" . $brand_ID . "'";

    
    if(mysqli_query($database, $deactivateBrandQuery) && mysqli_query($database, $discontinueitem)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}
