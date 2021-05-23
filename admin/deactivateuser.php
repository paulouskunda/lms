<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {

        $deactivateuser = "UPDATE `users` SET `isActive`= 0 WHERE `userid` = '" . $_POST['id'] . "'";

        if (mysqli_query($database, $deactivateuser)) {
             echo 'successful';
        } else {
              echo 'unsuccessful';
        }
    }
    