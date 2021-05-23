<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['username'])){

    $username = mysqli_real_escape_string($database, $_POST['username']);
    $password = mysqli_real_escape_string($database, $_POST['password']);

    $salt = '1234567890,?/()pDqrstka*+';
    $hashedpassword = sha1($salt . $password);

    if($username === 'root'){
        $query = "SELECT `username`, `password` FROM `system` WHERE username = '$username' AND password = '$hashedpassword'";

        $result = mysqli_query($database, $query);
        
        $count = mysqli_num_rows($result);
    
        if ($count === 1) {

            echo $username;
          
            //header("location: session.php");
        } else {
            echo 'invalid';
        }
    }

    if($username !== 'root'){
        $query = "SELECT `username` FROM `users` WHERE username = '$username' AND password = '$hashedpassword'";

        $result = mysqli_query($database, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        $count = mysqli_num_rows($result);

        if ($count === 1) {
            $_SESSION['loginuser'] = $username;

            header("location: session.php");
        } else {
            echo 'invalid';
        }
    }


}