<?php

include './databaseconnector/dbConnector.php';
// include 'functions.php';

if(isset($_POST['book_dress'])){


    $customer_id = mysqli_real_escape_string($database, $_POST['customer_id']);
    $brandID = mysqli_real_escape_string($database, $_POST['brandID_']);
    $size = mysqli_real_escape_string($database, $_POST['size']);
    $quatity = mysqli_real_escape_string($database, $_POST['quatity']);
    $dateofuse = mysqli_real_escape_string($database, $_POST['dateofuse']);
    $paymentPlan = mysqli_real_escape_string($database, $_POST['paymentPlan']);
    $price = mysqli_real_escape_string($database, $_POST['price']);
    $payment_amount = mysqli_real_escape_string($database, $_POST['payment_amount']);
    $dateofRuturn = mysqli_real_escape_string($database, $_POST['dateOfReturn']);
    $itemID = mysqli_real_escape_string($database, $_POST['itemID']);
    $type = mysqli_real_escape_string($database, $_POST['type']);

    $addUp = addNewBooking($database, $customer_id, $brandID, $dateofuse, $dateofRuturn, $paymentPlan, $price, $payment_amount, $size, $quatity, $type, $itemID);

    echo "<script>alert('".$addUp."')</script>";
    // if($)
    // $customer_id = mysqli_real_escape_string($database, $_POST['customer_id']);
    // $brand = mysqli_real_escape_string($database, $_POST['brand']);
    // $brandID = mysqli_real_escape_string($database, $_POST['brandID']);
    // $category =  mysqli_real_escape_string($database, $_POST['category']);
    // $type = mysqli_real_escape_string($database, $_POST['type']);
    // $size = mysqli_real_escape_string($database, $_POST['size']);
    // $quatity = mysqli_real_escape_string($database, $_POST['quatity']);
    // $dateofuse = mysqli_real_escape_string($database, $_POST['dateofuse']);
    // $paymentPlan = mysqli_real_escape_string($database, $_POST['paymentPlan']);
    // $price = mysqli_real_escape_string($database, $_POST['price']);
    // $payment_amount = mysqli_real_escape_string($database, $_POST['payment_amount']);


    // $alreadyBooked = false;

    // $selectAll = mysqli_query($database, "SELECT * FROM payment_tracking WHERE brandID = '$brandID' AND dateOfUse = '$dateofuse'");
    // if(mysqli_num_rows($selectAll)>0){
    //     echo "Already booked for this day";
    // }else{
    //     if($paymentPlan === "full"){
    //         if($price === $payment_amount){
    //             // insert into lease table


    //         }else{
    //             // Notify the user
    //             echo "<script> alert('You selected full payment but the amount entered is not the same as the payable, we have changed you method to installments'); </script>";
    //             // insert into payment tracking
    //             $insertInTracking  = "INSERT INTO payment_tracking ( `customerID`, `brandID`, `dateOfUse`, `amountPaid`, `totalBill`, `dateOfPayment`, `statusOfPayment`) 
    //             VALUE('$customer_id', '$brandID', '$dateofuse', '$payment_amount', '$price', NOW(), 1)";
    //             if(mysqli_query($database, $insertInTracking)){
                    
                    
    //                 // $updateQuery = "UPDATE SET items"
                    
    //                 echo "All in";
    //             }else{
    //                 echo mysqli_error($database);
    //             }
    //         }
    //     }else{
    //         $insertInTracking  = "INSERT INTO payment_tracking ( `customerID`, `brandID`, `dateOfUse`, `amountPaid`, `totalBill`, `dateOfPayment`, `statusOfPayment`)

    //          VALUE('$customer_id', '$brandID', '$dateofuse', '$payment_amount', '$price', NOW(), 0)";
    //         if(mysqli_query($database, $insertInTracking)){
    //             echo "All in";
    //         }else{
    //             echo mysqli_error($database);
    //         }
    //     }
    // }
   
    
}

