<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $brand_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $activateBrandQuery = "UPDATE `brand` SET `status`=1 WHERE `brandID` = '" . $brand_ID . "'";
    
    if(mysqli_query($database, $activateBrandQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}
