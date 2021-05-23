<?php
include './databaseconnector/dbConnector.php';
if (!isset($_SESSION['login_user'])) {
    header("location: logout.php");
}

$itemPick = "";
//Start populate users into table
$fetchdataquery = "SELECT items.itemName, lease.quantity, lease.leaseDate, lease.returnDate, payment.totalBill, payment.paidamount, payment.status FROM items JOIN `lease` JOIN payment ON items.itemID = lease.itemID AND lease.paymentRef = payment.paymentRef AND lease.customerID = payment.customerID WHERE lease.leaseDate = DATE(NOW())";
$result = mysqli_query($database, $fetchdataquery);
$number_fetch_row = mysqli_num_rows($result);

$fetchdataquery2 = "SELECT items.itemName, lease.quantity, lease.leaseDate, lease.returnDate, payment.totalBill, payment.paidamount, payment.status FROM items JOIN `lease` JOIN payment ON items.itemID = lease.itemID AND lease.paymentRef = payment.paymentRef AND lease.customerID = payment.customerID";
$result2 = mysqli_query($database, $fetchdataquery2);
$number_fetch_row2 = mysqli_num_rows($result2);
//End populate users into table

//Start populate customer combo box

$selectcustomer = "SELECT `customerID`, `firstname`, `othername`, `lastname`, `ID`, `contact`, `email`, `residentialArea`, `city`, `password`, `isActive` FROM `customer` WHERE `isActive` = 1";

$customerresult = mysqli_query($database, $selectcustomer);

$customernum = mysqli_num_rows($customerresult);
//End populate customer combo box

//Start populate brand combo box

$selectbrand = "SELECT `brandID`, `brand_name` FROM `brand` WHERE `status` = 1";

$brandResult = mysqli_query($database, $selectbrand);

$brandNum = mysqli_num_rows($brandResult);
//End populate brand combo box
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LMS Users</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="plugins/c3/c3.min.css">
    <link rel="stylesheet" href="plugins/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.min.css">
    <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="wrapper">
        <header class="header-top" header-theme="light">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="top-menu d-flex align-items-center">
                        <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                        <div class="header-search">
                            <div class="input-group">
                                <span class="input-group-addon search-close"><i class="ik ik-x"></i></span>
                                <input type="text" class="form-control">
                                <span class="input-group-addon search-btn"><i class="ik ik-search"></i></span>
                            </div>
                        </div>
                        <button type="button" id="navbar-fullscreen" class="nav-link"><i
                                class="ik ik-maximize"></i></button>
                    </div>
                    <div class="top-menu d-flex align-items-center">
                        <!-- <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="notiDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="ik ik-bell"></i><span class="badge bg-danger">3</span></a>
                            <div class="dropdown-menu dropdown-menu-right notification-dropdown"
                                aria-labelledby="notiDropdown">
                                <h4 class="header">Notifications</h4>
                                <div class="notifications-wrap">
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-check"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Invitation accepted</span>
                                            <span class="media-content">Your have been Invited ...</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <img src="img/users/1.jpg" class="rounded-circle" alt="">
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">Steve Smith</span>
                                            <span class="media-content">I slowly updated projects</span>
                                        </span>
                                    </a>
                                    <a href="#" class="media">
                                        <span class="d-flex">
                                            <i class="ik ik-calendar"></i>
                                        </span>
                                        <span class="media-body">
                                            <span class="heading-font-family media-heading">To Do</span>
                                            <span class="media-content">Meeting with Nathan on Friday 8 AM ...</span>
                                        </span>
                                    </a>
                                </div>
                                <div class="footer"><a href="javascript:void(0);">See all activity</a></div>
                            </div>
                        </div>
                        <button type="button" class="nav-link ml-10 right-sidebar-toggle"><i
                                class="ik ik-message-square"></i><span class="badge bg-success">3</span></button> -->

                        <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal"
                            data-target="#appsModal"><i class="ik ik-grid"></i></button>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="index.html">
                        <!--<div class="logo-img">
                            <img src="" class="header-brand-img" alt="lavalite">
                        </div>-->
                        <span class="text">ReadyToWed</span>
                    </a>
                    <button type="button" class="nav-toggle"><i data-toggle="expanded"
                            class="ik ik-toggle-right toggle-icon"></i></button>
                    <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                </div>

                <div class="sidebar-content">
                    <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                            <div class="nav-lavel">Navigation</div>
                            <div class="nav-item active">
                                <a href="dashboard.php"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                            </div>
                            <div class="nav-item has-sub">
                                <a href="javascript:void(0)"><i class="ik ik-users"></i><span>User Management</a>
                                <div class="submenu-content">
                                    <a href="users.php" class="menu-item">Users</a>
                                    <a href="customers.php" class="menu-item">Customers</a>
                                    <!-- <a href="#" class="menu-item">Roles</a> -->

                                </div>
                            </div>
                            <div class="nav-item has-sub active open">
                                <a href="#"><i class="ik ik-layers "></i><span>Store Management</span></a>
                                <div class="submenu-content">
                                    <a href="inventory.php" class="menu-item">Inventory</a>
                                    <a href="lease.php" class="menu-item active">Lease</a>
                                    <!-- <a href="#" class="menu-item">Accounting</a> -->
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#fullwindowModal" style="cursor: pointer;">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Booking</h6>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-award"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="62"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#fullwindowModal2" style="cursor: pointer;">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>All Transactions Report</h6>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-award"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="78"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-head">
                                    <h5>Today's Transactions Report</h5>
                                </div>
                                <div class="card-body">
                                    <table id="advanced_table" class="table advanced_table">
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
                                        <tbody>

                                            <?php
                                        if ($number_fetch_row > 0) {
                                            while ($row = mysqli_fetch_array($result)) {
                                                
                                                $status = $row['status'];
                                        ?>

                                            <tr>
                                                <td>
                                                    <div value="<?php echo $row['itemName']?>">
                                                        <?php echo $row['itemName'] ?></div>
                                                </td>
                                                <td>
                                                    <div value="<?php echo $row['quantity'] ?>">
                                                        <?php echo $row['quantity'] ?></div>
                                                </td>
                                                <td>
                                                    <div value="<?php echo $row['totalBill'] ?>">
                                                        <?php echo $row['totalBill'] ?></div>
                                                </td>
                                                <td>
                                                    <div value="<?php echo $row['paidamount'] ?>">
                                                        <?php echo $row['paidamount'] ?></div>
                                                </td>
                                                <td>
                                                    <div value="<?php echo $row['leaseDate'] ?>">
                                                        <?php echo $row['leaseDate'] ?></div>
                                                </td>
                                                <td>
                                                    <div value="<?php echo $row['returnDate'] ?>">
                                                        <?php echo $row['returnDate'] ?></div>
                                                </td>
                                                <td>
                                                    <?php
                                                        if ($status == 1){
                                                            echo 'Returned';
                                                        } else {
                                                            echo 'Not Returned';
                                                        } 
                                                                        ?>

                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                } else {
                                            ?>
                                            <tr>
                                                <td colspan="7">No Data Found</td>
                                            </tr>

                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade full-window-modal" id="fullwindowModal" tabindex="-1" role="dialog"
                aria-labelledby="fullwindowModalLabel" aria-hidden="true">
                <form method="POST" action="leasetransactions.php">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fullwindowModalLabel">BOOKING</h5>
                                <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-header"></div>
                                            <div class="card-body">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="brand">Select Customer</label>
                                                        <select name="customer_id" id="leasecustomername" class="form-control"
                                                            required>
                                                            <option value=""></option>
                                                            <?php
                                                        if ($customernum > 0) {
                                                            while ($customerrow = mysqli_fetch_array($customerresult)) {
                                                                ?>
                                                            <option value="<?php echo $customerrow['customerID']; ?>">
                                                                <?php echo $customerrow['firstname'].' '.$customerrow['othername'].' '.$customerrow['lastname'].' '. $customerrow['ID']; ?>
                                                            </option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group" style="display: none;">
                                                        <label for="leasecustomerlocation">Location <small
                                                                style="color:blue;">
                                                                Location cannot be empty
                                                            </small></label>
                                                        <input type="text" class="form-control" id="leasecustomerlocation"
                                                            title="Item flag cannot contain letters"
                                                            onblur="checkifempty('leasecustomerlocation'); checkPattern('leasecustomerlocation')"
                                                            placeholder="Location" pattern="[A-Za-z]+" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="leasependingamount">Pending Amount <small
                                                                style="color:blue;">
                                                                Pending amount cannot contain
                                                                letters</small></label>
                                                        <input type="number" class="form-control" id="leasependingamount"
                                                            title="Pending amount cannot contain letters"
                                                            onblur="checkifempty('leasependingamount'); checkPattern('leasependingamount')"
                                                            placeholder="Pending amount" pattern="[0-9]+" disabled>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="brandsection">
                                        <div class="card">
                                            <div class="card-header"></div>
                                            <div class="card-body">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="brand">Select Brand</label>
                                                        <select name="brand" id="leaseitembrand" class="form-control"
                                                            onchange="checkbrandcombovalue()" required>
                                                            <option value=""></option>
                                                            <?php
                                                        if ($brandNum > 0) {
                                                            while ($leasebrandrow = mysqli_fetch_array($brandResult)) {
                                                                ?>
                                                            <option value="<?php echo $leasebrandrow['brandID']; ?>">
                                                                <?php echo $leasebrandrow['brand_name']; ?></option>
                                                            <?php
                                                            }
                                                        }
                                                        ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="category">Select Category</label>
                                                        <select name="category" onChange="onSelectCategory(this)" id="leaseitemcategory" class="form-control"
                                                            required>
                                                            <?php
                                                                $onSelectCategory = mysqli_query($database, "SELECT * FROM category WHERE status = 1");
                                                                if ($onSelectCategory) {
                                                                    if (mysqli_num_rows($onSelectCategory) > 0) {
                                                                        while ($row = mysqli_fetch_assoc($onSelectCategory)) {
                                                                           echo '<option value="'.$row['category_name'].'">'.$row['category_name'].'</option>'; 
                                                                        }
                                                                    }else{
                                                                    echo '<option value="">Add Data</option>';
                                                                    }
                                                                }else{
                                                                     echo '<option value="">'.mysqli_error($database).'</option>';
                                                                }

                                                            ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group" id="itemSelect" style="display: none;">
                                                        <label for="category">Select Item</label>
                                                        <select name="leaseitem" id="leaseitem" class="form-control"
                                                            required>
                                                            <option value=""></option>
                                                            <?php
                                                                 $onSelectItem = mysqli_query($database, "SELECT * FROM items WHERE status = 1");
                                                                if ($onSelectItem) {
                                                                    if (mysqli_num_rows($onSelectItem) > 0) {
                                                                        while ($row = mysqli_fetch_assoc($onSelectItem)) {
                                                                           echo '<option value="'.$row['itemID'].'">'.$row['itemName'].'</option>'; 
                                                                        }
                                                                    }else{
                                                                    echo '<option value="">Add Data</option>';
                                                                    }
                                                                }else{
                                                                     echo '<option value="">'.mysqli_error($database).'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" id="quantitysection">
                                        <div class="card">
                                            <div class="card-header"></div>
                                            <div class="card-body">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="leasequantity">Quantity <small style="color:blue;">
                                                                Item quantity cannot contain
                                                                letters</small></label>
                                                        <input type="number" name="leasequantity" class="form-control" id="leasequantity"
                                                            title="Lease quantity cannot contain letters"
                                                            placeholder="Quantity" pattern="[0-9]+" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="leasereutrndate">Date of USE </label>
                                                        <input type="date" name="leasereutrndate" class="form-control" id="leasereutrndate"
                                                            placeholder="Date of Return" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="leaseitemprice">Price <small style="color:blue;">
                                                                Price cannot contain
                                                                letters</small></label>
                                                        <input type="number" class="form-control" id="leaseitemprice" name="leaseitemprice" 
                                                            title="Price cannot contain letters"
                                                         
                                                            placeholder="Price" pattern="[0-9]+" >
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="billsection">
                                        <div class="card">
                                            <div class="card-header"></div>
                                            <div class="card-body">
                                                <div class="forms-sample">
                                                    <div class="form-group">
                                                        <label for="leaseprice">Total Price <small style="color:blue;">
                                                                Total price cannot contain
                                                                letters</small></label>
                                                        <input type="number" class="form-control" id="leaseprice"
                                                            title="Total price cannot contain letters"
                                                            onblur="checkifempty('leaseprice'); checkPattern('leaseprice')"
                                                            placeholder="Total Price" pattern="[0-9]+" disabled>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="leaseamount">Payeable/Paid Amount <small
                                                                style="color:blue;">
                                                                Amount cannot contain
                                                                letters</small></label>
                                                        <input type="number" class="form-control" id="leaseamount"
                                                            title="Amount cannot contain letters"
                                                            onblur="checkifempty('leaseamount'); checkPattern('leaseamount')"
                                                            placeholder="Amount" pattern="[0-9]+" required>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="card">
                                        <div class="card-head">
                                            <h5>Customer History</h5>
                                        </div>
                                        <div class="card-body">
                                            <table id="historytable" class="table">
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
                                                <tbody id="customerhistorydata">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal"
                                    id="closemodal">Close</button>
                                <input type="submit" class="btn btn-primary" value="Transact" name="checkedby">
                                <button type="button" class="btn btn-primary" id="conducttransaction">Transact</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal fade full-window-modal" id="fullwindowModal2" tabindex="-1" role="dialog"
                aria-labelledby="fullwindowModalLabel2" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fullwindowModalLabel2">All Transactions Report</h5>
                            <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body edituserprofile">
                            <div class="row">
                                <div class="col-md-4 form-group row">
                                    <label class="col-md-3" for="startfrom">From</label>
                                    <div class="col-md-6">
                                        <input type="date" id="startfrom" name="startfrom" class="required form-control"
                                            placeholder="Start from">
                                    </div>
                                </div>

                                <div class="col-md-4 form-group row">
                                    <label class="col-md-3" for="upto">To</label>
                                    <div class="col-md-6">
                                        <input type="date" id="upto" name="upto" class="required form-control"
                                            placeholder="Up To">
                                    </div>
                                </div>
                                <div class="col-md-4 form-group row">
                                    <div class="col-md-3">
                                        <button class="btn btn-primary" id="filtersearch">Filter</button>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">

                                        <div class="card-body tableresult">
                                            <table id="advanced_table" class="table">
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
                                                <tbody>

                                                    <?php
                                        if ($number_fetch_row2 > 0) {
                                            while ($row2 = mysqli_fetch_array($result2)) {
                                                
                                                $status2 = $row2['status'];
                                        ?>

                                                    <tr>
                                                        <td>
                                                            <div value="<?php echo $row2['itemName']?>">
                                                                <?php echo $row2['itemName'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div value="<?php echo $row2['quantity'] ?>">
                                                                <?php echo $row2['quantity'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div value="<?php echo $row2['totalBill'] ?>">
                                                                <?php echo $row2['totalBill'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div value="<?php echo $row2['paidamount'] ?>">
                                                                <?php echo $row2['paidamount'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div value="<?php echo $row2['leaseDate'] ?>">
                                                                <?php echo $row2['leaseDate'] ?></div>
                                                        </td>
                                                        <td>
                                                            <div value="<?php echo $row2['returnDate'] ?>">
                                                                <?php echo $row2['returnDate'] ?></div>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if ($status2 == 1){
                                                                    echo 'Returned';
                                                                } else {
                                                                    echo 'Not Returned';
                                                                } 
                                                            ?>

                                                        </td>
                                                    </tr>
                                                    <?php
                                                        }
                                                        } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="7">No Data Found</td>
                                                    </tr>

                                                    <?php
}
                                            ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal"
                                id="closemodal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /.modal -->
            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close closeselect" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body displayamounttopay">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="payamount">Confirm Payment</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


            <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog"
                aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="ik ik-x-circle"></i></button>
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="quick-search">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 ml-auto mr-auto">
                                        <div class="input-wrap">
                                            <input type="text" id="quick-search" class="form-control"
                                                placeholder="Search..." />
                                            <i class="ik ik-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body d-flex align-items-center">
                            <div class="container">
                                <div class="apps-wrap">
                                    <div class="app-item">
                                        <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                    </div>

                                    <div class="app-item">
                                        <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                                    </div>
                                    <div class="app-item">
                                        <a href="#"><i class="ik ik-users"></i><span>Account</span></a>
                                    </div>
                                    <div class="app-item">
                                        <a href="logout.php"><i
                                                class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="src/js/vendor/jquery-3.3.1.min.js"></script>
            <script>
            window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
            </script>
            <script src="plugins/popper.js/dist/umd/popper.min.js"></script>
            <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
            <script src="plugins/screenfull/dist/screenfull.js"></script>
            <script src="plugins/datatables.net/js/jquery.dataTables.min.js"></script>
            <script src="plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
            <script src="plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
            <script src="plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
            <script src="plugins/jvectormap/jquery-jvectormap.min.js"></script>
            <script src="plugins/jvectormap/tests/assets/jquery-jvectormap-world-mill-en.js"></script>
            <script src="plugins/moment/moment.js"></script>
            <script src="plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
            <script src="js/tables.js"></script>
            <script src="dist/js/theme.min.js"></script>
            <script src="plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.all.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.min.js"></script>

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
            // (function(b, o, i, l, e, r) {
            //     b.GoogleAnalyticsObject = l;
            //     b[l] || (b[l] =
            //         function() {
            //             (b[l].q = b[l].q || []).push(arguments)
            //         });
            //     b[l].l = +new Date;
            //     e = o.createElement(i);
            //     r = o.getElementsByTagName(i)[0];
            //     e.src = 'https://www.google-analytics.com/analytics.js';
            //     r.parentNode.insertBefore(e, r)
            // }(window, document, 'script', 'ga'));
            // ga('create', 'UA-XXXXX-X', 'auto');
            // ga('send', 'pageview');
            $custname = $('#leasecustomername');
            $leaseitembrand = $('#leaseitembrand');
            $leaseitemcategory = $('#leaseitemcategory');
            $leaseitem = $('#leaseitem');
            $leasereutrndate = $('#leasereutrndate');

            $custname.on('change', function() {
                var custid = $(this).val();
                console.log(custid);

                if (custid !== "") {
                    $.ajax({
                        url: "getcustomerlocation.php",
                        type: 'POST',
                        data: {
                            custid: custid
                        },
                        success: function(html) {
                            $("#leasecustomerlocation").val(html);
                        }
                    });
                    $.ajax({
                        url: "getcustomerpendingamount.php",
                        type: 'POST',
                        data: {
                            custid: custid
                        },
                        success: function(html) {
                            console.log(html);
                            if (html > 0) {

                                document.getElementById("brandsection").style.visibility = "hidden";
                                document.getElementById("quantitysection").style.visibility =
                                    "hidden";
                                document.getElementById("billsection").style.visibility = "hidden";
                            }
                            if (html === 0) {
                                document.getElementById("brandsection").style.visibility =
                                "visible";
                                document.getElementById("quantitysection").style.visibility =
                                    "visible";
                                document.getElementById("billsection").style.visibility = "visible";
                            }
                            $("#leasependingamount").val(html);
                        }
                    });
                    $.ajax({
                        url: "getcustomerhistory.php",
                        type: 'POST',
                        data: {
                            custid: custid
                        },
                        success: function(html) {
                            $("#customerhistorydata").html(html);
                        }
                    });
                }


            });
            $(document).on("click", ".paypendingamount", function() {
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url: "getamounttopay.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(html) {
                        $('.displayamounttopay').html(html);
                    }
                });

            });
            $(document).on("click", "#payamount", function() {
                var id = $(".difference").attr("id");
                var custid = $(".difference").attr("name");
                var getamount = $(".difference").val();
                console.log(id);
                console.log(custid);
                console.log(getamount);

                $.ajax({
                    url: "payamount.php",
                    method: "POST",
                    data: {
                        id: id,
                        getamount: getamount
                    },
                    success: function(data) {
                        console.log(data);
                        if (data === '') {
                            $.toast({
                                heading: 'success',
                                text: 'Transaction Successful.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });
                            $("#leasependingamount").val("");
                            $.ajax({
                                url: "getcustomerpendingamount.php",
                                type: 'POST',
                                data: {
                                    custid: custid
                                },
                                success: function(html) {
                                    $("#leasependingamount").val(html);
                                }
                            });

                        }
                        if (data === 'paid') {
                            $.toast({
                                heading: 'success',
                                text: 'Amount paid in full.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });
                            $.ajax({
                                url: "getcustomerpendingamount.php",
                                type: 'POST',
                                data: {
                                    custid: custid
                                },
                                success: function(html) {
                                    $("#leasependingamount").val(html);
                                }
                            });
                            $('#historytable').DataTable().destroy();
                            $.ajax({
                                url: "refreshhistory.php",
                                type: 'POST',
                                data: {
                                    custid: custid
                                },
                                success: function(html) {
                                    $("#customerhistorydata").html(html);
                                }
                            });
                        }
                        if (data === 'paidfully') {
                            $.toast({
                                heading: 'success',
                                text: 'Amount paid fully.',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });
                            $.ajax({
                                url: "getcustomerpendingamount.php",
                                type: 'POST',
                                data: {
                                    custid: custid
                                },
                                success: function(html) {
                                    $("#leasependingamount").val(html);
                                }
                            });
                            $('#historytable').DataTable().destroy();
                            $.ajax({
                                url: "refreshhistory.php",
                                type: 'POST',
                                data: {
                                    custid: custid
                                },
                                success: function(html) {
                                    $("#customerhistorydata").html(html);
                                }
                            });
                        }
                    }
                });
            });
            $leaseitembrand.on('change', function() {
                var brandid = $(this).val();
                console.log(brandid);

                if (brandid !== "") {
                    $.ajax({
                        url: "getleaseitemcategory.php",
                        type: 'POST',
                        data: {
                            brandid: brandid
                        },
                        success: function(html) {
                            $("#leaseitemcategory").html(html);
                        }
                    });
                }
            });
            $leaseitemcategory.on('change', function() {
                var catid = $(this).val();
                console.log(catid);

                if (catid !== "") {
                    $.ajax({
                        url: "getleaseitem.php",
                        type: 'POST',
                        data: {
                            catid: catid
                        },
                        success: function(html) {
                            $("#leaseitem").html(html);
                        }
                    });
                }
            });
            $leaseitem.on('change', function() {
                var itemid = $(this).val();
                console.log(itemid);

                if (itemid !== "") {
                    $.ajax({
                        url: "getleaseitemprice.php",
                        type: 'POST',
                        data: {
                            itemid: itemid
                        },
                        success: function(html) {
                            $("#leaseitemprice").val(html);
                        }
                    });
                }
            });
            $leasereutrndate.on('blur', function() {
                var leaseitemprice = document.getElementById("leaseitemprice").value;
                var leasequantity = document.getElementById("leasequantity").value;
                var leasereutrndate = document.getElementById("leasereutrndate").value;
                var future = new Date(leasereutrndate);
                var today = new Date();
                var days = Math.floor((Date.UTC(future.getFullYear(), future.getMonth(), future.getDate()) -
                    Date.UTC(today.getFullYear(), today.getMonth(), today.getDate())) / (1000 * 60 *
                    60 * 24));
                //var datetoday = today.getFullYear(), today.getMonth(), today.getDate();
                console.log(days);
                console.log(leasereutrndate);
                console.log(leaseitemprice);
                console.log(leasequantity);

                var totalprice = leaseitemprice * leasequantity * days;

                console.log(totalprice);

                document.getElementById("leaseprice").value = totalprice;

                document.getElementById("leaseamount").value = totalprice * 0.5;



            });
            $('#conducttransaction').click(function() {
                var leaseitem = document.getElementById("leaseitem").value;
                console.log(leaseitem);
                var leasecustomername = document.getElementById("leasecustomername").value;
                console.log(leasecustomername);
                var leasequantity = document.getElementById("leasequantity").value;
                var leasereutrndate = document.getElementById("leasereutrndate").value;
                var leaseprice = document.getElementById("leaseprice").value;
                var leaseamount = document.getElementById("leaseamount").value;
                var checkedby = '<?php echo $user_check ?>';
                console.log(checkedby);

                if (leaseitem !== '' && leasecustomername !== '' &&
                    leasequantity !== '' && leasereutrndate !== '' && leaseamount != '' &&
                    leaseprice !== '' && checkedby != '') {

                    $.ajax({
                        url: 'leasetransactions.php',
                        method: 'post',
                        data: {
                            leaseitem: leaseitem,
                            leasecustomername: leasecustomername,
                            leasequantity: leasequantity,
                            leasereutrndate: leasereutrndate,
                            leaseprice: leaseprice,
                            leaseamount: leaseamount,
                            checkedby: checkedby
                        },
                        success: function(data) {
                            console.log(data);
                            if (data === '') {
                                $.toast({
                                    heading: 'success',
                                    text: 'Transaction Successful.',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    loaderBg: '#f96868',
                                    position: 'top-right'
                                });

                            }

                            if (data === 'unsuccessful') {
                                $.toast({
                                    heading: 'Danger',
                                    text: 'Operation Unsuccessful.',
                                    showHideTransition: 'slide',
                                    icon: 'error',
                                    loaderBg: '#f2a654',
                                    position: 'top-right'
                                });

                            }

                        }
                    });
                } else {
                    $.toast({
                        heading: 'Warning',
                        text: 'Check all fields and try again.',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                }
            });
            $(document).on("click", "#filtersearch", function() {
                var datefrom = $("#startfrom").val();
                var dateto = $("#upto").val();
                console.log(datefrom);
                console.log(dateto);
                if (datefrom != '' && dateto != '') {
                    $.ajax({
                        url: "filteralltransactions.php",
                        method: "POST",
                        data: {
                            datefrom: datefrom,
                            dateto: dateto
                        },
                        success: function(data) {
                            $(".tableresult").html(data);
                        }
                    });
                } else {
                    $.toast({
                        heading: 'Warning',
                        text: 'Please select date.',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                }
            });
            //check regular expression
            function checkPattern(elem) {

                var elmt = document.getElementById(elem);
                // Allow A-Z, a-z, 0-9 and underscore. Min 1 char.
                var pattern = elmt.getAttribute("pattern");
                var re = new RegExp(pattern);

                console.log(re);

                if (!re.test(elmt.value) && elmt.value !== '') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Please use correct format',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });

                }
                if (re.test(elmt.value) && elmt.value !== '') {
                    $.toast({
                        heading: 'Success',
                        text: 'Ok',
                        showHideTransition: 'slide',
                        icon: 'success',
                        loaderBg: '#f96868',
                        position: 'top-right'
                    });
                }
            }

            function checkifempty(elem) {
                var elmt = document.getElementById(elem).value;

                if (elmt === '') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Field is empty',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                } else {

                }
            }

            $(document).on("click", ".closemodal", function() {
                window.location.href = 'lease.php';
            });


            $(document).on("click", ".viewuser", function() {
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url: "userprofile.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(html) {
                        $('.profile').html(html);
                    }
                });
            });


            $(document).on("click", ".edituser", function() {
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url: "edituserprofile.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(html) {
                        $('.edituserprofile').html(html);
                    }
                });
            });


            $(document).on("click", "#savechanges", function() {
                console.log('clicked');
                var id = document.getElementById("edituserid").value;
                console.log(id);
                var username = document.getElementById("editusername").value;
                console.log(username);
                var firstname = document.getElementById("editfirstname").value;
                console.log(firstname);
                var othername = document.getElementById("editothername").value;
                console.log(othername);
                var lastname = document.getElementById("editlastname").value;
                console.log(lastname);
                var nrc = document.getElementById("editnrc").value;
                console.log(nrc);
                var email = document.getElementById("editemail").value;
                console.log(email);
                var contact = document.getElementById("editcontact").value;
                console.log(contact);
                var city = document.getElementById("editcity").value;
                console.log(city);
                var residential = document.getElementById("editaddress").value;
                console.log(residential);
                var role = document.getElementById("editrole").value;
                console.log(role);
                var isactive;
                if (document.getElementById("editisactive_active").checked) {
                    isactive = 1;
                    console.log(isactive);
                } else {
                    isactive = 0;
                    console.log(isactive);
                }

                $.ajax({
                    url: "edituser.php",
                    type: "POST",
                    data: {
                        id: id,
                        username: username,
                        firstname: firstname,
                        othername: othername,
                        lastname: lastname,
                        nrc: nrc,
                        email: email,
                        contact: contact,
                        city: city,
                        residential: residential,
                        role: role,
                        isactive: isactive
                    },
                    success: function(data) {
                        if (data === 'successful') {
                            $.toast({
                                heading: 'Success',
                                text: 'User has been updated successful',
                                showHideTransition: 'slide',
                                icon: 'success',
                                loaderBg: '#f96868',
                                position: 'top-right'
                            });


                        }
                        if (data === 'unsuccessful') {
                            $.toast({
                                heading: 'Warning',
                                text: 'User update unsuccessful. Please try again.',
                                showHideTransition: 'slide',
                                icon: 'warning',
                                loaderBg: '#57c7d4',
                                position: 'top-right'
                            });


                        }
                    }
                });
            });


            $(".deleteuser").click(function() {
                var id = $(this).attr("id");
                console.log(id);
                swal.fire({
                        text: 'Are you sure you want to delete this?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    })
                    .then((result) => {
                        if (result.value) {

                            $.ajax({
                                url: "deactivateuser.php",
                                method: "POST",
                                data: {
                                    id: id
                                },
                                success: function(data) {


                                    if (data === 'successful') {
                                        console.log(data);
                                        window.location.href = 'users.php';
                                    }
                                    if (data === 'unsuccessful') {
                                        $.toast({
                                            heading: 'Error',
                                            text: 'Delete unsuccessful',
                                            showHideTransition: 'slide',
                                            icon: 'warning',
                                            loaderBg: '#f2a654',
                                            position: 'top-right'
                                        });
                                    }
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {

                        }
                    });

            });


          
            </script>
            <script type="text/javascript">
            function onSelectCategory(select){
             // <?php $itemPick  ?>=select.value <?php ; ?>

                console.log("<?php echo $itemPick ?>");
                console.log(select.value);
                console.log(leaseitembrand.value);
                document.getElementById('itemSelect').style.display = "block";
            }

            function onSelectItem(select){

            }
            </script>
</body>

</html>