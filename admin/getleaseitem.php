<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['catid'])) {
    $catid = $_POST['catid'];

    $query = "SELECT `itemID`, `itemName`FROM `items` WHERE `catID` = '".$catid."' AND `status` = 1";
    $result = mysqli_query($database, $query);
    $rowcount = mysqli_num_rows($result);


    echo '<option value="-1">select</option>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value= "' . $row['itemID'] . '">' . $row['itemName'] . '</option>';
    }
}