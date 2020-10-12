<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--    <link rel="stylesheet" href="css/font-awesome-all.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <title>Index</title>
    <style>
        .valid {
            box-shadow: none !important;
            box-shadow: 0px 0px 5px 3px forestgreen !important;
        }

        .not-valid {
            box-shadow: none !important;
            box-shadow: 0px 0px 5px 3px darkred !important;
            color: red;
            text-shadow: 10px;
        }

        /*
        input[type="text"]{
            border: 0px;
            border-radius: 0px;
            border-bottom: 1px black solid;
        }
*/



        #txtUid {
            background-image: url(pics/user-regular.png);
            background-position: left;
            background-size: 50px;
            background-repeat: no-repeat;
            padding-left: 50px;
        }

        #txtPwd {
            background-image: url(pics/lock-solid.png);
            background-position: left;
            background-size: 50px;
            background-repeat: no-repeat;
            padding-left: 50px;
        }

        /*
        #txtMob {
            background-image: url(pics/mobile-alt-solid.png);
            background-position: left;
            background-size: 50px;
            background-repeat: no-repeat;
            padding-left: 50px;
        }
*/

        #txtUidLogin {
            background-image: url(pics/user-regular.png);
            background-position: left;
            background-size: 50px;
            background-repeat: no-repeat;
            padding-left: 50px;
        }

        #txtPwdLogin {
            background-image: url(pics/lock-solid.png);
            background-position: left;
            background-size: 50px;
            background-repeat: no-repeat;
            padding-left: 50px;
        }

        /*        both works fine*/
        #loginbtnspecific {
            background-color: #1076cb;
            border: #16c3b2;
        }

        #loginbtnspecific:hover {
            background-color: #1768ac;
        }

        .myhover {
            color: white;
        }
    </style>
    <script>
        $(document).ready(function() {
            $uidDefaultMsg = "Your username must be 3-25 characters long, no spaces at ends, can include any character except '&'";
            $pwdDefaultMsg = "Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only";
            $("#txtUid").blur(function() {
                var uid = $(this).val();
                $(this).val(uid.trim()); //removes spaces left and right of sentence
            });
            $("#btnSignup").click(function() {
                var uid = $("#txtUid").val();
                var pwd = $("#txtPwd").val();
                var mob = $("#txtMob").val();

                //checking valid uid

                var resultUid = false;
                if (uid.length > 25 || uid.length < 3 || uid.indexOf('&') != -1) {
                    $("#txtUid").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                } else {
                    $("#txtUid").hide().css("box-shadow", "").show();
                    resultUid = true;
                }

                //checking valid password(pwd)
                var r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/; //without &
                var resultPwd = r.test(pwd);
                if (resultPwd == true) {
                    $("#txtPwd").hide().css("box-shadow", "").show();
                } else {
                    $("#txtPwd").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                }

                //checking valid mobile no.(mob)
                r = /^[6-9]{1}[0-9]{9}$/; //reg. expression
                var resultMob = r.test(mob);
                if (resultMob == true) {
                    $("#txtMob").hide().css("box-shadow", "").show();
                    //                    $("#txtMob").removeClass(".not-valid").addClass(".valid");
                } else {
                    //                    $("#txtMob").removeClass(".valid").addClass(".not-valid");
                    $("#txtMob").hide().css("box-shadow", "0px 0px 3px 3px red").show();
                }

                var category = "";
                if ($("#radDoc").prop("checked") == true)
                    category = $("#radDoc").val();
                else
                    category = $("#radPat").val();

                var url = "";
                if (resultUid && resultPwd && resultMob) //i.e. true
                {
                    url = "signup.php?uid=" + uid + "&pwd=" + pwd + "&mob=" + mob + "&category=" + category;
                } else {
                    $("#errResultSignup").hide().html("Fill valid details").slideDown();
                    return;
                }
                $.get(url, function(response) {
                    $("#errResultSignup").hide().html(response).slideDown();
                });
            });

            $("#btnLogin").click(function() {
                var uid = $("#txtUidLogin").val();
                var pwd = $("#txtPwdLogin").val();
                var url = "login.php?uid=" + uid + "&pwd=" + pwd;
                $.getJSON(url, function(jsonArray) {
                    //                                        alert(JSON.stringify(jsonArray));
                    if (jsonArray == "Invalid username/password") { //for both uid not registered + pwd invalid
                        $("#errResultLogin").hide().html("Invalid username/password").slideDown();
                    } else {
                        if (jsonArray == "patient")
                            location.href = "dashboard-patient.php";
                        else
                            location.href = "doctor.php";
                        //session takes care of it (not required anymore...since we'll be redirected to dashboard)
                        //                        $("#txtPwdLogin").val("");
                        //                        $("#errResultLogin").html("");
                    }
                });
            });

            var temp_otp = NaN;
            var temp_uid = NaN;
            //remember temp_uid,otp resets everytime forgot modal is started
            //otp-modal, newpwd-modal execute only after forgot-modal
            $("#btnForgot").click(function() {
                var uid = $("#txtUidForgot").val();

                uid = uid.trim();
                if (uid.length > 25 || uid.length < 3 || uid.indexOf('&') != -1) {
                    $("#errResultForgot").hide().html("Enter a valid username").slideDown();
                    return;
                }
                var url = "forgot-process.php?uid=" + uid;
                $.get(url, function(response) {
                    if (response != "unauthorized") {
                        //                        temp_otp = response;
                        temp_otp = response.trim(); //unusual spaces were coming
//                                                alert(temp_otp);//for testing purpose only
                        temp_uid = uid;
                    } else {
                        temp_otp = NaN;
                        temp_uid = NaN;
                    }
                    alert("OTP sent");
                    //resetting forgot modal
                    $("#txtUidForgot").val("");
                    $("#errResultForgot").html("");
                    $("#forgot-modal").modal("hide");

                    //resetting otp modal
                    $("#otp-modal").modal("show");
                    $("#txtOtp").val("");
                    $("#errResultOtp").html("");

                    //resetting newpwd modal
                    $("#txtNewPwd").val("");
                    $("#txtConfirmPwd").val("");
                    $("#errResultNewPwd").html("");
                });
            });

            $("#btnOtp").click(function() {
                var userOTP = $("#txtOtp").val();
                if (isNaN(temp_otp)) { //not a valid user
                    $("#errResultOtp").hide().html("Wrong OTP").slideDown();
                } else if (userOTP == temp_otp) {
                    //                    temp_otp = NaN;not required
                    //                    $("#errResultOtp").html("");not required 

                    $("#otp-modal").modal("hide");
                    $("#newpwd-modal").modal("show");
                    //                    $("#txtNewPwd").val("");not required
                    //                    $("#txtConfirmPwd").val("");not required
                    //                    $("#errResultNewPwd").html("");not required
                } else
                    $("#errResultOtp").hide().html("Wrong OTP").slideDown();
            });
            $("#btnConfirmPwd").click(function() {
                var r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/; //without &
                var newpwd = $("#txtNewPwd").val();
                var confirmpwd = $("#txtConfirmPwd").val();
                var result = r.test(newpwd);

                if (result && newpwd == confirmpwd) {
                    var url = "forgot-update-password.php?uid=" + temp_uid + "&pwd=" + newpwd;
                    $.get(url, function(response) {
                        if (response == "updated")
                            $("#errResultNewPwd").hide().html("Updation Successfull !!!").fadeIn();
                        else
                            alert(response);
                    })
                    //                    temp_uid = NaN;not required

                } else if (result == false) {
                    $("#errResultNewPwd").hide().html("Enter a valid password").fadeIn();
                } else
                    $("#errResultNewPwd").hide().html("Password fields do not match").fadeIn();
            });
        });

    </script>
</head>

<body>
    <!--   facebook code 1-->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v7.0" nonce="ucnhwxD5"></script>

    <!--   navbar-->
    <nav class="navbar navbar-expand-lg bg-light navbar-light fixed-top">
        <!--       style="background-color:#f7f7f7;"-->
        <!--       16c3b2-->
        <a class="navbar-brand" href="index.php">
            <img src="pics/logo3.png" style="height:90px;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <!--
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                -->
            </ul>
            <div class="btn btn-primary mr-3" data-toggle="modal" data-target="#login-modal" id="loginbtnspecific">Login</div>
            <div class="btn btn-outline-info mr-2" data-toggle="modal" data-target="#signup-modal">Signup</div>
            <div class="btn btn-link" data-toggle="modal" data-target="#forgot-modal">Forgot Password?</div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    
    <!--   cover photo-->
    <div>
        <img src="pics/85baeb_d155e10f3b8d4aff829822a4b828a58a_mv2_d_2800_1273_s_2.jpg" width="100%;" alt="">
    </div>
    <!--    Services-->
    <div class="container col-md-12">
        <div class="row mb-4" style="background-color: #1768ac;">
            <div class="col-md-12 mt-2" style="height:60px;font-family:Ciabatta; color:#ffffff">
                <center>
                    <h1>OUR SERVICES</h1>
                </center>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card" style="float:left;padding:10px;">
                    <!--                <div class="card" style="width: 300px; margin-left: 30px; float: left">-->
                    <img src="pics/doctor%20clipart.png" height="232" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title text-center">Search Doctor</h5>
                        <p class="card-text text-center">Check Nearby Doctor or any other all over India</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="float:left;padding:11px;">
                    <img src="pics/SUGAR%20AND%20BP%20CLIPART.png" height="241" class="card-img-top" alt="...">
                    <div class="card-body" style="padding:11px;height:113px;">
                        <h5 class="card-title text-center">Sugar And BP Records</h5>
                        <p class="card-text text-center">Maintain sugar and blood pressure records and retrieve them anytime</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card" style="float:left;padding:11px;">
                    <img src="pics/SLIP%20CLIPART.png" height="232" class="card-img-top" alt="...">
                    <div class="card-body" style="height:123px;">
                        <h5 class="card-title text-center">Doctor Presciption Slips</h5>
                        <p class="card-text text-center">Never lose any doctor slip again by recording here</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card" style="float:left;padding:0px;">
                    <img src="pics/Untitled-1.png" height="254" class="card-img-top" alt="...">
                    <div class="card-body" style="padding:11px;height:123px;">
                        <h5 class="card-title text-center">Doctor Registration</h5>
                        <p class="card-text text-center">Doctors can upload their professional portofolio</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--    Developers-->
    <div class="container col-md-12">
        <div class="row mb-4" style="background-color: #1768ac;">
            <div class="col-md-12 mt-2" style="height:60px;font-family:Ciabatta; color:#ffffff">
                <center>
                    <h1>DEVELOPERS</h1>
                </center>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-3 align-items-center justify-content-center d-flex">
                <div class="card" style="float:left;padding:0px;border:none">
                    <img src="pics/mypic(3)%20edited.jpg" style="width:200px; height:200px" class="card-img-top rounded-circle" alt="...">
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="row">
                    <div class="card" style="float:left;padding:0px;border:none">
                        <div class="card-body" style="padding:11px;">
                            <!--                        <h5 class="card-title text-center">Sugar And BP Records</h5>-->
                            <p class="card-text text-center">I'm <b>Abhinav Gupta</b>, a student at Punjab Engineering College, Chandigarh. Currently, studying in 5th semester and <b>actively looking for internship</b> for 6th sem(Jan 2021-Jun 2021).</p>
                            <p class="card-text text-center">I completed this project under the guidance of my mentor <b>Mr. Rajesh K. Bansal</b> (SCJP) and author of the book <b>Real Java</b></p>
                            <hr class="my-2" style="width:300px;">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-3  align-items-center justify-content-center d-flex">
                <div class="card" style="float:left;padding:0px;border:none">
                    <img src="pics/sirpic.jpg" style="width:200px; height:200px" class="card-img-top rounded-circle" alt="...">
                </div>
            </div>


        </div>
    </div>
    <!--    Reach Us-->
    <div class="container col-md-12">
        <div class="row" style="background-color: #1768ac;height:165px;">
            <div class="col-md-6 mt-2" style="font-family:Ciabatta;font-size:18px; color:#ffffff">
                <h1>CONTACT US</h1>
                <p>
<!--                    <i class="fas fa-mobile-alt fa-fw fa-lg"></i> : +91-6283524011-->

                    <i class="far fa-envelope fa-fw fa-lg"></i> : abhinav.gupta.2400@gmail.com
                </p>
                <p>
                    <a href="https://www.facebook.com/profile.php?id=100009395694215" style="text-decoration:none;text-decoration-color:none;" class="fab fa-facebook fa-fw fa-2x myhover"></a>
                    <a href="https://www.instagram.com/abhinav_204/" class="fab fa-instagram fa-fw fa-2x myhover" style="text-decoration:none"></a>
                    <a href="https://www.linkedin.com/in/abhinav-gupta-95616b177/" style="text-decoration:none" class="fab fa-linkedin fa-fw fa-2x myhover"></a>

                    <!--
                    fab fa-facebook-f
                    fab fa-linkedin-in
-->
                    <!--                    <i class="fab fa-instagram-square"></i>-->
                </p>
            </div>
            <div class="col-md-3 justify-content-center align-items-center d-flex">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3447.8805713513243!2d74.95013941387977!3d30.2119559175973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391732a4f07278a9%3A0x4a0d6293513f98ce!2sBanglore%20Computer%20Education%20(C%20C%2B%2B%20Android%20J2EE%20PHP%20Python%20AngularJs%20Spring%20Java%20Training%20Institute)!5e0!3m2!1sen!2sin!4v1596071638864!5m2!1sen!2sin" width="" height="135" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>

            <!--   facebook code 2-->
            <div class="col-md-3 justify-content-center align-items-center d-flex">
                <div class="fb-page" data-href="https://www.facebook.com/WHO" data-tabs="timeline" data-width="" data-height="135" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                    <blockquote cite="https://www.facebook.com/WHO" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/WHO">World Health Organization (WHO)</a></blockquote>
                </div>
            </div>
        </div>
    </div>

    <!--    signup-modal-->
    <div class="modal fade" id="signup-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Signup</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   signup form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-12">

                                    <input type="text" class="form-control" id="txtUid" name="txtUid" placeholder="username">
                                    <small id="errUid" class="form-text text-muted">
                                        Your username must be 3-25 characters long, no spaces at ends, can include any character except &#39;&amp;&#39;
                                    </small>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">

                                    <input type="password" class="form-control" id="txtPwd" name="txtPwd" placeholder="password">
                                    <small id="errPwd" class="form-text text-muted">
                                        Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">


                                    <div class="input-group" style="">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">+91</span>
                                        </div>
                                        <input type="text" class="form-control" id="txtMob" name="txtMob" placeholder="mobile no.">
                                    </div>

                                </div>
                            </div>
                            <div class="form-row">
                                Category
                                <div class="form-check form-check-inline ml-4">
                                    <input class="form-check-input" type="radio" name="radCategory" id="radDoc" value="doctor" checked>
                                    <label class="form-check-label" for="radDoc">Doctor</label>

                                </div>
                                <div class="form-check form-check-inline ml-4">
                                    <input class="form-check-input" type="radio" name="radCategory" id="radPat" value="patient">
                                    <label class="form-check-label" for="radPat">Patient</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <!--                    <button type="button" class="btn btn-primary form-control">Signup</button>-->
                    <input type="button" class="btn btn-primary form-control" value="Signup" id="btnSignup">
                    <span id="errResultSignup" class="text-danger"></span>
                </div>
            </div>
        </div>
    </div>
    <!--    login-modal-->
    <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   login form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    
                                    <input type="text" class="form-control" id="txtUidLogin" name="txtUidLogin" placeholder="username">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    
                                    <input type="password" class="form-control" id="txtPwdLogin" name="txtPwdLogin" placeholder="password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div style="padding-bottom:10px;">
                    <div class="modal-footer justify-content-center">
                        <input type="button" class="btn btn-success" value="Login" id="btnLogin">
                        <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                    </div>
                    <center><span id="errResultLogin" class="text-danger"></span></center>
                </div>

            </div>
        </div>
    </div>
    <!--    forgot modal-->
    <div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recover Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   forgot form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <label for="txtUidForgot" class="col-form-label">Registered Username</label>
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" id="txtUidForgot" name="txtUidForgot" placeholder="username">
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-outline-info form-control" value="->" id="btnForgot">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <center><span id="errResultForgot" class="text-danger"></span></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    otp modal-->
    <div class="modal fade" id="otp-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   otp form-->
                    <form>
                        <div class="container">
                            <label for="txtOtp" class="col-form-label">OTP</label>
                            <div class="form-row">
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control" id="txtOtp" name="txtOtp" placeholder="123456">
                                    <small id="errOTP" class="form-text text-muted">
                                        If you are our valid user, you'll receive a 6 digit OTP on registered number
                                    </small>
                                </div>
                                <div class="col-md-2">
                                    <input type="button" class="btn btn-outline-info form-control" value="->" id="btnOtp">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <center><span id="errResultOtp" class="text-danger"></span></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    new password modal-->
    <div class="modal fade" id="newpwd-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   new password  form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <label for="txtNewPwd" class="col-form-label">New Password</label>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" id="txtNewPwd" name="txtNewPwd" placeholder="">
                                    <small id="errNewPwd" class="form-text text-muted">
                                        Your password must be 8-20 characters long, must contain capital letter(s), number(s) and special character(s) among !,@,#,$,%,^,* only
                                    </small>
                                </div>
                            </div>
                            <div class="form-row">
                                <label for="txtConfirmPwd" class="col-form-label">Confirm Password</label>
                                <div class="form-group col-md-12">
                                    <input type="password" class="form-control" id="txtConfirmPwd" name="txtConfirmPwd" placeholder="">
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer justify-content-center">
                        <input type="button" class="btn btn-danger" value="Confirm" id="btnConfirmPwd">
                        <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                    </div>
                    <center><span id="errResultNewPwd" class="text-danger"></span></center>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!--Readme-->

<!--signup modal
signup modal         ->id=signup-modal
uid textbox          -> id=txtUid ,name =txtUid, small ki id=errUid
password textbox     -> id=txtPwd ,name =txtPwd , small ki id=errPwd
mobile textbox       -> id=txtMob ,name =txtMob
doctor radio         -> id=radDoc , name=radCategory, value=doctor
patient radio        -> id=radPat , name=radCategory, value=patient
signup button        -> id=btnSignup, value=Signup, type=button, span ki id=errResultSignup
-->
<!--login modal
login modal          ->id=login-modal
uid textbox          -> id=txtUidLogin ,name =txtUidLogin
password textbox     -> id=txtPwdLogin ,name =txtPwdLogin
Login button         -> id=btnLogin, value=Login, type=button, span ki id=errResultLogin
-->
<!--unused regex

username
//                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/; //single space between words
//                var r = /^[a-zA-Z ]*$/;
password
//                r = /(?=^.{8,20}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;
 
# too does problems being in paasword
-->
