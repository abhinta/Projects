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
    <title>Doctor Slip</title>
    <style>

    </style>
    <script>
        function showpreview(file) {

            if (file.files && file.files[0]) {
                var reader = new FileReader();
                reader.onload = function(ev) {
                    $('#samplePic').attr('src', ev.target.result);
                }
                reader.readAsDataURL(file.files[0]);
            }
        }
        $(document).ready(function() {
            $("#txtDoctorName").blur(function() {
                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
                var dname = $(this).val();
                var result = r.test(dname);
                if (result == true && dname.length <= 40) {
                    
                    $("#errResult").html("");
                    $("#txtDoctorName").css("box-shadow", "");
                } else {
                    
                    $("#errResult").hide().html("Type name with max 40 characters. Use alphabets only and Remove unneccesary spaces").slideDown();
                    $("#txtDoctorName").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtDoVisit").blur(function() {
                var date = $(this).val();
                if (date == "") {
                    
                    $("#errResult").hide().html("Type a valid date").slideDown();
                    $("#txtDoVisit").css("box-shadow", "0px 0px 3px 3px red");
                } else {
                    
                    $("#errResult").html("");
                    $("#txtDoVisit").css("box-shadow", "");
                }
            });
            $("#txtCity").blur(function() {
                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
                var city = $(this).val();
                var result = r.test(city);
                if (result == true && city.length <= 30) {
                    
                    $("#errResult").html("");
                    $("#txtCity").css("box-shadow", "");
                } else {
                    
                    $("#errResult").hide().html("Type city name with max 30 characters. Use alphabets only and Remove unneccesary spaces").slideDown();
                    $("#txtCity").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtHospital").blur(function() {
                var hospital = $(this).val();
                if (hospital == "" || hospital.length > 40) {
                    
                    $("#errResult").hide().html("Type hospital name with max 40 characters").slideDown();
                    $("#txtHospital").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#txtHospital").css("box-shadow", "");
            });
            $("#txtProblem").blur(function() {
                var problem = $(this).val();
                if (problem == "" || problem.length > 60) {
                    
                    $("#errResult").hide().html("Type your problem name with max 60 characters").slideDown();
                    $("#txtProblem").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#txtProblem").css("box-shadow", "");
            });
            $("#txtNextDov").blur(function() {
                var nextdate = $(this).val();
                if (nextdate != "") {
                    var dov = $("#txtDoVisit").val();
                    if (Date.parse(nextdate) < Date.parse(dov)) {
                        
                        $("#errResult").hide().html("Next date of visit can't be before last date of visit").slideDown();
                        $("#txtNextDov").css("box-shadow", "0px 0px 3px 3px red");
                        return;
                    } else {
                        $("#errResult").html(""); //although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                        $("#txtNextDov").css("box-shadow", "");
                    }
                } else {
                    $("#errResult").html(""); //although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                    $("#txtNextDov").css("box-shadow", "");
                }
            });
            $("#txtDiscussion").blur(function() {
                var disc = $(this).val();
                if (disc != "") {
                    if (disc.length > 70) {
                        
                        $("#errResult").hide().html("Type your Discussions name with max 70 characters").slideDown();
                        $("#txtDiscussion").css("box-shadow", "0px 0px 3px 3px red");
                        return;
                    } else {
                        $("#errResult").html(""); //although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                        $("#txtDiscussion").css("box-shadow", "");
                    }
                } else {
                    $("#errResult").html(""); //although this must'nt be done in general, but we are doing it just to ensure error caused by this field doesn't remain there even after error gets resolved
                    $("#txtDiscussion").css("box-shadow", "");
                }
            });
            $("#slipPic").blur(function() {
                var slipName = $(this).val();
                if (slipName == "" || slipName.length > 66) { //actually 66, so as to store extension
                    
                    $("#errResult").hide().html("Select a pic with name having characters less than equals 60").slideDown();
                    $("#slipPic").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#slipPic").css("box-shadow", "");
            });
        });

    </script>
    <script type="text/javascript">
        function checkform() {


            var flagDoctorName = false;
            var flagDoVisit = false;
            var flagCity = false;
            var flagHospital = false;
            var flagProblem = false;
            var flagNextDov = false;
            var flagDiscussion = false;
            var flagslipPic = false;

            //getting all necesary fields to be validated
            var DoctorName = document.getElementById("txtDoctorName").value;
            var DoVisit = document.getElementById("txtDoVisit").value;
            var City = document.getElementById("txtCity").value;
            var Hospital = document.getElementById("txtHospital").value;
            var Problem = document.getElementById("txtProblem").value;
            var NextDov = document.getElementById("txtNextDov").value;
            var Discussion = document.getElementById("txtDiscussion").value;
            var slipPic = document.getElementById("slipPic").value;

            var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
            flagDoctorName = r.test(DoctorName);
            if (DoctorName.length > 40)
                flagDoctorName = false;

            if (DoVisit == "")
                flagDoVisit = false;
            else
                flagDoVisit = true;

            r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
            flagCity = r.test(City);
            if (City.length > 30)
                flagCity = false;

            if (Hospital == "" || Hospital.length > 40)
                flagHospital = false;
            else
                flagHospital = true;

            if (Problem == "" || Problem.length > 60)
                flagProblem = false;
            else
                flagProblem = true;

            if (NextDov == "")
                flagNextDov = true;
            else {
                if (Date.parse(DoVisit) > Date.parse(NextDov))
                    flagNextDov = false;
                else
                    flagNextDov = true;
            }

            if (Discussion == "")
                flagDiscussion = true;
            else {
                if (Discussion.length > 70)
                    flagDiscussion = false;
                else
                    flagDiscussion = true;
            }

            if (slipPic == "" || slipPic.length > 66)
                flagslipPic = false;
            else
                flagslipPic = true;


            if (flagDoctorName && flagDoVisit && flagCity && flagHospital && flagProblem && flagNextDov && flagDiscussion && flagslipPic)
                return true;
            alert("Complete Form Validation!");
            return false;
        }

    </script>
</head>

<body>
    <form action="doctor-slip-process.php" method="post" enctype="multipart/form-data" onSubmit="return checkform()">
        <div class="container col-md-8">
            <!--           form heading-->
            <div class="row text-white" style="background-color: dodgerblue;">
                <div class="col-md-12">
                    <center>
                        <h1>Doctor Slip</h1>
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
                <div class="form-group col-md-4" style="margin-top:6px;">
                    <label for="txtPatientId">Username</label>
                    <input type="text" class="form-control" id="txtPatientId" name="txtPatientId" value="<?php echo $_SESSION["activeuser"];?>" readonly>
                </div>
            </div>

            <hr class="my-2 bg-primary" style="height:1px;">

            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="txtDoctorName">Doctor's Name</label>
                    <label for="txtDoctorName" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtDoctorName" name="txtDoctorName" autofocus>
                </div>
                <div class="form-group col-md-4 ml-4">
                    <label for="txtDoVisit">Date of Visit</label>
                    <label for="txtDoVisit" class="text-danger">*</label>
                    <input type="date" class="form-control" required id="txtDoVisit" name="txtDoVisit">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="txtCity">City</label>
                    <label for="txtCity" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtCity" name="txtCity">
                </div>
                <div class="form-group col-md-7 ml-4">
                    <label for="txtHospital">Hospital / Trust / Clinic Name</label>
                    <label for="txtHospital" class="text-danger">*</label>

                    <input type="text" class="form-control" required id="txtHospital" name="txtHospital">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="txtProblem">Health Problem</label>
                    <label for="txtProblem" class="text-danger">*</label>
                    <textarea rows="2" class="form-control" id="txtProblem" name="txtProblem" style="resize:none;" required></textarea>
                </div>
                <div class="form-group col-md-4 ml-4">
                    <label for="txtNextDov">Next Date of Visit</label>
                    <input type="date" class="form-control mt-2" id="txtNextDov" name="txtNextDov">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="txtDiscussion">Discussion with Doctor</label>
                    <textarea rows="5" class="form-control" id="txtDiscussion" name="txtDiscussion" style="resize:none;" placeholder="eg. Take Medicine paracetamol"></textarea>
                </div>

                <div class="form-group col-md-4 ml-4" style="margin-top:0px;">
                    <img src="pics/receipt.png" width="150" height="160" alt="image not available" id="samplePic">
                    <br>
                    <label for="slipPic">Upload Doctor Slip</label>
                    <label for="slipPic" class="text-danger">*</label>
                    <input type="file" required id="slipPic" name="slipPic" class="form-control" style="border:0px;padding:0px;padding-top:2px;" onchange="showpreview(this);">
                </div>

            </div>
            <div class="form-row mt-2 justify-content-center">
                <div class="form-group col-md-5">
                    <input type="submit" class="btn-lg btn-primary form-control" value="Send to Server" id="btnSubmit">
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

username -> id=txtPatientId, name=txtPatientId
doctor name -> id=txtDoctorName, name=txtDoctorName
date of visit -> id=txtDoVisit, name=txtDoVisit
city -> id=txtCity, name=txtCity
hospital/trust/clinic -> id=txtHospital, name=txtHospital
health problem -> id=txtProblem, name=txtProblem
Next Date of Visit -> id = txtNextDov, name=txtNextDov
Discussion with doctor -> id=txtDiscussion, name=txtDiscussion

Upload Doctor Slip -> id=slipPic, name=slipPic
samplePic->id=samplePic

submit btn -> id=btnSubmit, value=Send To Server
Resulting span -> id=errResult
-->

<!--PTR:
checkform won't work unless required aren't filled
submit button will be handled by inSubmit event handler...no need for disabling submit
-->

<!--pending updation
DONE 1.username must be readonly

DONE 2.Biggest loophole: submit(&update) ke chalne se pehle fields ki validity check
    DONE 2.1.update submit button->disable/enable toggling
-->
