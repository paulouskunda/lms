<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['checkedby'])){

    $leaseID = 'leased'.rand(100, 999);
    $paymentref = 'PMREF'.date('Y').rand(10,999);
    $leaseitemcategory = $_POST['leaseitem'];
    $leasequantity = $_POST['leasequantity'];
    $leasereutrndate = $_POST['leasereutrndate'];
    $checkedby = $_POST['checkedby'];
    $leasecustomername = $_POST['customer_id'];
    $leaseprice = $_POST['leaseprice'];
    $leaseamount = $_POST['leaseamount'];

    $posttolease = "INSERT INTO `lease`(`leaseID`, `itemID`, `quantity`, `leaseDate`, `returnDate`, `updatedBy`, `customerID`, `paymentRef`, `status`) VALUES ('$leaseID','$leaseitemcategory','$leasequantity',DATE(NOW()),'$leasereutrndate','$checkedby','$leasecustomername','$paymentref',1)";
    
    if($leaseprice == $leaseamount){
        $posttopayment = "INSERT INTO `payment`(`paymentRef`, `customerID`, `dateofPayment`, `totalBill`, `paidamount`, `status`) VALUES ('$paymentref','$leasecustomername',DATE(NOW()),'$leaseprice','$leaseamount',1)";
    } else if($leaseprice > $leaseamount){
        $posttopayment = "INSERT INTO `payment`(`paymentRef`, `customerID`, `dateofPayment`, `totalBill`, `paidamount`, `status`) VALUES ('$paymentref','$leasecustomername',DATE(NOW()),'$leaseprice','$leaseamount',0)";    
    }

    if(mysqli_query($database, $posttolease) && mysqli_query($database, $posttopayment)){
        echo '';
    } else {
        echo 'unsuccessful';
    }
    
}

