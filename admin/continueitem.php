<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $item_ID = mysqli_real_escape_string($database, $_POST["id"]);
    $activateItemQuery = "UPDATE `items` SET `status`=1 WHERE `itemID` = '" . $item_ID . "'";
    
    if(mysqli_query($database, $activateItemQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}
