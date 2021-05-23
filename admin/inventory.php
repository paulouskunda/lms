<?php
include './databaseconnector/dbConnector.php';
if (!isset($_SESSION['login_user'])) {
    header("location: logout.php");
}

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
    <title>LMS Inventory</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/select2/dist/css/select2.min.css">
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
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link rel="stylesheet" href="plugins/jquery-toast-plugin/dist/jquery.toast.min.css">
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

                        <button type="button" class="nav-link ml-10" id="apps_modal_btn" data-toggle="modal"
                            data-target="#appsModal"><i class="ik ik-grid"></i></button>

                    </div>
                </div>
            </div>
        </header>

        <div class="page-wrap">
            <div class="app-sidebar colored">
                <div class="sidebar-header">
                    <a class="header-brand" href="dashboard.php">
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
                                    <!-- <a href="users.php" class="menu-item">Users</a> -->
                                    <a href="customers.php" class="menu-item">Customers</a>
                                    <!-- <a href="#" class="menu-item">Roles</a> -->

                                </div>
                            </div>
                            <div class="nav-item has-sub active open">
                                <a href="#"><i class="ik ik-layers"></i><span>Store Management</span></a>
                                <div class="submenu-content">
                                    <a href="inventory.php" class="menu-item active">Inventory</a>
                                    <a href="lease.php" class="menu-item">Lease</a>
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
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#fullwindowModal" style="cursor: pointer;">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Brand</h6>
                                                <h2><?php echo $brandrow['brandcount'];?></h2>
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
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#fullwindowModal2" style="cursor: pointer;">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Category</h6>
                                                <h2><?php echo $categoryrow['catcount'];?></h2>
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
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <a href="#" data-toggle="modal" data-target="#fullwindowModal3" style="cursor: pointer;">
                                <div class="widget">
                                    <div class="widget-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="state">
                                                <h6>Item</h6>
                                                <h2><?php echo $itemrow['itemcount'];?></h2>
                                            </div>
                                            <div class="icon">
                                                <i class="ik ik-award"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="31"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <table id="advanced_table" class="table">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Small Quantity</th>
                                            <th>Medium Quantity</th>
                                            <th>Large Quantity</th>
                                            <th>Total Quantity</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Lead</th>
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
                                            <td><?php echo $row['small'];?></td>
                                            <td><?php echo $row['medium'];?></td>
                                            <td><?php echo $row['large'];?></td>
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
                                                    echo "<a href='booking.php?itID=".$row['itemID']."&ccat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."'><button class='btn btn-primary'>Book</button></a>";
                                                }
                                                if($row['quantity'] <= $row['quantityFlag'] && $row['quantity'] > 0){
                                                    echo "<a href='booking.php?itID=".$row['itemID']."&cat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."'><button class='btn btn-primary'>Book</button></a>";
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
                                                        echo "<a href='booking.php?itID=".$row['itemID']."&cat=".$row['catID']."&brand=".$row['brandID']."&qua=".$row['quantity']."&price=".$row['price']."&s=".$row['small']."&m=".$row['medium']."&l=".$row['large']."'><button class='btn btn-primary'>Book</button></a>";
                                                    } 
                                                }
                                                ?>
                                            </td>
                                            <td><?php 
                                        
                                        if($row['quantity'] == 0){
                                            
                                            ?>
                                                <button type="button" id="<?php echo $row['itemID']; ?>" name="restock"
                                                    data-toggle="modal" data-target="#modal-lg-restock"
                                                    class="btn btn-danger btn-xs restock">Restock</button>
                                                <?php
                                        }
                                        if($row['quantity'] <= $row['quantityFlag'] && $row['quantity'] > 0){
                                            ?>
                                                <button type="button" id="<?php echo $row['itemID']; ?>" name="restock"
                                                    data-toggle="modal" data-target="#modal-lg-restock"
                                                    class="btn btn-danger btn-xs restock">Restock</button>
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
                                            <td><button type="button" id="<?php echo $row['itemID']; ?>" name="edit"
                                                    data-toggle="modal" data-target="#modal-lg-edit"
                                                    class="btn edit-item"><i class="ik ik-edit"></i></button></td>
                                            <td></td>

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


            <div class="modal fade full-window-modal" id="fullwindowModal" tabindex="-1" role="dialog"
                aria-labelledby="fullwindowModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fullwindowModalLabel">Brand</h5>
                            <a class="btn btn-success" id="add" style="margin-left: 20px;">New</a>
                            <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body brand">
                            <div class="card">
                                <div class="card-body">
                                    <table id="brand_table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Brand</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="content">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="modal fade full-window-modal" id="fullwindowModal2" tabindex="-1" role="dialog"
                aria-labelledby="fullwindowModalLabel2" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fullwindowModalLabel2">Categories</h5>
                            <a class="btn btn-success" id="addcat" style="margin-left: 20px;">New</a>
                            <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body cat">
                            <div class="card">
                                <div class="card-body">
                                    <table id="cat_table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="contentcat">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                  
                                                        
            <div class="modal fade full-window-modal" id="fullwindowModal3" tabindex="-1" role="dialog"
                aria-labelledby="fullwindowModalLabel3" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="fullwindowModalLabel3">Categories</h5>
                            <button type="button" class="close closemodal" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body item">
                            <form method="POST" action="registeritem.php">
                            <div class="col-md-6">
                                <label for="brand">Select Brand</label>
                                        <select name="brand" id="additembrand"
                                            class="form-control select2"
                                            onchange="checkbrandcombovalue()" required>
                                            <option value=""></option>
                                            <?php
                                                if ($brandNum > 0) {
                                                    while ($row2 = mysqli_fetch_array($brandResult)) {
                                                        ?>
                                                        <option value="<?php echo $row2['brandID']; ?>">
                                                            <?php echo $row2['brand_name']; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                        </select>
                                        <label for="category">Select Category</label>
                                        <select name="category" id="additemcategory" class="form-control"
                                            onchange="checkcatcombovalue()" required>
                                            <option value=""></option>
                                            <?php
                                        if ($categoryNum > 0) {
                                            while ($row3 = mysqli_fetch_array($categoryResult)) {
                                                ?>
                                            <option value="<?php echo $row3['catID']; ?>">
                                                <?php echo $row3['category_name']; ?></option>
                                            <?php
                                            }
                                        }
                                        ?>
                                        </select>
                                        <label for="itemprice">Item Price <small style="color:blue;">
                                                            Item price cannot contain
                                                            letters</small></label>
                                        <input type="number" class="form-control" id="itemprice"
                                            title="Item price cannot contain letters" name="price"
                                            onblur="checkifempty('itemprice'); checkPattern('itemprice')"
                                            placeholder="Item Price" pattern="[0-9]+" required>
                            </div>
                            <div class="col-md-6">
                                    <label for="brand">Quatity for Small</label>
                                    <input type="number" onblur="checkifempty('small_quantity'); checkPattern('small_quantity')"
                                                        pattern="[0-9]+" id="small_quantity" name="small_quantity" placeholder="10" class="form-control" />
                                    <label for="brand">Quatity for Medium</label>
                                    <input type="number" onblur="checkifempty('medium_quantity'); checkPattern('medium_quantity')"
                                                        pattern="[0-9]+" id="medium_quantity" name="medium_quantity" placeholder="10" class="form-control" />
                                    <label for="brand">Quatity for Large</label>
                                    <input type="number" onblur="checkifempty('large_quantity'); checkPattern('large_quantity')"
                                                        pattern="[0-9]+" id="large_quantity" name="large_quantity" placeholder="10" class="form-control" />
                                                                       
                            
                            </div>
                          <br>  <input type="submit" class="btn btn-primary" name="submit" value="save"/>

                            </form>
                       
                   
                            
                        </div>
                       

                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close closeselect" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body selectdeactivation">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="done">Done</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-lg-restock">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body restockcontent">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="restockdone">Restock</button>
                        </div>

                    </div>
                    <!-- /.modal-content -->

                </div>
                <!-- /.modal-dialog -->
            </div>

            <div class="modal fade" id="modal-lg-edit">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body editcontent">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal"
                                id="closemodal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="editdone">Save</button>
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
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body d-flex align-items-center">
                            <div class="container">
                                <div class="apps-wrap">
                                 
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
            <script src="plugins/moment/moment.js"></script>
            <script src="plugins/tempusdominus-bootstrap-4/build/js/tempusdominus-bootstrap-4.min.js"></script>
            <script src="plugins/d3/dist/d3.min.js"></script>
            <script src="plugins/c3/c3.min.js"></script>
            <script src="js/tables.js"></script>
            <script src="js/widgets.js"></script>
            <script src="js/charts.js"></script>
            <script src="js/inventory.js"></script>
            <script src="js/form-advanced.js"></script>
            <script src="dist/js/theme.min.js"></script>
            <script src="plugins/jquery-toast-plugin/dist/jquery.toast.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.all.min.js"></script>
            <script src="plugins/sweetalert2-8.13.5/package/dist/sweetalert2.min.js"></script>
            <script src="plugins/select2/dist/js/select2.min.js"></script>

            <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

            <script>
            // $(".select2").select2();
            </script>

</body>

</html>