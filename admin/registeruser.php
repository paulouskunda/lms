<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['username'])){
    
    ////Instantiat variables
    $userID = 'LMS-USR-'.date('Y').rand(10,999);
    $roleID = $_POST['role'];
    $firstname = $_POST['firstname'];
    $othername = $_POST['othername'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
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

    $checkexistinguser = "SELECT `userID` FROM `users` WHERE `username` = '$username'";

    $result = mysqli_query($database, $checkexistinguser);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //row count returned
    $count = mysqli_num_rows($result);

    if($count > 0){
        echo 'exists';
    }

    if($count == 0){

        $insertuser = "INSERT INTO `users`(`userID`, `roleID`, `firstname`, `othername`, `lastname`, `username`, `identification_number`, `contact`,"
        ." `email`, `residentialAddress`, `city`, `password`, `isActive`) "
        ."VALUES ('$userID','$roleID','$firstname','$othername','$lastname','$username',"
        ."'$ID','$contact','$email','$residential','$city','$hashed_password','$isactive')";
        
        if(mysqli_query($database, $insertuser)){
            echo '';
        } else {
            echo 'unsuccessful';
        }

        
    }


}