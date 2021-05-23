<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $updateuser = "UPDATE `users` SET `userID`='" . $_POST['id'] . "',`roleID`='" . $_POST['role'] . "',`firstname`='" . $_POST['firstname'] . "',`othername`='" . $_POST['othername'] . "',`lastname`='" . $_POST['lastname'] . "',`username`='" . $_POST['username'] . "',`identification_number`='" . $_POST['nrc'] . "',`contact`='" . $_POST['contact'] . "',`email`='" . $_POST['email'] . "',`residentialAddress`='" . $_POST['residential'] . "',`city`='" . $_POST['city'] . "',`isActive`='" . $_POST['isactive'] . "' WHERE `userID`='" . $_POST['id'] . "'";


            // $updateuser = "UPDATE `users` "
            // . "SET `userID`='" . $_POST['id'] . "',`firstname`='" . $_POST['firstname'] . "',`othername`='" . $_POST['othername'] . "',`lastname`='" . $_POST['lastname'] . "',"
            // . "`NRC_number`='" . $_POST['nrc'] . "',`phone_number`='" . $_POST['contact'] . "',`email`='" . $_POST['email'] . "',"
            // . "`residential_address`='" . $_POST['residential'] . "',`username`='" . $_POST['username'] . "',"
            // . "`roleID`='" . $_POST['role'] . "',`isActive`='" . $_POST['isactive'] . "' WHERE `userid` = '" . $_POST['id'] . "'";

    if (mysqli_query($database, $updateuser)) {
        echo 'successful';
    } else {
        echo 'unsuccessful';
    }
}