<?php

include './databaseconnector/dbConnector.php';

if (isset($_POST['brandid'])) {
    $custid = $_POST['brandid'];

    $query = "SELECT DISTINCT category.catID, category.category_name FROM `category` JOIN items ON items.catID = category.catID WHERE items.brandID = '".$custid."' AND category.status = 1";
    $result = mysqli_query($database, $query);
    $rowcount = mysqli_num_rows($result);


    echo '<option value="-1">select</option>';
    while ($row = mysqli_fetch_array($result)) {
        echo '<option value= "' . $row['catID'] . '">' . $row['category_name'] . '</option>';
    }
}