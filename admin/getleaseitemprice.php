<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['itemid'])) {
    $itemid = $_POST['itemid'];

    $query = mysqli_query($database,"SELECT price FROM `items` WHERE `itemID` = '".$itemid."' AND `status` = 1");
    $row = mysqli_fetch_array($query, MYSQLI_ASSOC);

    echo $row['price'];
}