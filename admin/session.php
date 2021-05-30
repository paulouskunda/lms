<?php

include './databaseconnector/dbConnector.php';


//Check if the login page has received user's username//
if (isset($_POST['username'])) {
    //get username
    $username = mysqli_real_escape_string($database, $_POST['username']);
    //get password
    $password = mysqli_real_escape_string($database, $_POST['password']);

    ///salt function for password salting after encryption
    $salt = '1234567890,?/()pDqrstka*+';
    ///Encryption and salting of password using SHA1
    $hash_sha1 = sha1($salt . $password);

    //count is a variable used to get the number of rows returned from the database
    $count = 0;
    echo "<script>console.log('".$username."')</script>";
    //Check if user is root or ordinary user//
    if ($username === "root") {
        //check if root exists
        $query = "SELECT `username`, `password` FROM `system` WHERE `username` = '$username' AND `password` = '" . $password . "'";

        $result = mysqli_query($database, $query);
        if($result){
            echo "some";
            $_SESSION['login_user'] = $username;
            echo  mysqli_num_rows($result);
            
        }else{
            echo mysqli_error($database);
        }
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        //row count returned
        $count = mysqli_num_rows($result);
        echo $count;
    }

    else if ($username !== "root") {
        //check if user exists
    
        $query = "SELECT * FROM `customer` WHERE `email` = '$username' AND isActive = 1";

        $result = mysqli_query($database, $query);
        if($result){
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                ///salt function for password salting after encryption
                $salt = '1234567890,?/()pDqrstka*+';
                ///Encryption and salting of password using SHA1
                $hashed_password = sha1($salt . $password);

                if($row['password'] === $hashed_password){
                    $_SESSION['userID'] = $row['customerID'];
                    header("location: customer/dashboard.php");
                }else{
                    echo '<script> 
                            alert("Incorrect password or user");
                            location.href="index.php";
                          </script>';

                    // echo "Not a user ".mysqli_error($database);

                }
                // $_SESSION['login_user'] = $username;
            }else{
                echo '<script> 
                          alert("Incorrect password or user");
                          location.href="index.php";
                       </script>';
            }

        }else{
            echo '<script> 
            alert("We ecountered an error");
            console.log("We ecountered an error");
            location.href="index.php";
         </script>';        
        }


        //row count returned
        $count = mysqli_num_rows($result);
    }

    ///Check if rows returned are equal to 1///
    if ($count == 1) {

        //Add user to session
        $_SESSION['login_user'] = $username;
    }
}

///Check if session has received user///
if (isset($_SESSION['login_user'])) {

    //set session to variable
    $user_check = $_SESSION['login_user'];

    //Check if session user is root
    if ($user_check === "root") {
        $session_query = mysqli_query($database, "SELECT `username`, `password` FROM `system` WHERE `username` = '" . $user_check . "'");
        $row = mysqli_fetch_array($session_query, MYSQLI_ASSOC);
        $session_root_username = $row['username'];
        echo "<script> location.href='dashboard.php';</script>";
        echo $_SESSION['login_user'];
    }

    //Check if session user is not root
    if ($user_check !== "root") {
        
        echo $user_check;
        //get user details
        $session_query = mysqli_query($database, "SELECT * FROM `customer` WHERE `email` = '$user_check'");
        if($session_query){
            echo "session_query";
            if(mysqli_num_rows($session_query)>0){
                echo "inner view";
            }
        }else{
            echo mysqli_error($database);
        }
        $row = mysqli_fetch_array($session_query, MYSQLI_ASSOC);
        
        $userID = $row['userID'];
        $userRole = $row['roleID'];
        

        if ($userID !== '' && $userRole !== '') {
            ///Query to get user details from users table///
            $getuserdetails = mysqli_query($database, "SELECT * FROM `users` WHERE `userid` = '$userID'");
            $getuserRow = mysqli_fetch_array($getuserdetails, MYSQLI_ASSOC);

            $session_firstname = $getuserRow['firstname'];
            $session_othername = $getuserRow['othername'];
            $session_lastname = $getuserRow['lastname'];
            $session_NRC_number = $getuserRow['identification_number'];
            $session_phone_number = $getuserRow['contact'];
            $session_email = $getuserRow['email'];
            $session_residential_address = $getuserRow['residentialAddress'];
            $session_is_active = $getuserRow['isActive'];
            if ($session_is_active === "1") {
                ///Query to get and set privileges for the user from roles table///
                $getuserprivileges = mysqli_query($database, "SELECT * FROM `roles` WHERE `roleID` = '$userRole'");
                $getuserprivilegeRow = mysqli_fetch_array($getuserprivileges, MYSQLI_ASSOC);

                $session_role_title = $getuserprivilegeRow['role_title'];
                $session_read_privilege = $getuserprivilegeRow['read_privilege'];
                $session_write_privilege = $getuserprivilegeRow['write_privilege'];
                $session_user_creation = $getuserprivilegeRow['createUsers'];
                $session_user_editing = $getuserprivilegeRow['editUsers'];
                $session_user_deleting = $getuserprivilegeRow['removeUsers'];
                $session_user_view = $getuserprivilegeRow['viewUsers'];
                $session_createCustomers = $getuserprivilegeRow['createCustomers'];
                $session_viewCustomers = $getuserprivilegeRow['viewCustomers'];
                $session_edtitCustomers = $getuserprivilegeRow['edtitCustomers'];
                $session_removeCustomers = $getuserprivilegeRow['removeCustomers'];
                $session_editProfile = $getuserprivilegeRow['editProfile'];
                $session_addProducts = $getuserprivilegeRow['addProducts'];
                $session_viewProducts = $getuserprivilegeRow['viewProducts'];
                $session_editProducts = $getuserprivilegeRow['editProducts'];
                $session_removeProducts = $getuserprivilegeRow['removeProducts'];
                echo "<script> location.href='dashboard.php';</script>";

            } else {
                echo '<script> 
                alert("Check your username or password");
                console.log("We ecountered an error");
                location.href="index.php";
             </script>';  
                echo mysqli_error($database);
            }
        } else {
            echo '<script> 
            alert("We ecountered an error");
            console.log("We ecountered an error");
            location.href="index.php";
         </script>';  
            echo mysqli_error($database);
        }
    }
}

if (!isset($_SESSION['login_user'])) {
    echo 'here error';
}
