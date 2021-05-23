<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['custid'])){
    $getcustlocation = mysqli_query($database,"SELECT `residentialArea`, `city` FROM `customer` WHERE `customerID` = '".$_POST['custid']."'");
    $row = mysqli_fetch_array($getcustlocation, MYSQLI_ASSOC);
    $custlocation = $row['city'].' '.$row['residentialArea'];

    echo $custlocation;

}