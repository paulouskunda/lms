<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST["catname"])) {
    
    $catname = mysqli_real_escape_string($database, $_POST["catname"]);
    $cat_id = $catname.rand(100, 999);

    $insertdataQuery = "INSERT INTO `category`(`catID`, `category_name`, `status`) VALUES ('$cat_id','$catname',1)";
    
    if(mysqli_query($database, $insertdataQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}