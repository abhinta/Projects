<?php
session_start();
if(isset($_SESSION["activeuser"])==false){
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>Patient Dashboard</title>
    <script>
        $(document).ready(function() {

            //for bp
            $("#txtPulse").blur(function() {
                if ($(this).val() != "") {
                    if ($(this).val() > 100)
                        alert("Take care of your health\nYour pulse rate isn't normal")
                }
            });
            $("#btnRecordBp").click(function() {
                //remember no primary key for this table
                var uid = $("#txtUidBp").val();
                var dor = $("#txtDorBp").val();
                var pulse = $("#txtPulse").val();
                var syst = $("#txtSyst").val();
                var dia = $("#txtDia").val();
                //                if(isNaN(pulse))
                //                                alert(parseFloat(pulse));

                if (dor == "" || dia == "" || syst == "") //no need to display background glow
                    $("#errRecordBp").hide().html("Fill Required(*) Fields").slideDown();
                else {
                    //                    alerts
                    if (syst < 120 && dia < 80)
                        alert("Congrats, your blood pressure is normal");
                    else if (syst <= 129 && syst >= 120 && dia < 80)
                        alert("Your blood pressure is elevated\nTake Care");
                    else if ((syst <= 139 && syst > 129) || (dia < 90 && dia >= 80))
                        alert("You have high blood pressure(level1)\nStart Taking Care");
                    else if (syst > 139 || dia >= 90)
                        alert("You have high blood pressure\nLevel 2\nConsult a Doctor");
                    else if (syst > 180 || dia > 120)
                        alert("You have hypertensive crisis\nConsult a Doctor Immediately");

                    var url = "patient-recordbp.php?uid=" + uid + "&dateofrecord=" + dor + "&pulse=" + pulse + "&dia=" + dia + "&syst=" + syst;
                    $.get(url, function(response) {
                        $("#errRecordBp").hide().html(response).slideDown();

                        //resetting fields
                        $("#txtDorBp").val("");
                        $("#txtPulse").val("");
                        $("#txtSyst").val("");
                        $("#txtDia").val("");
                    });
                }
            });


            //for sugar
            $("#txtSugarResult").blur(function() {
                var sugartime = $("#cmbTimeRecord").val();
                var sugarresult = $(this).val();

                if (sugartime == "fasting") {
                    if (sugarresult < 120)
                        alert("Congrats, your blood sugar is normal!!!");
                    else if (sugarresult >= 120 && sugarresult < 200)
                        alert("Your blood sugar may reach diabetic stage\nTake Care");
                    else if (sugarresult > 200)
                        alert("Take Care of your Health\nYou've already reached diabetes stage\nConsult a Doctor immediately");
                } else if (sugartime == "before meal") {
                    if (sugarresult >= 70 && sugarresult <= 130)
                        alert("Congrats, your blood sugar is normal\n(provided you checked after 1-2 hrs of your meal)");
                    else
                        alert("You're blood sugar isn't normal");
                } else if (sugartime == "after meal") {
                    if (sugarresult <= 180)
                        alert("Congrats, your blood sugar is normal!!");
                    else
                        alert("You're blood sugar isn't normal\nConsult a Doctor...");
                } else if (sugartime == "before exercise") {
                    if (sugarresult <= 100)
                        alert("Congrats, your blood sugar is normal\(if you take insulin)");
                    else
                        alert("You're blood sugar isn't normal");
                } else if (sugartime == "bedtime") {
                    if (sugarresult >= 100 && sugarresult <= 140)
                        alert("Congrats, your blood sugar is normal!");
                    else
                        alert("You're blood sugar isn't normal\nConsult a Doctor");
                }
            });
            $("#txtUrineResult").blur(function() {
                var urineresult = $(this).val();

                //                if (urineresult > 0 && urineresult <= 14.41) in mg/dl
                if (urineresult > 0 && urineresult <= 0.8) //in mmol/L
                    alert("Congrats, your urine sugar is normal!!!");
                else
                    alert("You're blood sugar isn't normal\nConsult a Doctor");

            });
            $("#btnRecordSugar").click(function() {
                //remember no primary key for this table
                var uid = $("#txtUidSugar").val();
                var dor = $("#txtDorSugar").val();
                var time = $("#txtTime").val();
                var sugartime = $("#cmbTimeRecord").val();
                var sugarresult = $("#txtSugarResult").val();
                var medintake = $("#txtMedIntake").val();
                var urineresult = $("#txtUrineResult").val();

                if (dor == "")
                    $("#errRecordSugar").hide().html("Fill Date").slideDown();
                else {
                    //for alerts separate blurs functions have been created
                    var url = "patient-recordsugar.php?uid=" + uid + "&dateofrecord=" + dor + "&timerecord=" + time + "&sugartime=" + sugartime + "&sugarresult=" + sugarresult + "&medintake=" + medintake + "&urineresult=" + urineresult;
                    $.get(url, function(response) {
                        $("#errRecordSugar").hide().html(response).slideDown();

                        //resetting fields
                        $("#txtDorSugar").val("");
                        $("#txtTime").val("");
//                        $("#cmbTimeRecord").val("");not required
                        $("#txtSugarResult").val("");
                        $("#txtMedIntake").val("");
                        $("#txtUrineResult").val("");
                    });
                }
            });
        });

    </script>
    <style>
        .card:hover{
            transition: ease all 0.3s;
            box-shadow: 0px 0px 5px 3px lightgrey;
        }
    </style>
</head>

<body>
    <!--   style="background-color:aquamarine"-->

    <!--   style="background-color: mediumblue; color:springgreen;"-->
    <div class="container col-md-12">
        <div class="row" style="background-color: skyblue;">
            <div class="col-md-6 justify-content-center text-center align-items-center offset-3">
                <center>
                    <h1>Dashboard</h1>
                </center>
            </div>
            <div class="col-md-2 justify-content-end align-items-center d-flex text-center">
                <h5>
                    <?php
                echo "Hi, ".$_SESSION["activeuser"];
                ?>
                </h5>
            </div>
            <div class="col-md-1">
                <a href="logout.php">
                    <img src="pics/logout.png" style="height:40px; margin-top:7px; background-size: contain;" alt="">
                </a>
            </div>
        </div>
    </div>
    <br>
    <div class="container col-md-12">
        <div class="form-row">
            <div class="col-md-3 d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="profile-patient.php" style="max-width: 170px; float:left;">
                    <img src="pics/PROFILE%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;">
                            <h4 class="card-title text-white  mt-2">Profile</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="doctor-slip-front.php" style="max-width: 170px; float:left;">
                    <img src="pics/receipt.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;">
                            <h4 class="card-title text-white  mt-2">Doctor Slip</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3 d-flex justify-content-center align-items-center mb-4">
                <div class="card text-decoration-none text-center" data-toggle="modal" data-target="#bp-modal" style="max-width: 170px; cursor:pointer;">
                    <img src="pics/BP%20CLIPART%20FINAL.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;">
                            <h4 class="card-title text-white  mt-2">Record BP</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 d-flex justify-content-center align-items-center mb-4">
                <div class="card text-decoration-none text-center" data-toggle="modal" data-target="#sugar-modal" style="max-width: 170px;cursor:pointer;">
                    <img src="pics/SUGAR%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;padding:0px;">
                            <h4 style="font-size:23px" class="card-title text-white  mt-2">Record Sugar</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-3  d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="doctor-search-front.php" style="max-width: 170px; float:left;">
                    <img src="pics/DOCTOR%20SEARCH%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;padding:0px">
                            <h4 style="font-size:23px" class="card-title text-white  mt-2">Search Doctor</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3  d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="history-doctorslips.php" style="max-width: 170px; float:left;">
                    <img src="pics/SLIP%20HISTORY%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;">
                            <h4 class="card-title text-white  mt-2">Slip History</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3  d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="history-bprecords.php" style="max-width: 170px; float:left;">
                    <img src="pics/BP%20HISTORY%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;">
                            <h4 class="card-title text-white  mt-2">BP History</h4>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-3  d-flex justify-content-center align-items-center mb-4">

                <a class="card text-decoration-none text-center" href="history-sugarrecords.php" style="max-width: 170px; float:left;">
                    <img src="pics/SUGAR%20HISTORY%20CLIPART.png" class="card-img-top" alt="...">
                    <div class="card card-block d-flex">
                        <div class="card-body bg-primary align-items-center d-flex justify-content-center" style="height:51px;padding:0px">
                            <h4 style="font-size:23px" class="card-title text-white  mt-2">Sugar History</h4>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <!--    =========================front end ends here======================-->

    <!--    bp modal-->
    <div class="modal fade" id="bp-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Record BP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   bp form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtUidBp">Username</label>
                                    <input type="text" class="form-control" id="txtUidBp" name="txtUidBp" value="<?php echo $_SESSION["activeuser"];?>" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtDorBp">Date of Record</label>
                                    <label for="txtDorBp" class="text-danger">*</label>
                                    <input type="date" class="form-control" id="txtDorBp" name="txtDorBp">
                                </div>
                                <div class="form-group col-md-5 ml-3">
                                    <label for="txtPulse">Pulse Rate</label>
                                    <input type="number" class="form-control" id="txtPulse" name="txtPulse" placeholder="in (beats/min)">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtSyst">Systolic Pressure</label>
                                    <label for="txtSyst" class="text-danger">*</label>
                                    <input type="number" class="form-control" id="txtSyst" name="txtSyst" placeholder="(in mmHg)">
                                </div>
                                <div class="form-group col-md-5 ml-3">
                                    <label for="txtDia">Diastolic Pressure</label>
                                    <label for="txtDia" class="text-danger">*</label>
                                    <input type="number" class="form-control" id="txtDia" name="txtDia" placeholder="(in mmHg)">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-success" value="Record" id="btnRecordBp">
                    <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                </div>
                <center><span id="errRecordBp" class="text-danger"></span></center>

            </div>
        </div>
    </div>

    <!--    sugar-modal-->
    <div class="modal fade" id="sugar-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Record Sugar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--                   sugar form-->
                    <form>
                        <div class="container">
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtUidSugar">Username</label>
                                    <input type="text" class="form-control" id="txtUidSugar" name="txtUidSugar" value="<?php echo $_SESSION["activeuser"];?>" readonly>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="txtDorSugar">Date of Record</label>
                                    <label for="txtDorSugar" class="text-danger">*</label>
                                    <input type="date" class="form-control" id="txtDorSugar" name="txtDorSugar">
                                </div>
                                <div class="form-group col-md-5 ml-3">
                                    <label for="txtTime">Time</label>
                                    <input type="time" class="form-control" id="txtTime" name="txtTime" step="1">
                                    <!--                                    step="1" helps in introducing seconds in time field-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="card tab-card">
                                        <div class="card-header tab-card-header">
                                            <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="one-tab" data-toggle="tab" href="#blood-sugar" role="tab" aria-controls="One" aria-selected="true">Blood Sugar</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="two-tab" data-toggle="tab" href="#urine-sugar" role="tab" aria-controls="Two" aria-selected="false">Urine Sugar</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content" id="myTabContent">
                                            <!--blood-sugar tab-->
                                            <div class="tab-pane fade show active p-3" id="blood-sugar" role="tabpanel" aria-labelledby="one-tab">
                                                <div class="form-row">
                                                    <div class="col-md-8">
                                                        <label for="">Testing Time</label>
                                                        <select class="custom-select form-control" id="cmbTimeRecord" name="cmbTimeRecord">
                                                            <option value="fasting" selected>Fasting</option>
                                                            <option value="before meal">Before Meal</option>
                                                            <option value="after meal">After Meal</option>
                                                            <option value="before exercise">Before Exercise</option>
                                                            <option value="bedtime">Bedtime</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="txtSugarResult">Result</label>
                                                        <input type="number" class="form-control" id="txtSugarResult" name="txtSugarResult" placeholder="(in mg/dl)">
                                                    </div>
                                                </div>
                                            </div>
                                            <!--urine-sugar tab-->

                                            <div class="tab-pane fade p-3" id="urine-sugar" role="tabpanel" aria-labelledby="two-tab">
                                                <div class="form-row">
                                                    <div class="col-md-8">
                                                        <label for="txtMedIntake">Medicine / Doctor's Advice</label>
                                                        <input type="text" class="form-control" id="txtMedIntake" name="txtMedIntake">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="txtUrineResult">Result</label>
                                                        <input type="number" class="form-control" id="txtUrineResult" name="txtUrineResult" placeholder="(in mmol/L)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer justify-content-center">
                    <input type="button" class="btn btn-success" value="Record" id="btnRecordSugar">
                    <!--                    since no form control was given so, text of "errResultLogin" came along with login button. Hence, this span is pulled out from footer-->
                </div>
                <center><span id="errRecordSugar" class="text-danger"></span></center>

            </div>
        </div>
    </div>
</body>

</html>
<!--
Readme

AT PHPMyAdmin level
Default values for urineresult and sugarresult truncates to 0(while keeping it's field empty)
But for time, default value concept isn't working(while keeping it's field empty). So i am making this happen by altering the time variable in patient-recordsugar

Profile card
==============
href=profile-patient.php

Record BP card
==============
data-target=bp-modal

BP modal
id -> bp-modal
username -> id=txtUidBp, name=txtUidBp
date of record -> id=txtDorBp, name=txtDorBp
Pulse -> id=txtPulse, name=txtPulse
Systolic pressure -> id=txtSyst, name=txtSyst
Diastolic Pressure -> id=txtDia, name=txtDia
Record btn -> id=btnRecord, error ki id=errRecordBp

Record Sugar card
==============
data-target=sugar-modal

Sugar modal
id -> sugar-modal
username -> id=txtUidSugar, name=txtUidSugar
date of record -> id=txtDorSugar, name=txtDorSugar
time -> id=txtTime, name=txtTime
blood sugar link in card -> id=one-tab, href=blood-sugar
urine sugar link in card -> id=two-tab, href=urine-sugar
blood sugar tab id=blood-sugar
    |
    ->  Testing time -> id=cmbTimeRecord, name=cmbTimeRecord
        Result -> id=txtSugarResult, name=txtSugarResult
urine sugar tab id=urine-sugar
    |
    ->  Medicine/Doctor's Advice -> id=txtMedIntake, name=txtMedIntake
        Result -> id=txtUrineResult, name=txtUrineResult
Record btn -> id=btnRecordSugar, error ki id=errRecordSugar 

BP History card
==============
href=history-bprecords.php  

Sugar History card
==============
href=history-sugarrecords.php  

Doctor Slip card
==============
doctor-slip-front.php
-->
