<?php
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login LMS</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="plugins/toastr/build/toastr.min.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-3 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('img/auth/ecommerce.jpg')">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="#"><img src="" alt=""></a>
                        </div>
                        <h3>ReadyToWed</h3>
                     
                                <form>
                                    <div class="row">
                                    <div class="col-xl-4">
                                        <div class="form-group">
                                            <label for="firstname">First name <small
                                                    style="color:blue;"> Cannot contain
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
                                    </div>


                                    <div class="col-xl-4">
                                           
                                            <div class="form-group">
                                                <label for="nrc">NRC <small style="color:blue;"> Format
                                                        ------/--/-</small></label>
                                                <input type="text" class="form-control" id="nrc"
                                                    placeholder="NRC" pattern="(([0-9]{6})+/([0-9]{2})+/\d)"
                                                    title="Format ------/--/-"
                                                    onblur="checkifempty('nrc'); checkPattern('nrc')"
                                                    required>
                                            </div>

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

                                    </div>


                                    <div class="col-xl-4">
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
                    
                                    


                                                <input type="submit"/>
                                           

                                                </form>
                        <!-- <form action="session.php" method="POST">
                        <div class="form-group">
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control"
                                required="">
                            <i class="ik ik-user"></i>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Password" required="">
                            <i class="ik ik-lock"></i>
                        </div>

                        <div class="sign-btn text-center">
                            <button class="btn btn-theme" type="submit" id="submit">Sign In</button>
                        </div>

                        </form> -->
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
    <script src="dist/js/theme.js"></script>
    <script src="plugins/toastr/build/toastr.min.js"></script>
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
    </script>
    <!--Script for form verification and ajax login-->

    <script>
    $(document).ready(function() {

        $("#username").focusout(function() {
            checkuser();
        });

        $("#password").focusout(function() {
            checkpassword();
        });

        // disableSubmitButton();

        $("#submit").click(function() {
            var username = $("#username").val();
            var password = $("#password").val();
            // console.log(username);
            // console.log(password);

            $.ajax({
                type: 'POST',
                url: 'session.php',
                data: {
                    username: username,
                    password: password
                },
                success: function(data) {
                    console.log(data);
                    if (data === 'error') {
                        toastr.error(
                            'Ooops, Invalid login. Please insure your username and password are correct.'
                            )
                    } else {
                        //window.location.href = 'dashboard.php';
                         toastr.success('Yeepy!!! Greate work! :-)')
                    }


                }
            });

        });

        function checkuser() {
            var username = $("#username").val();

            console.log(username);
            if (username === "") {
                $("#username_message").show().addClass("error");
                $("#username_error_message").show();
                $("#username_error_message").html("Username cannot be empty");
            }

            if (username != "") {
                $("#username_message").hide();
                $("#username_error_message").hide();
                $("#username_error_message").html("")

            }
        }

        function checkpassword() {
            var password = $("#password").val();
            var password_length = $("#password").val().length;

            console.log(password);

            if (password_length < 6) {
                $("#password_message").show().addClass("error");
                $("#password_error_message").show();
                $("#password_error_message").html("Password should be at least 6 characters");
            } else {
                $("#password_message").hide();
                $("#password_error_message").hide();
                $("#password_error_message").html("")
            }
        }

        function disableSubmitButton() {
            var username = $("#username").val();
            var password = $("#password").val();
            var password_length = $("#password").val().length;

            if (username === "" && password === "") {
                document.getElementById("submit").disabled = true;
            }
            if (username !== "" && password_length < 6) {
                document.getElementById("submit").disabled = true;
            }

            if (username !== "" && password !== "" && password_length >= 6) {
                document.getElementById("submit").disabled = false;
            }
        }

    });
    </script>


</body>

</html>
