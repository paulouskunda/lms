<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['custid'])){
    $totalbill = 0;
    $pending = 0;
    $getamounts = "SELECT payment.totalBill, payment.paidamount FROM `lease` JOIN payment ON lease.customerID = payment.customerID AND lease.paymentRef = payment.paymentRef WHERE lease.customerID = '".$_POST['custid']."'";
    $getamountsResult = mysqli_query($database, $getamounts);
    while($row = mysqli_fetch_array($getamountsResult)){
        $totalbill += $row['totalBill'];
        $pending += $row['paidamount'];
        
    
        
    }
    $pendingamounts = $totalbill - $pending;
    echo $pendingamounts;
}