<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['nrc'])){
    
    ////Instantiat variables
    $customerID = 'LMS-CSTM-'.date('Y').rand(10,999);
    $firstname = $_POST['firstname'];
    $othername = $_POST['othername'];
    $lastname = $_POST['lastname'];
    $ID = $_POST['nrc'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $residential = $_POST['address'];
    $city = $_POST['city'];
    $password = 'LMS@2020';
    $isactive = '1';

    ///salt function for password salting after encryption
    $salt = '1234567890,?/()pDqrstka*+';
    ///Encryption and salting of password using SHA1
    $hashed_password = sha1($salt . $password);


    ///Check if user exists

    $checkexistinguser = "SELECT `customerID` FROM `customer` WHERE `ID` = '$ID'";

    $result = mysqli_query($database, $checkexistinguser);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //row count returned
    $count = mysqli_num_rows($result);

    if($count > 0){
        echo 'exists';
    }

    if($count == 0){

        $insertcustomer = "INSERT INTO `customer`(`customerID`, `firstname`, `othername`, `lastname`,"
        ." `ID`, `contact`, `email`, `residentialArea`, `city`, `password`, `isActive`)"
        ." VALUES ('$customerID','$firstname','$othername','$lastname','$ID',"
        ."'$contact','$email','$residential','$city','$hashed_password','$isactive')";
        
        
        if(mysqli_query($database, $insertcustomer)){
            echo '';
        } else {
            echo 'unsuccessful';
        }

        
    }


}