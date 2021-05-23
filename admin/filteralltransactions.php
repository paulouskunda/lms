<?php

include './databaseconnector/dbConnector.php';


if(isset($_POST['datefrom'], $_POST['dateto'])){
    $fetchdataquery = "SELECT items.itemName, lease.quantity, lease.leaseDate, lease.returnDate, payment.totalBill, payment.paidamount, payment.status FROM items JOIN `lease` JOIN payment ON items.itemID = lease.itemID AND lease.paymentRef = payment.paymentRef AND lease.customerID = payment.customerID WHERE lease.leaseDate BETWEEN '".$_POST['datefrom']."' AND '".$_POST['dateto']."'";
    $result = mysqli_query($database, $fetchdataquery);
    $number_fetch_row = mysqli_num_rows($result);
    
    if ($number_fetch_row > 0) {
        while ($row = mysqli_fetch_array($result)) {
            
            $status = $row['status'];
    echo '<table id="advanced_table" class="table advanced_table">
    <thead>
        <tr>
            <th>Leased Item</th>
            <th>Quantity</th>
            <th>Amount</th>
            <th>Paid Amount</th>
            <th>Date Leased</th>
            <th>Return Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>';
            echo '<tr>';
            echo '<td><div value="' . $row['itemName'] . '">' . $row['itemName'] . '</div></td>';
            echo '<td><div value="' . $row['quantity'] . '">' . $row['quantity'] . '</div></td>';
            echo '<td><div value="' . $row['totalBill'] . '">' . $row['totalBill'] . '</div></td>';
            echo '<td><div value="' . $row['paidamount'] . '">' . $row['paidamount'] . '</div></td>';
            echo '<td><div value="' . $row['leaseDate'] . '">' . $row['leaseDate'] . '</div></td>';
            echo '<td><div value="' . $row['returnDate'] . '">' . $row['returnDate'] . '</div></td>';
            echo '<td>';
            if ($status == 1){
                echo 'Returned';
            } else {
                echo 'Not Returned';
            } 
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr> <td colspan = "7">No Data Found</td> </tr>';
    
    }
    echo '</tbody>
    </table>';
}
