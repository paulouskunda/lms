<?php

include './databaseconnector/dbConnector.php';

$getbrand = "SELECT `brandID`,`brand_name` FROM `brand` WHERE `status` = 1 ORDER BY brandID Asc";
$brandResult = mysqli_query($database, $getbrand);
$brandNum = mysqli_num_rows($brandResult);

$id = $_POST['id'];
if(isset($id)){
    echo            '<div class="form-group">
    <label for="othername"></label>
    <input type="text" class="form-control" id="getbrandid" value="'.$id.'" disabled>
</div>';
if ($brandNum > 0) {
while ($row = mysqli_fetch_array($brandResult)) {

echo   '<div class="form-group">
    <label for="brand">Select Brand</label>
    <select name="brand" id="getitembrand" class="form-control"
    onchange="checkbrandcombovalue()" required>
    <option value=""></option>
    <option value="All">All</option>';                 
        if ($brandNum > 0) {
            while ($row = mysqli_fetch_array($brandResult)) {
                echo'<option value='.$row['brandID'].'>'. $row['brand_name'].'</option>';
            }
        }
echo '</select>
</div>';

    }       
}
}
