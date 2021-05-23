<?php
include './databaseconnector/dbConnector.php';
if (!isset($_SESSION['login_user'])) {
    header("location: logout.php");
}

$itemPick = "";
//Start populate users into table


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
    <title>LMS Report</title>
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
                                <a href="javascript:void(0)"><i class="ik ik-users"></i><span>Customer Management</a>
                                <div class="submenu-content">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                            <div class="card-head">
                                    </div>
                                    <div class="card-body">
                                        <table id="advanced_table" class="table advanced_table">
                                    </div>
                                <?php 
                                
                                if(isset($_POST['submit_report'])){

                                    $typeOfReport = $_POST['reportType'];
                                    $startDate = $_POST['startDate'];
                                    $endDate = $_POST['endDate'];

                                    if($typeOfReport === "allHired"){
                                        echo '<thead>
                                                <tr>
                                                    <th>Leased Item</th>
                                                    <th>Quantity</th>
                                                    <th>Size</th>
                                                    <th>Amount</th>
                                                    <th>Paid Amount</th>
                                                    <th>Use Date</th>
                                                    <th>Return Date</th>
                                                    <th>Paid In Full</th>
                                                    <th></th>
                                                </tr>
                                            </thead>';

                                            $select = mysqli_query($database, "SELECT b.brand_name, b.brandID, p.size, p.quantity, p.size, p.totalBill, p.amountPaid, p.dateOfUse, p.dateOfReturn, p.statusOfPayment
                                                                                FROM payment_tracking as p, brand as b
                                                                                 WHERE p.brandID = b.brandID");
                                            if(mysqli_num_rows($select)>0){

                                                while($rows =  mysqli_fetch_assoc($select)){
                                                    echo '
                                                        <tbody> 
                                                            <tr>
                                                            <td>'.$rows['brand_name'].'</td>
                                                            <td>'.$rows['quantity'].'</td>
                                                            <td>'.$rows['size'].'</td>
                                                            <td>'.$rows['totalBill'].'</td>
                                                            <td>'.$rows['amountPaid'].'</td>
                                                            <td>'.$rows['dateOfUse'].'</td>
                                                            <td>'.$rows['dateOfReturn'].'</td>
                                                            ';
                                                            if($rows['totalBill'] === $rows['amountPaid'])
                                                                echo '                                                          
                                                                <td>Full</td>';
                                                            else
                                                                echo '                                                          
                                                                <td> Balance '.($rows['totalBill'] - $rows['amountPaid']).'</td>';
                                                        
                                                            echo '                                                          
                                                                <td></td>

                                                            </tr>                                              
                                                        </tbody>
                                                        ';
                                                }

                                            }else{

                                            }
                                    } else if($typeOfReport === "moneyGenerated"){
                                        
                                        echo '<thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amount Generated</th>
                                            <th></th>
                                        </tr>
                                    </thead>';

                                    $sql = mysqli_query($database, "SELECT SUM(amountPaid) AS TotalPaid, SUM(overReturnDateAmount) as OverReturned FROM payment_tracking
                                    WHERE dateOfPayment BETWEEN '$startDate' AND '$endDate'");
                                    $counterUp = 1;
                                        while($rows = mysqli_fetch_assoc($sql)){
                                            $totalAmount =  $rows['TotalPaid']+$rows['OverReturned'];
                                            echo '
                                            <tbody> 
                                                <tr>
                                                <td>'.$counterUp.'</td>
                                                <td>'.$startDate.'</td>
                                                <td>'.$endDate.'</td>
                                                <td>ZMK '.number_format($totalAmount).'</td>
                                                <td></td>

                                                </tr>                                              
                                            </tbody>
                                            ';
                                        }
                                    } else if($typeOfReport === "overDue"){
                                        echo '<thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Amount Generated</th>
                                            <th></th>
                                        </tr>
                                    </thead>';

                                        $sql = mysqli_query($database, "SELECT SUM(amountPaid) AS TotalPaid, SUM(overReturnDateAmount) as OverReturned FROM payment_tracking
                                            WHERE dateOfPayment BETWEEN '$startDate' AND '$endDate'");
                                        $counterUp = 1;
                                        while($rows = mysqli_fetch_assoc($sql)){
                                            echo '
                                            <tbody> 
                                                <tr>
                                                <td>'.$counterUp.'</td>
                                                <td>'.$startDate.'</td>
                                                <td>'.$endDate.'</td>
                                                <td>'.$rows['OverReturned'].'</td>
                                                <td></td>

                                                </tr>                                              
                                            </tbody>
                                            ';
                                        }
                                    }

                                  
                                }
                              
                                
                                ?>
                                   </table>
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


            <script type="text/javascript">
            var selectedValue;
            function onSelectCategory(select){

                selectedValue = select.value;
                console.log("<?php echo $itemPick; ?>");
                console.log(select.value);
                console.log(leaseitembrand.value);
                document.getElementById('itemSelect').style.display = "block";
               
                console.log('Here from '+selectedValue);
            }

            function onSelectItem(select){

            }


            </script>
            <?php echo "<script>console.log('Here from '+selectedValue); </script>"; ?>
</body>

</html>