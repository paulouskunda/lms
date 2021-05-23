<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['id'])){
    $item_ID = mysqli_real_escape_string($database, $_POST['id']);
    $fetchdataquery = mysqli_query($database,"SELECT `itemName`, price FROM `items` WHERE `itemID` = '" . $item_ID . "'");
    $row = mysqli_fetch_array($fetchdataquery, MYSQLI_ASSOC);
    $item = $row['itemName'];
    $price = $row['price'];
    echo            '<div class="form-group">
        <label for="othername">Item Name</label>
        <input type="text" class="form-control itemNo" name="'.$item_ID.'" id="itemNo" value="'.$item.'">
        </div>';
    echo            '<div class="form-group">
        <label for="othername">Price</label>
        <input type="number" class="form-control" name="price" id="price" value="'.$price.'">
        </div>';
    //echo $item<?php echo $row['quantityFlag'];;
    
}
