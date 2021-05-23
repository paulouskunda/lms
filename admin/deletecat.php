<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['catID'])) {
    $cat_ID = mysqli_real_escape_string($database, $_POST["catID"]);
    $getitembrandid = mysqli_real_escape_string($database, $_POST["getitembrandid"]);
    if($getitembrandid == 'All'){
        $deactivateCategoryQuery = "UPDATE `category` SET `status`=0 WHERE `catID` = '" . $cat_ID . "'";
        $deactivateCategoryQuery2 = "UPDATE `items` SET `status`=0 WHERE `catID` = '" . $cat_ID . "'";
    
        if(mysqli_query($database, $deactivateCategoryQuery) && mysqli_query($database, $deactivateCategoryQuery2)){
            echo 'successful';
        } else {
            echo 'unsuccessful';
        }
    } else {
        $deactivateCategoryQuery = "UPDATE `items` SET `status`=0 WHERE `catID` = '" . $cat_ID . "' AND `brandID` =  '" . $getitembrandid . "'";
    
        if(mysqli_query($database, $deactivateCategoryQuery)){
            echo 'successful';
        } else {
            echo 'unsuccessful';
        }
    }
    
}
