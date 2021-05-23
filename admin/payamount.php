<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['id'])){
    $amounttopay = $_POST['getamount'];
    $totalbill = 0;
    $paidamount = 0;
    $getbill = "SELECT payment.totalBill, payment.paidamount FROM `payment` JOIN lease ON payment.paymentRef = lease.paymentRef WHERE payment.paymentRef = '".$_POST['id']."'";
    $billResult = mysqli_query($database, $getbill);

    while ($row = mysqli_fetch_array($billResult)) {
        $totalbill += $row['totalBill'];
        $paidamount += $row['paidamount'];
    
    }

    $totaltopay = $amounttopay + $paidamount;

    if($totalbill < $totaltopay){
        echo 'paidfully';
    } else if($totalbill == $totaltopay){
        $updatepaidamount = "UPDATE `payment` SET `paidamount`= '$totaltopay' WHERE `paymentRef` = '".$_POST['id']."'";
        $updatestatus = "UPDATE `payment` SET `status`= 1 WHERE `paymentRef` = '".$_POST['id']."'";
        if(mysqli_query($database, $updatepaidamount) && mysqli_query($database, $updatestatus)){
        echo 'paid';
        } else {
        echo 'unsuccessful';
        }
        
    } else {
    $updatepaidamount = "UPDATE `payment` SET `paidamount`= '$totaltopay' WHERE `paymentRef` = '".$_POST['id']."'";
    if(mysqli_query($database, $updatepaidamount)){
        echo '';
    } else {
        echo 'unsuccessful';
    }
}

}