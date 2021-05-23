<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {

        $deactivatecustomer = "UPDATE `customer` SET `isActive`=0 WHERE `customerID` = '" . $_POST['id'] . "'";

        if (mysqli_query($database, $deactivatecustomer)) {
             echo 'successful';
        } else {
              echo 'unsuccessful';
        }
    }
    