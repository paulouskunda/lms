<?php 
include './databaseconnector/dbConnector.php';

if (isset($_POST['id'])) {
    $getuserprofile = "SELECT * FROM `customer` WHERE `customerID` = '" . $_POST["id"] . "'";
    $result = mysqli_query($database, $getuserprofile);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
}

echo '<div class="banner_inner d-flex align-items-center">
<div class="col-lg-12 col-md-12">
<div class="card">
    <div class="card-body">
        <div class="text-center"> 
            <img src="img/user.jpg" class="rounded-circle" width="150">
            <h4 class="card-title mt-10">'.$row["firstname"].' '.$row["othername"] .' '.$row["lastname"].'</h4>
            <p class="card-subtitle">Customer</p>
            <div class="row text-center justify-content-md-center">
                <div class="col-8"><a href="javascript:void(0)" class="link"><i class="ik ik-user"></i> <font class="font-medium">'.$row["ID"].'</font></a></div>
                
            </div>
        </div>
    </div>
    <hr class="mb-0"> 
    <div class="card-body"> 
        <small class="text-muted d-block">Email address </small>
        <h6>'.$row["email"].'</h6> 
        <small class="text-muted d-block pt-10">Phone</small>
        <h6>'.$row["contact"].'</h6> 
        <small class="text-muted d-block pt-10">Address</small>
        <h6>'.$row["residentialArea"] .', '. $row["city"].'</h6>
        </div>
</div>
</div>
                </div>
                
                ';