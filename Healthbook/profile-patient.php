<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Patient Profile</title>
    <style>
        #processing {
            background-image: url(pics/gifs/Ajaxloader.gif);
            height: 180px;
            width: 180px;
            background-size: contain;
            position: absolute;
            margin-left: 42%;
            margin-top: 15%;
            z-index: 10;
            display: none;
    </style>
    <script>
        $(document).ready(function() {

            $("#txtContact").blur(function() {
                var r = /^[6-9]{1}[0-9]{9}$/;
                var contact = $(this).val();
                var result = r.test(contact);
                if (result == true) {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").html("");
                    $("#txtContact").css("box-shadow", "");

                } else {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Type a valid contact no.").slideDown();
                    $("#txtContact").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtName").blur(function() {
                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
                var name = $(this).val();
                var result = r.test(name);
                if (result == true && name.length <= 30) {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").html("");
                    $("#txtName").css("box-shadow", "");
                } else {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Type name with max 30 characters. Use alphabets only and Remove unneccesary spaces").slideDown();
                    $("#txtName").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtAge").blur(function() {
                var age = $(this).val();

                if (age > 125 || age < 0 || age == "") {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Fill a valid age").slideDown();
                    $("#txtAge").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                //submit button will be handled by inSubmit event handler...no need for disabling submit
                $("#errResult").html("");
                $("#txtAge").css("box-shadow", "");
            });
            $("#txtCity").blur(function() {
                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
                var city = $(this).val();
                var result = r.test(city);
                if (result == true && city.length <= 30) {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").html("");
                    $("#txtCity").css("box-shadow", "");
                } else {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Type city name with max 30 characters. Use alphabets only and Remove unneccesary spaces").slideDown();
                    $("#txtCity").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtEmail").blur(function() {
                var email = $(this).val();
                if (email != "") {
                    var r = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                    var result = r.test(email);
                    if (result == true && email.length <= 60) {
                        $("#errResult").html("");//although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                        $("#txtEmail").css("box-shadow", "");
                    } else {
                        //submit button will be handled by inSubmit event handler...no need for disabling submit
                        $("#errResult").hide().html("Type a legal email address with max 60 characters").slideDown();
                        $("#txtEmail").css("box-shadow", "0px 0px 3px 3px red");
                    }
                } else {
                    $("#errResult").html("");//although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                    $("#txtEmail").css("box-shadow", "");
                }
            });
            $("#txtAddress").blur(function() {
                var address = $(this).val();
                if (address == "" || address.length > 60) {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Type address with max 60 characters").slideDown();
                    $("#txtAddress").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                //submit button will be handled by inSubmit event handler...no need for disabling submit
                $("#errResult").html("");
                $("#txtAddress").css("box-shadow", "");
            });
            $("#txtProblems").blur(function() {
                var problems = $(this).val();
                if (problems == "" || problems.length > 60) {
                    //submit button will be handled by inSubmit event handler...no need for disabling submit
                    $("#errResult").hide().html("Type your problems with max 60 characters").slideDown();
                    $("#txtProblems").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                //submit button will be handled by inSubmit event handler...no need for disabling submit
                $("#errResult").html("");
                $("#txtProblems").css("box-shadow", "");
            });
            $("#btnFetch").click(function() {
                var url = "profile-patient-fetch.php";
                var uid = $("#txtUid").val();
                $.getJSON(url, {
                    uid: uid
                }, function(jsonArray) {
                    if (jsonArray.length == 0) {
                        $("#errResult").hide().html("Account details does not exist").slideDown();
                    } else if (JSON.stringify(jsonArray).substr(0, 4) == "flag") //just in case $isConnected == false
                    {
                        $("#errResult").hide().html(JSON.stringify(jsonArray).substr(4)).slideDown();
                    } else {

                        //css property is applied...because of the edge case(that person might enter wrong data and then fetch the details)
                        $("#txtUid").val(jsonArray[0].uid).css("box-shadow", "");
                        $("#txtContact").val(jsonArray[0].contact).css("box-shadow", "");
                        $("#txtName").val(jsonArray[0].name).css("box-shadow", "");
                        $("#txtAge").val(jsonArray[0].age).css("box-shadow", "");
                        $("#cmbGender").val(jsonArray[0].gender).css("box-shadow", "");;
                        $("#txtCity").val(jsonArray[0].city).css("box-shadow", "");;
                        $("#txtEmail").val(jsonArray[0].email).css("box-shadow", "");;
                        $("#txtAddress").val(jsonArray[0].address).css("box-shadow", "");;
                        $("#txtProblems").val(jsonArray[0].problems).css("box-shadow", "");;
                        $("#errResult").html("");
                    }
                });
            });
            $(document).ajaxStart(function() {
                $("#processing").show();
            })
            $(document).ajaxStop(function() {
                progressTimer = setTimeout(function() {
                    $('#processing').remove();
                }, 1000)
//                $("#processing").hide();
            });
        });

    </script>
    <script type="text/javascript">
        function checkform() {

            var flagcontact = false;
            var flagname = false;
            var flagage = false;
            var flagcity = false;
            var flagemail = false;
            var flagaddress = false;
            var flagproblems = false;
            //getting all necesary fields to be validated
            var contact = document.getElementById("txtContact").value;
            var name = document.getElementById("txtName").value;
            var age = document.getElementById("txtAge").value;
            var city = document.getElementById("txtCity").value;
            var email = document.getElementById("txtEmail").value;
            var address = document.getElementById("txtAddress").value;
            var problems = document.getElementById("txtProblems").value;


            var r = /^[6-9]{1}[0-9]{9}$/;
            flagcontact = r.test(contact);

            r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
            flagname = r.test(name);
            if (name.length > 30)
                flagname = false;

            //            alert(age.indexOf('e')); works
            if (age > 125 || age < 0 || age == "" || age.indexOf('e') != -1) {
                flagage = false;
                alert("Avoid Scientific Notation");
            } else
                flagage = true;

            r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
            flagcity = r.test(city);
            if (city.length > 30)
                flagcity = false;

            if (email == "")
                flagemail = true;
            else {
                r = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                flagemail = r.test(email);
                if (email.length > 60)
                    flagemail = false;
            }

            if (address == "" || address.length > 60)
                flagaddress = false;
            else
                flagaddress = true;

            if (problems == "" || problems.length > 60)
                flagproblems = false;
            else
                flagproblems = true;

            if (flagcontact && flagname && flagage && flagcity && flagemail && flagaddress && flagproblems)
                return true;
            alert("Complete Form Validation!");
            return false;
        }

    </script>
</head>

<body>
    <div id="processing"></div>
    <form action="profile-patient-process.php" onSubmit="return checkform()">
        <div class="container col-md-8">
            <!--           form heading-->
            <div class="row text-white" style="background-color: dodgerblue;">
                <div class="col-md-12">
                    <center>
                        <h1>Patient Profile</h1>
                    </center>
                </div>
            </div>
            <!--               just blank row-->
            <div class="row">
                <div class="col-md-12">
                    <label for=""></label>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3" style="margin-top:6px;">
                    <label for="txtUid">Username</label>
                    <input type="text" class="form-control" id="txtUid" name="txtUid" value="<?php echo $_SESSION["activeuser"];?>" readonly>
                </div>
                <div class="form-group col-md-3 ml-3">
                    <label for="txtContact" class="col-form-label">Contact</label>
                    <label for="txtContact" class="text-danger">*</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91</span>
                        </div>
                        <input type="text" class="form-control" id="txtContact" name="txtContact" value="<?php echo $_SESSION["activeusermobile"];?>" placeholder="Contact no.">
                    </div>
                </div>
                <div class="col-md-2 form-group ml-3" style="margin-top:37.5px;">
                    <input type="button" class="btn btn-outline-info form-control" value="Fetch" id="btnFetch">
                </div>

            </div>

            <hr class="my-4 bg-primary" style="height:1px;">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="txtName">Name</label>
                    <label for="txtName" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtName" name="txtName" placeholder="eg. John Doe" autofocus>
                </div>
                <div class="form-group col-md-3 ml-4">
                    <label for="txtAge">Age</label>
                    <label for="txtAge" class="text-danger">*</label>

                    <input type="number" max="125" class="form-control" required id="txtAge" name="txtAge">
                </div>


                <div class="form-group col-md-2 ml-4">
                    <label>Gender</label>
                    <label class="text-danger">*</label>
                    <select class="custom-select form-control" id="cmbGender" , name="cmbGender">
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 mr-4">
                    <label for="txtCity">City</label>
                    <label for="txtCity" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtCity" name="txtCity">
                </div>

                <div class="form-group col-md-6">
                    <label for="txtEmail">Email</label>
                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="username@example.com">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="txtAddress">Address</label>
                    <label for="txtAddress" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtAddress" name="txtAddress">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="txtProblems">Health Problems</label>
                    <label for="txtProblems" class="text-danger">*</label>
                    <textarea rows="4" class="form-control" id="txtProblems" name="txtProblems" style="resize:none;"></textarea>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-5 ml-5">
                    <input type="submit" class="btn-lg btn-primary form-control" value="Submit" id="btnSubmit">
                </div>
                <div class="form-group col-md-5 ml-4">
                    <input type="submit" class="btn-lg btn-danger form-control" value="Update" id="btnUpdate" formaction="profile-patient-update.php">
                </div>
                <div class="form-group col-md-12">
                    <center><span id="errResult" class="text-danger form-control mb-2" style="font-size:17px;border:0px;"></span></center>
                </div>
            </div>
            <!--            blue space-->
            <div class="row" style="background-color: dodgerblue;">
                <div class="col-md-12  mb-5">
                    <label for="">&nbsp;</label>
                </div>
            </div>
        </div>
    </form>

</body>

</html>
<!--
Readme

...===not mandatory

username -> id=txtUid, name=txtUid
Contact no. ->id=txtContact, name=txtContact
fetch button ->id=btnFetch, value=Fetch

name -> id=txtName, name=txtName
age -> id=txtAge, name=txtAge
gender -> id=cmbGender,  name=cmbGender
city -> id=txtCity, name=txtCity
...email -> id=txtEmail, name=txtEmail
address -> id=txtAddress,name=txtAddress
healthproblems -> id=txtProblems, name=txtProblems

submit btn -> id=btnSubmit, value=Submit
update btn -> id=btnUpdate, value=Update
Resulting span -> id=errResult
-->
<!--PTR:
checkform won't work unless required aren't filled
submit button will be handled by inSubmit event handler...no need for disabling submit
-->
<!--pending updation
DONE 1.username and mobile must be readonly

DONE 2.Biggest loophole: submit(&update) ke chalne se pehle fields ki validity check
    DONE 2.1.update submit button->disable/enable toggling
    concept cleared 2.2.combobox doesn't have required
-->
