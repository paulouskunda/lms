<?php

include './databaseconnector/dbConnector.php';


if(isset($_POST['id'])){
    $totalbill = 0;
    $paidamount = 0;
    $getbill = "SELECT payment.totalBill, payment.paidamount, payment.paymentRef, `payment`.`customerID` FROM `payment` JOIN lease ON payment.paymentRef = lease.paymentRef WHERE lease.itemID = '".$_POST['id']."'";
    $billResult = mysqli_query($database, $getbill);
    $billNum = mysqli_num_rows($billResult);
 
    while ($row = mysqli_fetch_array($billResult)) {
    
        $totalbill += $row['totalBill'];
        $paidamount += $row['paidamount'];
        $paymentref = $row['paymentRef'];
        $customerID = $row['customerID'];
    
    }
    $diff = $totalbill - $paidamount;       
    echo            '<div class="form-group">
    <label for="difference">Due Amount</label>
    <input type="text" class="form-control difference" name = "'.$customerID.'" id="'.$paymentref.'" value="'.$diff.'">
</div>';
}
