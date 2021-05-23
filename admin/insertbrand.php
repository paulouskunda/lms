<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST["brandname"])) {
    
    $brandname = mysqli_real_escape_string($database, $_POST["brandname"]);
    $brand_id = $brandname.rand(100, 999);

    $insertdataQuery = "INSERT INTO `brand`(`brandID`, `brand_name`, `status`) VALUES ('$brand_id','$brandname',1)";
    
    if(mysqli_query($database, $insertdataQuery)){
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}