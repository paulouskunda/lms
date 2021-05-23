<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['id'])){
    $item_ID = mysqli_real_escape_string($database, $_POST['id']);
    $fetchdataquery = mysqli_query($database,"SELECT `itemName`, quantityFlag, quantity FROM `items` WHERE `itemID` = '" . $item_ID . "'");
    $row = mysqli_fetch_array($fetchdataquery, MYSQLI_ASSOC);
    $item = $row['itemName'];
    $flag = $row['quantityFlag'];
    $remainingquantity = $row['quantity'];
    echo            '<div class="form-group">
        <label for="othername">Item Name</label>
        <input type="text" class="form-control itemNo" name="'.$item_ID.'" id="itemNo" value="'.$item.'" disabled>
        </div>';
    echo            '<div class="form-group">
        <label for="othername">Flag</label>
        <input type="text" class="form-control" name="flag" id="flag" value="'.$flag.'" disabled>
        </div>';
    echo            '<div class="form-group">
        <label for="othername">Remaining Quantity</label>
        <input type="text" class="form-control" name="remainingquantity" id="remainingquantity" value="'.$remainingquantity.'" disabled>
        </div>';    
    echo            '<div class="form-group">
        <label for="restocknumber">Restock Quantity</label>
        <input type="number" class="form-control" id="restocknumber" placeholder="Quantity">
        </div>';

    //echo $item<?php echo $row['quantityFlag'];;
    
}
