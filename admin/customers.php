<?php
include './databaseconnector/dbConnector.php';
if (!isset($_SESSION['login_user'])) {
    header("location: logout.php");
}

//Start populate users into table
$selectCustomer = "SELECT `customerID`,`firstname`,`othername`,`lastname` FROM `customer` WHERE `isActive` = 1";

$result = mysqli_query($database, $selectCustomer);

$num = mysqli_num_rows($result);
//End populate users into table

//Start populate role combo box
$getRoles = "SELECT `roleID`,`role_title` FROM roles WHERE `role_title` = 'customer'";

$roleResult = mysqli_query($database, $getRoles);

$roleNum = mysqli_num_rows($roleResult);
//End populate role combo box
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
                        <span class="text">ReadToWed</span>
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
                            <div class="nav-item has-sub">
                                <a href="#"><i class="ik ik-layers"></i><span>Store Management</span></a>
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
                                    <form action="">
                                        <input type="text" class="form-control global_filter" id="global_filter"
                                            placeholder="Search.." required>
                                        <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>

                                    </form>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <table id="advanced_table" class="table">
                                <thead>
                                    <tr>
                                        <th width="50">
                                            <i class="ik ik-play"></i>
                                        </th>
                                        <th>First Name</th>
                                        <th>Other Name</th>
                                        <th>Last Name</th>
                                        <th>Report</th>
                                        <th></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if($num > 0){
                                            while($row = mysqli_fetch_array($result)){

                                                            //`firstname`,`othername`,`lastname`,`identification_number`,`contact`,`email`,`residentialAddress`,`city`,`isActive`
                                                    ?>
                                    <tr id="<?php echo $row['userID'];?>">
                                        <td>
                                            <a class="viewcustomer" id="<?php echo $row['customerID'];?>"
                                                data-toggle="modal" data-target="#modal-lg" style="cursor: pointer;"><i
                                                    class="ik ik-eye"></i></a>
                                            <a class="editcustomer" id="<?php echo $row['customerID'];?>"
                                                data-toggle="modal" data-target="#fullwindowModal2" style="cursor: pointer;
                                            margin-left: 5px; margin-right: 5px;"><i class="ik ik-edit"></i></a>
                                            <a class="deletecustomer" style="cursor: pointer; color:red;"
                                                id="<?php echo $row['customerID'];?>"><i class="ik ik-x"></i></a>
                                        </td>

                                        <td><?php echo $row['firstname'];?></td>
                                        <td><?php echo $row['othername'];?></td>
                                        <td><?php echo $row['lastname'];?></td>
                                        <td><a href="single_customer.php?id=<?php echo  $row['customerID']; ?>"><button class="btn btn-primary">View Report</button</a></td>
                                        <td></td>



                                    </tr>
                                    <?php
                                                      }
                                                    } else {
                                                        ?>


                                    <tr>
                                        <td colspan="3">No Data Found</td>
                                    </tr>
                                    <?php
                                                    }
                                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal fade full-window-modal" id="fullwindowModal" tabindex="-1" role="dialog"
                        aria-labelledby="fullwindowModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fullwindowModalLabel">Register Customer</h5>
                                    <button type="button" class="close closemodal" data-dismiss="modal"
                                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="card-body">
                                                    <div class="forms-sample">

                                                        <div class="form-group">
                                                            <label for="firstname">First name <small
                                                                    style="color:blue;"> First name cannot contain
                                                                    number</small></label>
                                                            <input type="text" class="form-control" id="firstname"
                                                                title="First name cannot contain number"
                                                                onblur="checkifempty('firstname'); checkPattern('firstname')"
                                                                placeholder="First name" pattern="[A-Za-z]+" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="othername">Other name <small
                                                                    style="color:blue;"> Other name cannot contain
                                                                    number</small></label>
                                                            <input type="text" class="form-control" id="othername"
                                                                title="Other name cannot contain number"
                                                                onblur="checkPattern('othername')"
                                                                placeholder="Other name" pattern="[A-Za-z]+">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="lastname">Last name <small style="color:blue;">
                                                                    Last name cannot contain number</small></label>
                                                            <input type="text" class="form-control" id="lastname"
                                                                title="Last name cannot contain number"
                                                                onblur="checkifempty('lastname'); checkPattern('lastname')"
                                                                placeholder="Last name" pattern="[A-Za-z]+" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nrc">NRC <small style="color:blue;"> Format
                                                                    ------/--/-</small></label>
                                                            <input type="text" class="form-control" id="nrc"
                                                                placeholder="NRC" pattern="(([0-9]{6})+/([0-9]{2})+/\d)"
                                                                title="Format ------/--/-"
                                                                onblur="checkifempty('nrc'); checkPattern('nrc')"
                                                                required>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="card-body">
                                                    <div class="forms-sample">
                                                        <div class="form-group">
                                                            <label for="contact">Contact <small style="color:blue;"> Use
                                                                    correct format 09-- ------</small></label>
                                                            <input type="text" class="form-control" id="contact"
                                                                placeholder="Contact"
                                                                title="Use correct format 09-- ------"
                                                                onblur="checkifempty('contact'); checkPattern('contact')"
                                                                pattern="(([0-9]{2})+(\d)+([0-9]{7}))" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email address <small style="color:blue;">
                                                                    Email should contain @ and .</small></label>
                                                            <input type="email" class="form-control" id="email"
                                                                placeholder="Email" title="Email should contain @ and ."
                                                                onblur="checkifempty('email'); checkPattern('email')"
                                                                pattern="[a-zA-Z0-9!#$%&amp;'*+\/=?^_`{|}~.-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="city">Select City <small style="color:blue;">
                                                                    Please select an option</small></label>
                                                            <select name="city" id="city" class="form-control"
                                                                onchange="checkcitycombovalue()" required>
                                                                <option value=""></option>
                                                                <option value="Kabwe">Kabwe</option>
                                                                <option value="Kitwe">Kitwe</option>
                                                                <option value="LivingStone">LivingStone</option>
                                                                <option value="Lusaka">Lusaka</option>
                                                                <option value="Ndola">Ndola</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="address">Residential Address <small
                                                                    style="color:blue;"> Please provide residential
                                                                    address</small></label>
                                                            <input type="text" class="form-control" id="address"
                                                                placeholder="Residential Address"
                                                                title="Please provide residential"
                                                                onblur="checkifempty('address');" required>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary closemodal" data-dismiss="modal"
                                        id="closemodal">Close</button>
                                    <button type="button" class="btn btn-primary" id="addcustomer">Save</button>
                                </div>
                            </div>
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