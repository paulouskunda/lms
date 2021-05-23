<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['submit'])){
    
    ////Instantiat variables
    
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    // $item = $_POST['item'];
    $small = $_POST['small_quantity'];
    $medium = $_POST['medium_quantity'];
    $large = $_POST['large_quantity'];
    $quantity = $medium + $small + $large;
    $flag = 1;
    $price = $_POST['price'];
    $isactive = '1';

    $encounter = 'encounter'.rand(100, 900);
    $restockID = 'stock'.rand(100,9999);

    $select_item = mysqli_query($database, "SELECT * FROM items WHERE brandID = '$brand'");
    if(mysqli_num_rows($select_item)>0){
        // update sql
        echo '<script> alert("Record Already avaliable, please click on update"); </script>';
        echo '<script>  location.href="http://localhost/lms/inventory.php"; </script>';
    }else {
        
        $insertitem = "INSERT INTO `items`( `catID`, `brandID`, `small`, `medium`, `large`,  `quantity`, `quantityFlag`, `price`, `status`) VALUES ('$category', '$brand', '$small', '$medium', '$large', '$quantity','$flag','$price','$isactive')";
        // $restockinfoQuary = "INSERT INTO `itemdates`(`ID`, `encounterID`, `itemID`, `quantity`, `date`) VALUES ('".$restockID."','".$encounter."','".$itemID."','".$quantity."',DATE(NOW()))";
        if(mysqli_query($database, $insertitem)){
            echo '<script> alert("Inserted successfully"); </script>';
            echo '<script>  location.href="http://localhost/lms/inventory.php"; </script>';

        } else {
            echo "<script> console.log(".mysqli_error($database).");</script>";
            echo '<script> alert("We encountered an error"); </script>';
            echo '<script>  location.href="http://localhost/lms/inventory.php"; </script>';        }
    }

        
    }