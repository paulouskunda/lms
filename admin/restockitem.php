<?php

include './databaseconnector/dbConnector.php';

if(isset($_POST['id'])){
    $item_ID = mysqli_real_escape_string($database, $_POST['id']);
    $fetchdataquery = mysqli_query($database,"SELECT * FROM items, brand 
    WHERE items.itemID = " . $item_ID . " AND items.brandID = brand.brandID ");
    
    if(!$fetchdataquery)
        echo mysqli_error($database);

    $row = mysqli_fetch_array($fetchdataquery, MYSQLI_ASSOC);
    $item = $row['brand_name'];
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
        <label for="restocknumber">Small Quantity</label>
        <input type="number"  value="'.$row['small'].'" class="form-control" id="smallnumber" placeholder="Quantity">
        </div>';
        echo            '<div class="form-group">
        <label for="restocknumber">Medium Quantity</label>
        <input type="number"  value="'.$row['medium'].'" class="form-control" id="mediumnumber" placeholder="Quantity">
        </div>';
        echo            '<div class="form-group">
        <label for="restocknumber">Large Quantity</label>
        <input type="number" value="'.$row['large'].'" class="form-control" id="largenumber" placeholder="Quantity">
        </div>';

    //echo $item<?php echo $row['quantityFlag'];;
    
}
