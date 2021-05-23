<?php

include './databaseconnector/dbConnector.php';

$fetchdataquery = "SELECT `brandID`,`brand_name`,`status` FROM `brand`";
$result = mysqli_query($database, $fetchdataquery);
$number_fetch_row = mysqli_num_rows($result);

if ($number_fetch_row > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $brandID = $row['brandID'];
        $brand_name = $row['brand_name'];
        $status = $row['status'];

        echo '<tr>';
        echo '<td><div data-id="' . $brandID . '" data-column="brand_name" value="' . $brand_name . '">' . $brand_name . '</div></td>';
        echo '<td><div data-column="status" value="' . $status . '">';
        if ($status == 1){
            echo 'Continued';
        } else {
            echo 'Discontinued';
        } 
        echo '</div></td>';
        if ($status == 1){
            echo '<td><button type="button" id="' . $brandID . '" name="discontinue" class="btn btn-danger btn-xs delete">Discontinue</button></td>';
        } else {
            echo '<td><button type="button" id="' . $brandID . '" name="continue" class="btn btn-success btn-xs continue">Continue</button></td>';
        } 
        
        echo '</tr>';
    }
} else {
    echo '<tr> <td colspan = "3">No Data Found</td> </tr>';

}