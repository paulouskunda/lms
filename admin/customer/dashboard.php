<?php
include './dbConnector.php';
if (!isset($_SESSION['userID'])) {
    header("location: logout.php");
}

$getPassedID = $_SESSION['userID'];
//Start populate users into table
$selectCustomer = "SELECT `customerID`,`firstname`,`othername`,`lastname` FROM `customer` WHERE `isActive` = 1 AND `customerID` = '$getPassedID'";

$result = mysqli_query($database, $selectCustomer);

$num = mysqli_num_rows($result);

$getCustomerDetails = mysqli_fetch_assoc($result);
//End populate users into table

//Start populate role combo box
$getRoles = "SELECT `roleID`,`role_title` FROM roles WHERE `role_title` = 'customer'";

$roleResult = mysqli_query($database, $getRoles);

$roleNum = mysqli_num_rows($roleResult);
//End populate role combo box


$countBrand = mysqli_query($database, "SELECT COUNT(`brandID`) as brandcount FROM `brand`");
$brandrow = mysqli_fetch_array($countBrand, MYSQLI_ASSOC);

$countCategory = mysqli_query($database, "SELECT COUNT(`catID`) AS catcount FROM `category`");
$categoryrow = mysqli_fetch_array($countCategory, MYSQLI_ASSOC);

$countItem = mysqli_query($database, "SELECT COUNT(`itemID`) AS itemcount FROM `items`");
$itemrow = mysqli_fetch_array($countItem, MYSQLI_ASSOC);

$getItems = "SELECT items.itemID, items.brandID, items.catID, brand.brand_name, category.category_name, items.itemID, items.small, items.medium, items.large,
 items.quantity, items.quantityFlag, items.price, items.status as itemstatus, brand.status 
 as brandstatus, category.status as catstatus FROM `brand` JOIN category JOIN items ON brand.brandID = items.brandID AND category.catID = items.catID";
$itemsResult = mysqli_query($database, $getItems);
$itemsNum = mysqli_num_rows($itemsResult);

$getbrand = "SELECT `brandID`,`brand_name` FROM `brand` WHERE `status` = 1";
$brandResult = mysqli_query($database, $getbrand);
$brandNum = mysqli_num_rows($brandResult);

$getcategory = "SELECT `catID`, `category_name` FROM `category` WHERE `status` = 1";
$categoryResult = mysqli_query($database, $getcategory);
$categoryNum = mysqli_num_rows($categoryResult);

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

    <link rel="stylesheet" href="../plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="../plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="../plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="../plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/build/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../plugins/weather-icons/css/weather-icons.min.css">
    <link rel="stylesheet" href="../plugins/c3/c3.min.css">
    <link rel="stylesheet" href="../plugins/owl.carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../plugins/owl.carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="../plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
    <link rel="stylesheet" href="../dist/css/theme.min.css">
    <link rel="stylesheet" href="../plugins/sweetalert2-8.13.5/package/dist/sweetalert2.min.css">
    <script src="../src/js/vendor/modernizr-2.8.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // $('[data-toggle="tooltip"]').tooltip();,
			$('#advanced_table_ad').DataTable();
			$('#myDonation').DataTable();
			$('#mySelfDonor').DataTable();
        });
    </script>

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
              
                        </nav>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <div class="container-fluid">

                    <!-- Avaliable dress -->
                    <div class="card">
                            <div class="card-body">
                                 <p>Our Avaliable Dresses </p>
                                <table id="advanced_table_ad" class="table">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Instock Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Book</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($itemsNum > 0){
                                            while($row = mysqli_fetch_array($itemsResult)){                                                      
                                                    ?>
                                        <tr>
                                            <td><?php echo $row['brand_name'];?></td>
                                            <td><?php echo $row['category_name'];?></td>
                                            <td><?php echo $row['quantity'];?></td>
                                            <td><?php echo $row['price'];?></td>
                        
                                            <td><?php 
                                                
                                                if($row['quantity'] == 0){
                                                    echo "Out of stock";
                                                }
                                                if($row['quantity'] <= $row['quantityFlag'] && $row['quantity'] > 0){
                                                    echo "Low on stock";
                                                }
                                            
                                                if($row['itemstatus'] == 0 && $row['brandstatus'] == 0){
                                                    echo 'Brand Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['brandstatus'] == 0 && $row['catstatus'] == 0){
                                                    echo 'Brand Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['catstatus'] == 1 && $row['brandstatus'] == 1){
                                                    echo 'Item Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['catstatus'] == 0 && $row['brandstatus'] == 1){
                                                    echo 'Category Discontinued';
                                                } else {
                                                    if($row['quantity'] > $row['quantityFlag']){
                                                        echo "In stock";
                                                    } 
                                                }
                                                ?>
                                            </td>
                                            <td><?php 
                                                
                                                if($row['quantity'] == 0){
                                                    echo "<a href='booking.php?itID=".$row['itemID']."&ccat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."&u=".$_SESSION['userID']."'><button class='btn btn-primary'>Book</button></a>";
                                                }
                                                if($row['quantity'] <= $row['quantityFlag'] && $row['quantity'] > 0){
                                                    echo "<a href='booking.php?itID=".$row['itemID']."&cat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."&u=".$_SESSION['userID']."'><button class='btn btn-primary'>Book</button></a>";
                                                }
                                            
                                                if($row['itemstatus'] == 0 && $row['brandstatus'] == 0){
                                                    echo 'Brand Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['brandstatus'] == 0 && $row['catstatus'] == 0){
                                                    echo 'Brand Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['catstatus'] == 1 && $row['brandstatus'] == 1){
                                                    echo 'Item Discontinued';
                                                } else if($row['itemstatus'] == 0 && $row['catstatus'] == 0 && $row['brandstatus'] == 1){
                                                    echo 'Category Discontinued';
                                                } else {
                                                    if($row['quantity'] > $row['quantityFlag']){
                                                        echo "<a href='booking.php?itID=".$row['itemID']."&cat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."&u=".$_SESSION['userID']."'><button class='btn btn-primary'>Book</button></a>";
                                                    } 
                                                }
                                                ?>
                                            </td>
                                            <td><?php 
                                        
                                        if($row['quantity'] == 0){
                                            
                                            ?>
                                                <button type="button" id="<?php echo $row['itemID']; ?>" name="restock"
                                                    data-toggle="modal" data-target="#modal-lg-restock"
                                                    class="btn btn-danger btn-xs restock">Not Avaiable</button>
                                                <?php
                                        }
                                        if($row['quantity'] <= $row['quantityFlag'] && $row['quantity'] > 0){
                                            ?>
                                                <button type="button" id="<?php echo $row['itemID']; ?>" name="restock"
                                                    data-toggle="modal" data-target="#modal-lg-restock"
                                                    class="btn btn-danger btn-xs restock">Not Avaiable</button>
                                                <?php
                                        }
                                       
                                        if($row['itemstatus'] == 0 && $row['brandstatus'] == 0){
                                            ?>
                                                <button type="button" id="<?php echo $row['brandID']; ?>"
                                                    name="continuebrand"
                                                    class="btn btn-primary btn-xs continuebrand">Continue Brand</button>
                                                <?php
                                        } else if($row['itemstatus'] == 0 && $row['brandstatus'] == 0 && $row['catstatus'] == 0){
                                            ?>
                                                <button type="button" id="<?php echo $row['brandID']; ?>"
                                                    name="continuebrand"
                                                    class="btn btn-primary btn-xs continuebrand">Continue Brand</button>
                                                <?php
                                        } else if($row['itemstatus'] == 0 && $row['catstatus'] == 1 && $row['brandstatus'] == 1){
                                            ?>
                                                <button type="button" id="<?php echo $row['itemID']; ?>"
                                                    name="continueitem"
                                                    class="btn btn-warning btn-xs continue-item">Continue Item</button>
                                                <?php
                                        } else if($row['itemstatus'] == 0 && $row['catstatus'] == 0 && $row['brandstatus'] == 1){
                                            ?>
                                                <button type="button" id="<?php echo $row['catID']; ?>"
                                                    name="continuecat"
                                                    class="btn btn-outline-primary btn-xs continue-cat">Continue
                                                    Category</button>
                                                <?php
                                        } else {
                                            if($row['quantity'] > $row['quantityFlag']){
                                                ?>

                                                <?php
                                            } 
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
                    <div class="card">
                        <div class="card-header row">
                            <div class="col col-sm-3">
                                <div class="card-options d-inline-block">
                                   
                                </div>
                            </div>

                            <div class="col col-sm-6">
                            <p style="text-align: center;">   <?php echo $getCustomerDetails['firstname'].' '.$getCustomerDetails['othername'].' '.$getCustomerDetails['lastname']."'s Installment Payment - Wedding Dress"; ?></p>

                                <div class="card-search with-adv-search dropdown">
                                    <?php
                                    
                    
                                    $getPaid  = getAllNotYetPaidBooking($database, $getPassedID);
                                    
                                    
                                    ?>



                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>

                                        
                                        <th>Wedding Type</th>
                                        <th>Size</th>
                                        <th>Balance</th>
                                        <th>Date of Use</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($getPaid){
                                            while($row = mysqli_fetch_array($getPaid)){
                                                    echo "<tr>
                                                    <td> ".$row['type']." </td>
                                                    <td> ".$row['size']." </td>
                                                    <td> ZMK ".($row['totalBill'] - $row['amountPaid'])." </td>
                                                    <td> ".$row['dateOfUse']." </td>
                                             
                                                    <tr>";
                                            
                                            }
                                        }else{
                                    ?>


                                    <tr>
                                        <td colspan="5">No Data Found</td>
                                    </tr>
                                            <?php
                                                }
                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header row">
                            <div class="col col-sm-3">
                                <div class="card-options d-inline-block">
                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#fullwindowModal"><i
                                            class="ik ik-plus"></i></a>
                                    <a href="customers.php" style="cursor: pointer;"><i class="ik ik-rotate-cw"></i></a>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="card-search with-adv-search dropdown">   
                                 <p style="text-align: center;">  
                                  <?php echo $getCustomerDetails['firstname'].' '.$getCustomerDetails['othername'].' 
                                  '.$getCustomerDetails['lastname']."'s Paid For wedding dress"; ?></p>

                                    <?php
                                    $getPaid  = getAllPaidBooking($database, $getPassedID);
                                    ?>



                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>

                                        
                                        <th>Wedding Type</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Balance</th>
                                        <th>Date of Use</th>
                                        <th>Contract Signed</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($getPaid){
                                            while($row = mysqli_fetch_array($getPaid)){
                                                    echo "<tr>
                                                    <td> ".$row['type']." </td>
                                                    <td> ".$row['size']." </td>
                                                    <td> ".$row['quantity']." </td>
                                                    <td> ZMK ".($row['totalBill'] - $row['amountPaid'])." </td>
                                                    <td> ".$row['dateOfUse']." </td>
                                                    ";

                                                    // if(checkContract($database, $getCustomerDetails['customerID'], $row['ptID'])){
                                                    //     echo "<td> <a href='contract.php?cusID=". $getCustomerDetails['customerID']."&ptID=".$row['ptID']."&signed=true'> <button>View Signed Contract</button> </a> </td>
                                                    //     <tr>";
                                                    // }else{
                                                    //     echo "<td> <a href='contract.php?cusID=". $getCustomerDetails['customerID']."&ptID=".$row['ptID']."&signed=false'> <button>Sign Contract</button> </a> </td>
                                                    //     <tr>";
                                                    // }

                                                 
                                            
                                            }
                                        }else{
                                    ?>


                                    <tr>
                                        <td colspan="5">No Data Found</td>
                                    </tr>
                                    <?php
                                                    }
                                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header row">
                            <div class="col col-sm-3">
                                <div class="card-options d-inline-block">
                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#fullwindowModal"><i
                                            class="ik ik-plus"></i></a>
                                    <a href="customers.php" style="cursor: pointer;"><i class="ik ik-rotate-cw"></i></a>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">   
                                 <p style="text-align: center;">  
                                  <?php echo $getCustomerDetails['firstname'].' '.$getCustomerDetails['othername'].' 
                                  '.$getCustomerDetails['lastname']."'s Paid not used wedding dress"; ?></p>

                                    <?php
                                    $getPaid  = checkPastReturnDateSingle($database, $getPassedID);
                                    ?>



                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>

                                        
                                        <th>Wedding Type</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Days Over Due</th>
                                        <th>Return Date Balance</th>
                                        <th>Date of Use</th>
                                        <th>Date of Return</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                        if($getPaid){
                                            while($row = mysqli_fetch_array($getPaid)){
                                              

                                                $returnDate = new DateTime($row['dateOfReturn']);
                                                $actualDate = new DateTime(date("Y-m-d"));
                                                $difference = $returnDate->diff($actualDate);

                                                    echo "<tr>
                                                    <td> ".$row['type']." </td>
                                                    <td> ".$row['size']." </td>
                                                    <td> ".$row['quantity']." </td>
                                                    <td> ".$difference->d." Days </td>
                                                    <td> ZMK ".($difference->d * 100)." </td>
                                                    <td> ".$row['dateOfUse']." </td>
                                                    <td> ".$row['dateOfReturn']." </td>
                                                    ";



                                                
                                            
                                            }
                                        }else{
                                    ?>


                                    <tr>
                                        <td colspan="5">No Data Found</td>
                                    </tr>
                                    <?php
                                                    }
                                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header row">
                            <div class="col col-sm-3">
                                <div class="card-options d-inline-block">
                                    <a data-toggle="modal" style="cursor: pointer;" data-target="#fullwindowModal"><i
                                            class="ik ik-plus"></i></a>
                                    <a href="customers.php" style="cursor: pointer;"><i class="ik ik-rotate-cw"></i></a>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                            <div class="card-search with-adv-search dropdown">   
                                 <p style="text-align: center;">  
                                  <?php echo $getCustomerDetails['firstname'].' '.$getCustomerDetails['othername'].' 
                                  '.$getCustomerDetails['lastname']."'s Paid not used wedding dress"; ?></p>

                                    <?php
                                    $getPaid  = getAllRecordsForThisCustomer($database, $getPassedID);
                                    ?>



                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                        <table id="advanced_table" class="table">
                                <thead>
                                    <tr>

                                        
                                        <th>Wedding Type</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Days Over Due</th>
                                        <th>Return Date Balance</th>
                                        <th>Cost of Booking</th>
                                        <th>Date of Use</th>
                                        <th>Date of Return</th>
                                        <!-- <th>Notice </th> -->
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php   
                                        if($getPaid){
                                            while($row = mysqli_fetch_array($getPaid)){
                                              

                                                $returnDate = new DateTime($row['dateOfReturn']);
                                                $actualDate = new DateTime(date("Y-m-d"));
                                                $difference = $returnDate->diff($actualDate);

                                                    echo "<tr>
                                                    <td> ".$row['type']." </td>
                                                    <td> ".$row['size']." </td>
                                                    <td> ".$row['quantity']." </td>
                                                    <td> ".($row['overReturnDateAmount']/100)." Days </td>
                                                    <td> ZMK ".number_format($row['overReturnDateAmount'])." </td>
                                                    <td> ZMK ".number_format($row['amountPaid'])." </td>
                                                    <td> ".$row['dateOfUse']." </td>
                                                    <td> ".$row['dateOfReturn']." </td>
                                                    ";
                                            }
                                        }else{
                                    ?>
                                    <tr>
                                        <td colspan="5">No Data Found</td>
                                    </tr>
                                    <?php
                                                    }
                                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            
                    <div class="modal fade full-window-modal" id="fullwindowModal2" tabindex="-1" role="dialog"
                        aria-labelledby="fullwindowModalLabel2" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fullwindowModalLabel2">Edit User</h5>
                                    <button type="button" class="close closemodal" data-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body edituserprofile">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal"
                                        id="closemodal">Close</button>
                                    <button type="button" class="btn btn-primary" id="savechanges">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-lg">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">User Profile</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body customerprofile">

                                </div>
                                <div class="modal-footer justify-content-between">

                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->

                </div>
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
                                            <!-- <input type="text" id="quick-search" class="form-control"
                                                placeholder="Search..." />
                                            <i class="ik ik-search"></i> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body d-flex align-items-center">
                            <div class="container">
                                <div class="apps-wrap">
                                    <!-- <div class="app-item">
                                        <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                    </div>

                                    <div class="app-item">
                                        <a href="#"><i class="ik ik-mail"></i><span>Message</span></a>
                                    </div>
                                    <div class="app-item">
                                        <a href="#"><i class="ik ik-users"></i><span>Account</span></a>
                                    </div> -->
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

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
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
            <script src="plugins/d3/dist/d3.min.js"></script>
            <script src="plugins/c3/c3.min.js"></script>
            <script src="js/tables.js"></script>
            <script src="js/widgets.js"></script>
            <script src="js/charts.js"></script>
            <script src="dist/js/theme.min.js"></script>
            <script src="plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.all.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.min.js"></script>

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
            <script>
            (function(b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                    function() {
                        (b[l].q = b[l].q || []).push(arguments)
                    });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = 'https://www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-XXXXX-X', 'auto');
            ga('send', 'pageview');

            $('#addcustomer').click(function() {


                var firstname = document.getElementById("firstname").value;
                var othername = document.getElementById("othername").value;
                var lastname = document.getElementById("lastname").value;
                var nrc = document.getElementById("nrc").value;
                var address = document.getElementById("address").value;
                console.log(address);
                var contact = document.getElementById("contact").value;
                var email = document.getElementById("email").value;
                var city = document.getElementById('city').value;

                if (firstname !== '' && lastname !== '' && nrc !== '' &&
                    address !== '' && contact !== '' && email !== '' && city !== '') {

                    $.ajax({
                        url: 'registercustomer.php',
                        method: 'post',
                        data: {
                            firstname: firstname,
                            othername: othername,
                            lastname: lastname,
                            nrc: nrc,
                            address: address,
                            contact: contact,
                            email: email,
                            city: city
                        },
                        success: function(data) {
                            console.log(data);

                            if (data === 'exists') {
                                $.toast({
                                    heading: 'Warning',
                                    text: 'This username already exists',
                                    showHideTransition: 'slide',
                                    icon: 'warning',
                                    loaderBg: '#57c7d4',
                                    position: 'top-right'
                                });

                            }

                            if (data === '') {
                                $.toast({
                                    heading: 'success',
                                    text: 'Registration Successful.',
                                    showHideTransition: 'slide',
                                    icon: 'success',
                                    loaderBg: '#f96868',
                                    position: 'top-right'
                                });

                            }

                            if (data === 'unsuccessful') {
                                $.toast({
                                    heading: 'Danger',
                                    text: 'Could not register new user. Please try again.',
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

            function checkrolecombovalue() {
                var role = document.getElementById("role").value;
                console.log(role);
                if (role === '') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Please select a role',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                } else {
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

            function checkcitycombovalue() {
                var city = document.getElementById("city").value;
                console.log(city);
                if (city === '') {
                    $.toast({
                        heading: 'Warning',
                        text: 'Please select a role',
                        showHideTransition: 'slide',
                        icon: 'warning',
                        loaderBg: '#57c7d4',
                        position: 'top-right'
                    });
                } else {
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

            function checkuserexists() {
                var username = document.getElementById("username").value;
                $.ajax({
                    url: 'checkuserexists.php',
                    method: 'post',
                    data: {
                        username: username,

                    },
                    success: function(data) {
                        console.log(data);
                        if (data === 'exists') {
                            $.toast({
                                heading: 'Warning',
                                text: 'This username already exists',
                                showHideTransition: 'slide',
                                icon: 'warning',
                                loaderBg: '#57c7d4',
                                position: 'top-right'
                            });

                        }
                    }
                });

            }

            $(document).on("click", ".closemodal", function() {
                window.location.href = 'customers.php';
            });


            $(document).on("click", ".viewcustomer", function() {
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url: "customerprofile.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(html) {
                        $('.customerprofile').html(html);
                    }
                });
            });


            $(document).on("click", ".editcustomer", function() {
                var id = $(this).attr("id");
                console.log(id);
                $.ajax({
                    url: "editcustomerprofile.php",
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
                var id = document.getElementById("editcustomerid").value;
                console.log(id);
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
                var isactive;
                if (document.getElementById("editisactive_active").checked) {
                    isactive = 1;
                    console.log(isactive);
                } else {
                    isactive = 0;
                    console.log(isactive);
                }

                $.ajax({
                    url: "editcustomer.php",
                    type: "POST",
                    data: {
                        id: id,
                        firstname: firstname,
                        othername: othername,
                        lastname: lastname,
                        nrc: nrc,
                        email: email,
                        contact: contact,
                        city: city,
                        residential: residential,
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


            $(".deletecustomer").click(function() {
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
                                url: "deactivatecustomer.php",
                                method: "POST",
                                data: {
                                    id: id
                                },
                                success: function(data) {


                                    if (data === 'successful') {
                                        console.log(data);
                                        window.location.href = 'customers.php';
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
</body>

</html>