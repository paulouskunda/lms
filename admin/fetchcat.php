<?php

include './databaseconnector/dbConnector.php';

$fetchdataquery = "SELECT `catID`,`category_name`,`status` FROM `category`";
$result = mysqli_query($database, $fetchdataquery);
$number_fetch_row = mysqli_num_rows($result);

if ($number_fetch_row > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $catID = $row['catID'];
        $category_name = $row['category_name'];
        $status = $row['status'];

        echo '<tr>';
        echo '<td><div data-id="' . $catID . '" id="catid" data-column="brand_name" value="' . $category_name . '">' . $category_name . '</div></td>';
        echo '<td><div data-column="status" value="' . $status . '">';
        if ($status == 1){
            echo 'Continued';
        } else {
            echo 'Discontinued';
        } 
        echo '</div></td>';
        if ($status == 1){
            echo '<td><button type="button" id="' . $catID . '" name="discontinue"  data-toggle="modal" data-target="#modal-lg" class="btn btn-danger btn-xs deletecat">Discontinue</button></td>';
        } else {
            echo '<td><button type="button" id="' . $catID . '" name="continue" class="btn btn-success btn-xs continuecat">Continue</button></td>';
        } 
        
        echo '</tr>';
    }
} else {
    echo '<tr> <td colspan = "3">No Data Found</td> </tr>';

}