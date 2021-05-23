<?php

    include './databaseconnector/dbConnector.php';  

    $getCus = $_GET['cusID'];
    $ptID = $_GET['ptID'];

    // $select_contracts = mysqli_query("SELECT * FROM contracts WHERE cusID='$getCus' AND ptID";
    $selectCustomer = mysqli_query($database, "SELECT customer.*, payment_tracking.*, brand.* FROM customer, payment_tracking,  brand 
                    WHERE customer.customerID = '$getCus'
                    AND payment_tracking.customerID  = '$getCus'
                    AND payment_tracking.ptID =  '$ptID'
                    AND brand.brandID= payment_tracking.brandID");
    
    $details = mysqli_fetch_assoc($selectCustomer);

?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>LMS Contract Between  <strong><?php echo $details['firstname']." ".$details['othername']." ".$details['lastname']; ?></strong> </title>
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
    <style>
    @media print{
   .noprint{
       display:none;
   }
}</style>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="main-content">
                <div class="container-fluid">
                    <div class="row clearfix">
                       <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2>Agreement Contract </h2>
                            <p> This contract is an agreement between <strong>LMS</strong> (owner) and <strong><?php echo $details['firstname']." ".$details['othername']." ".$details['lastname']; ?></strong>  (Client) of NRC Number <strong><?php echo $details['ID']; ?></strong> , 
                            Address,  <strong><?php echo $details['residentialArea']; ?></strong>Phone Number  <strong><?php echo $details['contact']; ?></strong>
                                on <strong> <?php echo date("m/d/Y"); ?> </strong>(Date). </p>

                            <p> The client has received the wedding dress in an okay condition. </p>
                            The total value of the aforementioned item is  <strong><?php echo $details['totalBill']; ?></strong>, the client has checked and received all the items has agreed to return all items 
                            on  <strong><?php echo $details['dateOfReturn']; ?></strong> (return date). </p>

                            <p> If the client fails to return the dress on the return date, a charge of 100 per day, shall be invoked, with the counting
                            starting from the next day after the return date. </p>


                            <p> If the client loses or damages the dress or any other received item beyond repair, he/she liable to pay, shall be invoked,
                                with the counting starting from the next day after return date. </p>


                            <p>  </p>

                                <form action="" method="">
                                    <label>Any extra details?</label>
                                    <textarea class="form-control" name="other_details" placeholder="Do you have any information..."></textarea>
                                    <input type="submit"  class="print" name="submit" value="Agreed"/>
                                </form>
                       
                        </div>

       
                  
                    </div>
                  
                </div>
            </div>
        
</body>
</html>