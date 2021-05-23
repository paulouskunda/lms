<?php
include './databaseconnector/dbConnector.php';
if (!isset($_SESSION['login_user'])) {
    header("location: logout.php");
}

if(isset($_POST['settle'])){
    $actualAmount = $_POST['price'];
    $paidAmount = $_POST['payment_amount'];
    $ptID = $_POST['ptID'];

    $settleMe = updateBookingPayment($database, $ptID, $paidAmount, $actualAmount);

    if($settleMe = "all_settled"){
        echo "<script>
                location.href = 'contract.php?cusID=".$_GET['cusID']."&ptID=".$_GET['ptID']."';
            </script>";
    }else{
        echo "<script>
                location.href = 'single_customer.php?id=".$_GET['cusID']."';
            </script>";
    }
}

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LMS Booking</title>
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
                                    <!-- <a href="users.php" class="menu-item">Users</a> -->
                                    <a href="customers.php" class="menu-item">Customers</a>
                                    <!-- <a href="#" class="menu-item">Roles</a> -->

                                </div>
                            </div>
                            <div class="nav-item has-sub active open">
                                <a href="#"><i class="ik ik-layers "></i><span>Store Management</span></a>
                                <div class="submenu-content">
                                    <a href="inventory.php" class="menu-item">Inventory</a>
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
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <form method="POST" action="">
                            <input readonly hidden name="ptID"  type="text" value="<?php echo $_GET['ptID']; ?>" class="form-control" />
                            <input readonly hidden name="actualAmount"  type="text" value="<?php echo $_GET['ac']; ?>" class="form-control" />

                          
                            
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                            <div class="form-group">
                                                <label for="dateofuse">Date of Use </label>

                                                    <input type="date" readonly name="dateofuse" value="<?php echo $_GET['du']; ?>" class="form-control" required/>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                            <div class="form-group">
                                                <label for="dateofuse">Date of Return  </label>

                                                    <input type="date" readonly name="dateOfReturn" value="<?php echo $_GET['dr']; ?>" class="form-control" required/>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                            <div class="form-group">
                                                <label for="brand">Balance </label>

                                                    <input type="text" name="price" readonly  value="<?php echo $_GET['b'];?>" class="form-control" />
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                                <div class="form-group">
                                                    <label for="brand">Payment Amount</label>
                                                    <input type="number" min="1" max="<?php echo $_GET['b'];?>" name="payment_amount" required class="form-control" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" name="settle" value="Settle Balance" />
                            
                            </form>
                        </div>

       
                  
                    </div>
                  
                </div>
            </div>
        
          
  

            <div class="modal fade apps-modal" id="appsModal" tabindex="-1" role="dialog"
                aria-labelledby="appsModalLabel" aria-hidden="true" data-backdrop="false">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i
                        class="ik ik-x-circle"></i></button>
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      
                        <div class="modal-body d-flex align-items-center">
                            <div class="container">
                                <div class="apps-wrap">
                                    <!-- <div class="app-item">
                                        <a href="#"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                                    </div> -->
<!-- 
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
    
           
</body>

</html>