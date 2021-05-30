<?php
include './dbConnector.php';
if (!isset($_SESSION['userID'])) {
    header("location: logout.php");
}



if(isset($_POST['book_dress'])){


    $customer_id = mysqli_real_escape_string($database, $_POST['customer_id']);
    $brandID = mysqli_real_escape_string($database, $_POST['brandID_']);
    $size = mysqli_real_escape_string($database, $_POST['size']);
    $quatity = mysqli_real_escape_string($database, $_POST['quatity']);
    $dateofuse = mysqli_real_escape_string($database, $_POST['dateofuse']);
    $paymentPlan = mysqli_real_escape_string($database, $_POST['paymentPlan']);
    $price = mysqli_real_escape_string($database, $_POST['price']);
    $payment_amount = mysqli_real_escape_string($database, $_POST['payment_amount']);
    $dateofRuturn = mysqli_real_escape_string($database, $_POST['dateOfReturn']);
    $itemID = mysqli_real_escape_string($database, $_POST['itemID']);
    $type = mysqli_real_escape_string($database, $_POST['type']);

    $addUp = addNewBooking($database, $customer_id, $brandID, $dateofuse, $dateofRuturn, $paymentPlan, $price, $payment_amount, $size, $quatity, $type, $itemID);


    if($addUp === "Already_Booked"){
        echo "<script>alert('This ".$dateofuse." date is already booked.')</script>";
    }
    echo "<script> console.log('full payment - tracking ".$addUp."'); </script>";
    // }else if($addUp === false || $addUp === 0){
    //     echo "<script>alert('We encounter an error.')</script>";

    // }else if($addUp === "full_pay"){
    //     echo "<script>
    //          location.href = 'contract.php?cusID=".$customer_id."&ptID=".$_GET['ptID']."';
    //     </script>";
    // }
    // else{
    //     echo "<script>
    //             location.href = 'single_customer.php?id=".$customer_id."';
    //         </script>";
    // }

}


// get all brand

$getBrand = mysqli_query($database, "SELECT * FROM brand WHERE brandID = '".$_GET['brand']."'");

$getBrandRow = mysqli_fetch_assoc($getBrand);
$getBrandName = $getBrandRow['brand_name'];


// get all brand

$getCat = mysqli_query($database, "SELECT * FROM category WHERE catID = '".$_GET['cat']."'");

$getCatRow = mysqli_fetch_assoc($getCat);
$getCatName = $getCatRow['category_name'];

//End populate users into table

//Start populate customer combo box
$selectcustomer = "SELECT `customerID`, `firstname`, `othername`, `lastname`, `ID`, `contact`, `email`, `residentialArea`, `city`, `password`, `isActive` FROM `customer` WHERE customerID = '".$_GET['u']."' AND `isActive` = 1";

$customerresult = mysqli_query($database, $selectcustomer);
if(!$customerresult)
    echo mysqli_error($database);
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
    <title>LMS Booking</title>
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
                    <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                                <input name="itemID" hidden value="<?php echo $_GET['itID'];?>" />
                                                <div class="form-group">
                                                    <label for="brand">Select Customer</label>
                                                    <select name="customer_id" id="leasecustomername" class="form-control"
                                                        required>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                                <div class="form-group">
                                                    <label for="brand">Brand</label>
                                                    <input readonly name="brand" type="text" value="<?php echo $getBrandName; ?>" class="form-control" />
                                                    <input readonly name="brandID_" hidden type="text" value="<?php echo $_GET['brand']; ?>" class="form-control" />
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
                                                    <label for="category">Category</label>
                                                    <input readonly name="category" type="text" value="<?php echo $getCatName; ?>" class="form-control" />
                                                </div>
                                              
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                            <div class="form-group">
                                                    <label for="type">Type</label>
                                                    <select class="form-control" name="type">
                                                        <option>~Select Your Type~</option>
                                                        <option value="Silk">Silk</option>
                                                        <option value=""></option>
                                                    </select>
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
                                                    <label for="size">Size</label>
                                                    <select class="form-control" name="size">
                                                        <option>~Select Your Size~</option>
                                                        <option value="small">Small ~ Q <?php echo $_GET['s']; ?></option>
                                                        <option value="medium">Meduim ~ Q <?php echo $_GET['m']; ?></option>
                                                        <option value="large">Large ~ Q <?php echo $_GET['l']; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                                <div class="form-group">
                                                <label for="quantity">Quantity </label>

                                                    <input required min="0" max="<?php echo  $_GET['qua'];?>" type="number" name="quatity" class="form-control" />
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
                                                <label for="dateofuse">Date of Use </label>

                                                    <input type="date" name="dateofuse" class="form-control" required/>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            
                                            <div class="form-group">
                                                <label for="dateofuse">Date of Return  </label>

                                                    <input type="date" name="dateOfReturn" class="form-control" required/>
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
                                                <label for="brand">Price </label>

                                                    <input type="text" name="price" readonly  value="<?php echo $_GET['price'];?>" class="form-control" />
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="card-body">
                                            <div class="forms-sample">
                                            <label for="brand">Payment Plan</label>
                                                    <select name="paymentPlan" id="leasecustomername" class="form-control"
                                                        required>
                                                        <option value=""></option>
                                                        <option value="installments">Installments</option>
                                                        <option value="full">Full</option>
                                                    </select>
                                                <div class="form-group">
                                                    <!-- <label for="brand">Payment Amount</label> -->
                                                    <input value="0" hidden type="text" name="payment_amount"  class="form-control" />

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary" name="book_dress" value="Book" />
                            
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
            $custname = $('#leasecustomername');
            $leaseitembrand = $('#leaseitembrand');
            $leaseitemcategory = $('#leaseitemcategory');
            $leaseitem = $('#leaseitem');
            $leasereutrndate = $('#leasereutrndate');
       
            </script>
           
</body>

</html>