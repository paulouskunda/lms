<?php

function addNewBooking($db, $customer_id, $brandID, $dateofuse, $dateOfReturn, $paymentPlan, $price, $payment_amount, $size, $quantity, $type, $itemID){
    if(checkExistingBooking($db, $dateofuse, $brandID)){
        return "Already_Booked";
    }else{
        if($paymentPlan === "full"){
            if($price === $payment_amount){
                $insertInTracking  = "INSERT INTO payment_tracking ( `customerID`, `brandID`, `size`, `quantity`, `dateOfUse`, `dateOfReturn`, `amountPaid`, `totalBill`, `dateOfPayment`, `statusOfPayment`, `type`) 
                VALUE('$customer_id', '$brandID', '$size', '$quantity', '$dateofuse', '$dateOfReturn', '$payment_amount', '$price', NOW(), 1, '$type')";
                if(mysqli_query($db, $insertInTracking)){
                    $last_id = mysqli_insert_id($db);
                    $insertInHistoricalTracking = mysqli_query($db, "INSERT INTO payment_tracking_history (`payment_tracking_id`, `amount_paid`, `date_of_payment`) VALUES ('$last_id', '$payment_amount', NOW())");
                    if($insertInHistoricalTracking){
                        if(updateCounter($db, $size, $quantity, $itemID))
                            return true;
                        else{
                            echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

                            return false;
                        }
                    }
                    else{
                        echo "<script> console.log('full payment - tracking ".mysqli_error($db)."'); </script>";
                        return false;
                    }
                }else{
                    echo "<script> console.log('full payment ".mysqli_error($db)."'); </script>";
                    return false;
                }
    
            }else{
                // Notify the user
                echo "<script> alert('You selected full payment but the amount entered is not the same as the payable, we have changed you method to installments'); </script>";
                // insert into payment tracking
                $insertInTracking  = "INSERT INTO payment_tracking ( `customerID`, `brandID`, `size`, `quantity`, `dateOfUse`, `dateOfReturn`, `amountPaid`, `totalBill`, `dateOfPayment`, `statusOfPayment`, `type`) 
                VALUE('$customer_id', '$brandID', '$size',  '$quantity', '$dateofuse', '$dateOfReturn', '$payment_amount', '$price', NOW(), 0, '$type')";
                if(mysqli_query($db, $insertInTracking)){
                    $last_id = mysqli_insert_id($db);
                    $insertInHistoricalTracking = mysqli_query($db, "INSERT INTO payment_tracking_history (`payment_tracking_id`, `amount_paid`, `date_of_payment`) VALUES ('$last_id', '$payment_amount', NOW())");
                    if($insertInHistoricalTracking){
                        
                        if(updateCounter($db, $size, $quantity, $itemID))
                            return true;
                        else{
                            echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

                            return false;
                         }

                    }
                    else{
                        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

                        return false;
                    }               
                }else{
                    echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

                    return false;
                }
            }
        }else{
              // insert into payment tracking
              $insertInTracking  = "INSERT INTO payment_tracking ( `customerID`, `brandID`, `size`, `quantity`, `dateOfUse`, `dateOfReturn`, `amountPaid`, `totalBill`, `dateOfPayment`, `statusOfPayment`, `type`) 
              VALUE('$customer_id', '$brandID', '$size',  '$quantity', '$dateofuse', '$dateOfReturn', '$payment_amount', '$price', NOW(), 0, '$type')";
            if(mysqli_query($db, $insertInTracking)){
                $last_id = mysqli_insert_id($db);
                $insertInHistoricalTracking = mysqli_query($db, "INSERT INTO payment_tracking_history (`payment_tracking_id`, `amount_paid`, `date_of_payment`) VALUES ('$last_id', '$payment_amount', NOW())");
                if($insertInHistoricalTracking)
                {
                    if(updateCounter($db, $size, $quantity, $itemID))
                        return true;
                    else{
                        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";
                        return false;
                    }

                }
                else{
                    echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

                    return false;
                }
            }else{
                echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";
                return false;
            }
        }
    }
 

}


function checkExistingBooking($db, $dateofuse, $brandID){
    $select_all = mysqli_query($db, "SELECT * FROM payment_tracking WHERE dateOfUse = '$dateofuse' AND brandID = '$brandID' ");
    if(mysqli_num_rows($select_all)>0)
        return true;
    else
        return false;
}

function updateBookingPayment($db, $payID, $paidAmount, $actual_price){
    if($paidAmount == $actual_price){
        $updateTracking = mysqli_query($db, "UPDATE payment_tracking SET amountPaid = (amountPaid + $paidAmount), statusOfPayment = 1 WHERE ptID = '$payID' ");
        if($updateTracking){
            $insertInHistoricalTracking = mysqli_query($db, "INSERT INTO payment_tracking_history (`payment_tracking_id`, `amount_paid`, `date_of_payment`)
             VALUES ('$payID', '$paidAmount', NOW())");
            if($insertInHistoricalTracking)
                return "all_settled";
            else{
                echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";
                return false;
            }
        }
    }else{
        $updateTracking = mysqli_query($db, "UPDATE payment_tracking SET amountPaid = (amountPaid + $paidAmount), statusOfPayment = 0 WHERE ptID = '$payID' ");
        if($updateTracking){
            $insertInHistoricalTracking = mysqli_query($db, "INSERT INTO payment_tracking_history (`payment_tracking_id`, `amount_paid`, `date_of_payment`)
             VALUES ('$payID', '$paidAmount', NOW())");
            if($insertInHistoricalTracking)
                return "balance";
            else{
                echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";
                return false;
            }
        }
    }
}

function updateCounter($db, $size, $quantity, $id){

    echo "Are we??";
    if($size == "small" || $size == "Small")
         $updateTracking = mysqli_query($db, "UPDATE items SET `small`= `small` - $quantity, `quantity`= `quantity` - $quantity WHERE itemID = '$id' ");
    else if($size == "medium" || $size == "Medium")
        $updateTracking = mysqli_query($db, "UPDATE items SET `medium` = `medium` - $quantity, `quantity`= `quantity` - $quantity WHERE itemID = '$id' ");
    else if($size == "large" || $size == "Large")
        $updateTracking = mysqli_query($db, "UPDATE items SET `large` = `large` - $quantity, `quantity`= `quantity` - $quantity WHERE itemID = '$id' ");
    
    if($updateTracking)
        return true;
    else{
        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }
 

}   

function getAllNotYetPaidBooking($db, $customerID){

    $select_not_paid = mysqli_query($db, "SELECT * FROM payment_tracking WHERE customerID = '$customerID' AND statusOfPayment = 0");
    if($select_not_paid){
        return $select_not_paid;
    }else{
        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }

}

function getAllPaidBooking($db, $customerID){
    $select_not_paid = mysqli_query($db, "SELECT * FROM payment_tracking WHERE customerID = '$customerID' AND statusOfPayment = 1 AND dateOfUse >= NOW()");
    if($select_not_paid){
        return $select_not_paid;
    }else{
        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }
}

function getHistoricalTransaction($db, $customerID){
    $select_paid = mysqli_query($db, "SELECT * FROM payment_tracking WHERE customerID = '$customerID' AND statusOfPayment = 1 AND dateOfUse >= NOW()");
    if($select_paid){
        return $select_paid;
    }else{
        echo "<script> console.log('installments payment - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }
}

function checkPastReturnDateSingle($db, $customerID){
    $selectNotReturn = mysqli_query($db, "SELECT * FROM payment_tracking WHERE customerID = '$customerID' AND statusOfPayment = 1 OR statusOfPayment = 2 AND dateOfReturn <= NOW()");
    if($selectNotReturn){
        return $selectNotReturn;
    }else{
        echo "<script> console.log('Not returned - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }
}


function checkPastReturnDate($db){
    $select_not_returned = mysqli_query($db, "SELECT * FROM payment_tracking WHERE  statusOfPayment = 1 AND dateOfReturn < NOW()");
    if($select_not_returned){
        if(mysqli_num_rows($select_not_returned)>0){
            foreach($select_not_returned as $rows){
                $update = mysqli_query($db, "UPDATE payment_tracking SET  statusOfPayment = 2 WHERE ptID = ".$rows['ptID']."");
                if($update){

                    return $select_not_returned;

                    // // check for the date

                    // $selectOverDue = "SELECT * FROM over_due WHERE ptID = '".$rows['ptID']."'";

                    // $insertIntoOverDue = "INSERT INTO over_due (ptID, overDueAmount, dateIssued, settledStatus)";
                    // echo "<script> console.log('Start tracking balance ".mysqli_error($db)."'); </script>";
                }
            }
        }

        


    }else{


        echo "<script> console.log('Check Dates - tracking ".mysqli_error($db)."'); </script>";

        return false;
    }
}



function returnDress($db, $ptID){
    $update = mysqli_query($db, "UPDATE payment_tracking SET  statusOfPayment = 1 WHERE ptID = ".$rows['ptID']."");

    // update item and add the return

    // TODO WORK HERE


}

function addCharge($db){
        $select_not_returned = mysqli_query($db, "SELECT * FROM payment_tracking WHERE  statusOfPayment = 2 AND dateOfReturn < NOW()");
        if($select_not_returned){

            if(mysqli_num_rows($select_not_returned)>0){
                foreach($select_not_returned as $rows){
                    $select_not_returned = mysqli_query($db, "SELECT * FROM charges WHERE  ptID = '".$rows['ptID']."' AND  ptID = '".$rows['customerID']."' AND dateOfReturn > NOW()");

                    $update = mysqli_query($db, "INSERT INTO charges_tracking ('amount', 'chargeReason', 'ptID', 'customerID', 'dateOfCharge')  statusOfPayment = 2 WHERE ptID = ".$rows['ptID']."");
                    if($update){
    
                        return $select_not_returned;
    
                        
                    }
                }
            }
    
            
    
    
        }else{
    
    
            echo "<script> console.log('Check Dates - tracking ".mysqli_error($db)."'); </script>";
    
            return false;
        }
    
}


function checkContract($db, $customerID, $ptID){
    $selectContract = mysqli_query($db, "SELECT * FROM contracts WHERE cusID = '$customerID' AND ptID = '$ptID'");
    if(mysqli_num_rows($selectContract)>0)
        return true;
    else
        return false;
}

function signContract(){

}

?>