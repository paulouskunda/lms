<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $cat_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $activateCategoryQuery = "UPDATE `category` SET `status`=1 WHERE `catID` = '" . $cat_ID . "'";
    
    if(mysqli_query($database, $activateCategoryQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}