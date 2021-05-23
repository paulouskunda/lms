<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $updatcustomer = "UPDATE `customer` SET `customerID` ='" . $_POST['id'] . "',`firstname`='" . $_POST['firstname'] . "',`othername`='" . $_POST['othername'] . "',`lastname`='" . $_POST['lastname'] . "',`ID`='" . $_POST['nrc'] . "',`contact`='" . $_POST['contact'] . "',`email`='" . $_POST['email'] . "',`residentialArea`='" . $_POST['residential'] . "',`city`='" . $_POST['city'] . "',`isActive`='" . $_POST['isactive'] . "' WHERE `customerID`='" . $_POST['id'] . "'";


            // UPDATE `customer` SET `customerID`=[value-1],`firstname`=[value-2],`othername`=[value-3],`lastname`=[value-4],`ID`=[value-5],`contact`=[value-6],`email`=[value-7],`residentialArea`=[value-8],`city`=[value-9],`password`=[value-10],`isActive`=[value-11] WHERE 1
            // . "SET `userID`='" . $_POST['id'] . "',`firstname`='" . $_POST['firstname'] . "',`othername`='" . $_POST['othername'] . "',`lastname`='" . $_POST['lastname'] . "',"
            // . "`NRC_number`='" . $_POST['nrc'] . "',`phone_number`='" . $_POST['contact'] . "',`email`='" . $_POST['email'] . "',"
            // . "`residential_address`='" . $_POST['residential'] . "',`username`='" . $_POST['username'] . "',"
            // . "`roleID`='" . $_POST['role'] . "',`isActive`='" . $_POST['isactive'] . "' WHERE `userid` = '" . $_POST['id'] . "'";

    if (mysqli_query($database, $updatcustomer)) {
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}