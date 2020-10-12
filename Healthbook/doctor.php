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
    <title>Doctor Portfolio</title>
    <style>
        /*
        #pPic:focus{
            outline: none;
        }
*/
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
            $("#txtContact").blur(function() {
                var r = /^[6-9]{1}[0-9]{9}$/;
                var contact = $(this).val();
                var result = r.test(contact);
                if (result == true) {
                    
                    $("#errResult").html("");
                    $("#txtContact").css("box-shadow", "");
                } else {
                    
                    $("#errResult").hide().html("Type a valid contact no.").slideDown();
                    $("#txtContact").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtDname").blur(function() {
                var r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;
                var dname = $(this).val();
                var result = r.test(dname);
                if (result == true && dname.length <= 30) {
                    
                    $("#errResult").html("");
                    $("#txtDname").css("box-shadow", "");
                } else {
                    
                    $("#errResult").hide().html("Type name with max 30 characters. Use alphabets only and Remove unneccesary spaces").slideDown();
                    $("#txtDname").css("box-shadow", "0px 0px 3px 3px red");
                }
            });
            $("#txtEmail").blur(function() {
                var email = $(this).val();
                if (email != "") {
                    var r = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
                    var result = r.test(email);
                    if (result == true && email.length <= 60) {
                        $("#errResult").html("");
                        $("#txtEmail").css("box-shadow", "");

                    } else {
                        
                        $("#errResult").hide().html("Type a legal email address with max 60 characters").slideDown();
                        $("#txtEmail").css("box-shadow", "0px 0px 3px 3px red");

                    }
                }
            });

            $("#cmbQual").blur(function() {
                var qual = $(this).val();
                if (qual == "none") {
                    
                    $("#errResult").hide().html("Select your Qualification").slideDown();
                    $("#cmbQual").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#cmbQual").css("box-shadow", "");
            });
            $("#cmbSpl").blur(function() {
                var spl = $(this).val();
                if (spl == "none") {
                    
                    $("#errResult").hide().html("Select your Speciality").slideDown();
                    $("#cmbSpl").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#cmbSpl").css("box-shadow", "");
            });
            $("#txtStudied").blur(function() {
                var studied = $(this).val();
                if (studied == "" || studied.length > 30) {
                    
                    $("#errResult").hide().html("Type your medical school/institute name with max 30 characters").slideDown();
                    $("#txtStudied").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#txtStudied").css("box-shadow", "");
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
            $("#txtWorkExp").blur(function() {
                var exp = $(this).val();
                if (exp > 90 || exp < 0 || exp == "") {
                    
                    $("#errResult").hide().html("Fill a valid no. of work experience years").slideDown();
                    $("#txtWorkExp").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#txtWorkExp").css("box-shadow", "");

            });
            $("#txtAddress").blur(function() {
                var address = $(this).val();
                if (address == "" || address.length > 60) {
                    
                    $("#errResult").hide().html("Type hospital's address with max 60 characters").slideDown();
                    $("#txtAddress").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#txtAddress").css("box-shadow", "");

            });
            $("#cmbState").change(function() {
                var state = $(this).val();
                if (state == "none") {
                    
                    $("#errResult").hide().html("Select state where your hospital/trust/clinic exists").slideDown();
                    $("#cmbState").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                var url = "doctor-fetch-city.php";
                $.getJSON(url, {
                    state: state
                }, function(jsonArray) {

                    $("#cmbCity").prop("length", 1); //resetting city combobox

                    //                    jsonArray.forEach(function(i) {
                    //                        var opt = document.createElement("option");
                    //                        opt.text = i.city_name;
                    //                        opt.value = i.city_name;
                    //                        document.getElementById("cmbCity").append(opt);
                    //
                    //                    }); WORKS FINE
                    for (i = 0; i < jsonArray.length; i++) {
                        var opt = document.createElement("option");
                        opt.text = jsonArray[i].city_name;
                        opt.value = jsonArray[i].city_name;
                        document.getElementById("cmbCity").append(opt);
                    }

                });
                
                $("#errResult").html("");
                $("#cmbState").css("box-shadow", "");
            });
            $("#cmbCity").change(function() {
                var city = $(this).val();
                if (city == "none") {
                    
                    $("#errResult").hide().html("Select city where your hospital/trust/clinic exists").slideDown();
                    $("#cmbCity").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#cmbCity").css("box-shadow", "");
            });
            $("#txtPin").blur(function() {
                var pincode = $(this).val();
                var r = /^[1-9]{1}[0-9]{5}$/;
                var result = r.test(pincode);
                if (result == false) {
                    
                    $("#errResult").hide().html("Enter a valid pincode").slideDown();
                    $("#txtPin").css("box-shadow", "0px 0px 3px 3px red");

                    return;
                }
                var url = "doctor-chk-pincode.php?pincode=" + pincode;
                $.get(url, function(response) {
                    if (response == "Invalid") {
                        
                        $("#errResult").hide().html("Enter a valid pincode").slideDown();
                        $("#txtPin").css("box-shadow", "0px 0px 3px 3px red");

                    } else {
                        
                        $("#errResult").html("");
                        $("#txtPin").css("box-shadow", "");
                    }
                });
            });
            $("#txtWebsite").blur(function() {
                var website = $(this).val();
                if (website != "") {
                    var r = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
                    var result = r.test(website);
                    if (result == false || website.length > 60) {
                        
                        $("#errResult").hide().html("Enter a valid website name with max 60 characters").slideDown();
                        $("#txtWebsite").css("box-shadow", "0px 0px 3px 3px red");

                    } else {
                        $("#errResult").html("");
                        $("#txtWebsite").css("box-shadow", "");
                    }
                }
            });
            $("#txtInfo").blur(function() {
                var info = $(this).val();
                if (info != "") {

                    if (info.length > 50) {
                        
                        $("#errResult").hide().html("Write info with charcacter limit 50").slideDown();
                        $("#txtInfo").css("box-shadow", "0px 0px 3px 3px red");

                    } else {
                        $("#errResult").html("");
                        $("#txtInfo").css("box-shadow", "");
                    }
                } else {
                    $("#errResult").html("");
                    $("#txtInfo").css("box-shadow", "");
                }
            });
            $("#pPic").blur(function() {
                var picName = $(this).val();
                if (picName == "" || picName.length > 66) {
                    
                    $("#errResult").hide().html("Select a profile pic with name having characters less than 60").slideDown();
                    $("#pPic").css("box-shadow", "0px 0px 3px 3px red");
                    return;
                }
                
                $("#errResult").html("");
                $("#pPic").css("box-shadow", "");
            });
            $("#cPic").blur(function() {
                var picName = $(this).val();
                if (picName == "" || picName.length > 66) {
                    
                    $("#errResult").hide().html("Select a certificate pic with name having characters less than 60").slideDown();
                    $("#cPic").css("box-shadow", "0px 0px 3px 3px red");

                    return;
                }
                
                $("#errResult").html("");
                $("#cPic").css("box-shadow", "");

            });
            $("#btnFetch").click(function() {
                var url = "doctor-fetch-details.php";
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

                        //since we are not displaying certificate, we can alter the field name of Degree certificate to Upload new Degree Certificate
                        //we can alter field name of pPic too
                        $("#labelDegCerti").html("Upload new Degree Certificate");
                        $("#labelDegCertiStar").html("");
                        $("#labelpPic").html("Upload new Profile Pic");
                        $("#labelpPicStar").html("");
                        //since it is not compulsory to upload new images
                        $("#pPic").prop("required", false);
                        $("#cPic").prop("required", false);
                        //also, we must disable submit button
                        //already taken vare by onSubmit event handler

                        //                        =======--------=============--------------========
                        //css property is applied...because of the edge case(that person might enter wrong data and then fetch the details)
                        $("#txtContact").val(jsonArray[0].contact).css("box-shadow", "");
                        $("#txtDname").val(jsonArray[0].dname).css("box-shadow", "");
                        $("#txtEmail").val(jsonArray[0].email).css("box-shadow", "");
                        $("#txtStudied").val(jsonArray[0].studied).css("box-shadow", "");
                        $("#txtHospital").val(jsonArray[0].hospital).css("box-shadow", "");
                        $("#txtWorkExp").val(jsonArray[0].exp).css("box-shadow", "");
                        $("#txtAddress").val(jsonArray[0].address).css("box-shadow", "");
                        $("#txtPin").val(jsonArray[0].pincode).css("box-shadow", "");
                        $("#txtWebsite").val(jsonArray[0].website).css("box-shadow", "");
                        $("#txtInfo").val(jsonArray[0].info).css("box-shadow", "");

                        $("#cmbQual").val(jsonArray[0].qual).css("box-shadow", "");
                        $("#cmbSpl").val(jsonArray[0].spl).css("box-shadow", "");
                        $("#cmbState").val(jsonArray[0].state).css("box-shadow", "");
                        $("#cmbCity").css("box-shadow", "");

                        //copying code from cmbState.change function
                        var url2 = "doctor-fetch-city.php";
                        $.getJSON(url2, {
                            state: jsonArray[0].state
                        }, function(jsonArrayy) {

                            $("#cmbCity").prop("length", 1); //resetting city combobox

                            for (i = 0; i < jsonArrayy.length; i++) {
                                var opt = document.createElement("option");
                                opt.text = jsonArrayy[i].city_name;
                                opt.value = jsonArrayy[i].city_name;
                                document.getElementById("cmbCity").append(opt);
                            }
                            //$("#cmbCity").val(jsonArray[0].city); //doesn't work
                            //                         alert(jsonArray[0].city);   
                            document.getElementById("cmbCity").value = jsonArray[0].city;

                        });
                        //$("#cmbCity").val(jsonArray[0].city);//doesn't work...must be inside above function

                        $("#samplePic").prop("src", "uploads/" + jsonArray[0].ppic);
                        $("#pPicJasoos").val(jsonArray[0].ppic);
                        $("#cPicJasoos").val(jsonArray[0].cpic);

                        $("#errResult").html(""); //boxes outer glow cancelled already from every field
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

            var txtContact = document.getElementById("txtContact").value;
            var txtDname = document.getElementById("txtDname").value;
            var txtEmail = document.getElementById("txtEmail").value;
            var pPic = document.getElementById("pPic").value;
            var cmbQual = document.getElementById("cmbQual").value;
            var cmbSpl = document.getElementById("cmbSpl").value;
            var txtStudied = document.getElementById("txtStudied").value;
            var txtHospital = document.getElementById("txtHospital").value;
            var txtWorkExp = document.getElementById("txtWorkExp").value;
            var txtAddress = document.getElementById("txtAddress").value;
            var cmbState = document.getElementById("cmbState").value;
            var cmbCity = document.getElementById("cmbCity").value;
            var txtPin = document.getElementById("txtPin").value;
            var txtWebsite = document.getElementById("txtWebsite").value;
            var cPic = document.getElementById("cPic").value;
            var txtInfo = document.getElementById("txtInfo").value;

            var r = /^[6-9]{1}[0-9]{9}$/;
            var result = r.test(txtContact);
            if (result == false)
                return false;
            r = /^([A-Za-z]+ )+[A-Za-z]+$|^[A-Za-z]+$/;

            result = r.test(txtDname);
            if (result == false || txtDname.length > 30)
                return false;

            r = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
            result = r.test(txtEmail);
            if (txtEmail != "") {
                if (result == false || txtEmail.length > 60)
                    return false;
            }
            if (pPic.length == 0) {
                if(document.getElementById("pPicJasoos").value.length==0)
                    return false;
            }
            
            if (pPic.length > 66) //cases for empty field won't pe possible in case of required
                return false;
            if (cPic.length > 66) //cases for empty field won't pe possible in case of required
                return false;

            //            alert(cmbQual); //works
            if (cmbQual == "none")
                return false;
            if (cmbSpl == "none")
                return false;

            if (txtStudied == "" || txtStudied.length > 30)
                return false;
            if (txtHospital == "" || txtHospital.length > 40)
                return false;

            if (txtWorkExp > 90 || txtWorkExp < 0 || txtWorkExp == "" || txtWorkExp.indexOf('e') != -1) {
                alert("Avoid Scientific Notation");
                return false;
            }
            if (txtAddress == "" || txtAddress.length > 60)
                return false;

            if (cmbState == "none")
                return false;
            if (cmbCity == "none")
                return false;

            r = /^[1-9]{1}[0-9]{5}$/; //loophole...since it isn't checked from database
            result = r.test(txtPin);
            if (result == false)
                return false;

            r = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
            result = r.test(txtWebsite);
            if (txtWebsite != "") {
                if (result == false || txtWebsite.length > 60)
                    return false;
            }

            if (txtInfo != "") {
                if (txtInfo.length > 50)
                    return false;
            }
            
            return true;
        }

    </script>
</head>

<body>
    <div id="processing"></div>
    <form action="doctor-profile-process.php" method="post" enctype="multipart/form-data" onSubmit="return checkform()">
        <input type="hidden" id="pPicJasoos" name="pPicJasoos">
        <input type="hidden" id="cPicJasoos" name="cPicJasoos">
        <div class="container col-md-8">
            <!--           form heading-->
            <div class="row text-white" style="background-color: dodgerblue;">
                <div class="col-md-10 offset-1">
                    <center>
                        <h1>Doctor Profile</h1>
                    </center>
                </div>
                <div class="col-md-1">
                    <a href="logout.php">
                        <img src="pics/logout.png" style="height:40px; margin-top:7px; background-size: contain;" alt="">
                    </a>
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
                    <input type="text" class="form-control" id="txtUid" name="txtUid" value="<?php echo $_SESSION["activeuser"]?>" readonly>
                </div>
                <div class="form-group col-md-3 ml-3">
                    <label for="txtContact" class="col-form-label">Contact</label>
                    <label for="txtContact" class="text-danger">*</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91</span>
                        </div>
                        <input type="text" class="form-control" id="txtContact" name="txtContact" value="<?php echo $_SESSION["activeusermobile"]?>" placeholder="contact no.">
                    </div>
                </div>
                <div class="col-md-2 form-group ml-3" style="margin-top:37.5px;">
                    <input type="button" class="btn btn-outline-info form-control" value="Fetch" id="btnFetch">
                </div>
                <div class="col-md-2 form-group ml-5" style="margin-top:0px;">
                    <img src="pics/user-regular-edited.png" width="150" height="160" alt="image not available" id="samplePic">
                </div>

            </div>

            <h2>Personal Details</h2>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="txtDname">Name</label>
                    <label for="txtDname" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtDname" name="txtDname" placeholder="Full Name" autofocus>
                </div>
                <div class="form-group col-md-5">
                    <label for="txtEmail">Email</label>
                    <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="username@example.com">
                </div>

                <div class="form-group col-md-4">
                    <label for="pPic" id="labelpPic">Profile Pic</label>
                    <label for="pPic" id="labelpPicStar" class="text-danger">*</label>
                    <input type="file" required id="pPic" name="pPic" class="form-control" style="border:0px;padding:0px;padding-top:2px;" onchange="showpreview(this);">
                </div>
                <!--            ///////////////////////////////////////////////////outline not getting removed/////////////-->
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">Qualification</label>
                    <label for="" class="text-danger">*</label>
                    <!--                       required has no use here-->
                    <!--                    onchange has no purpose right now-->
                    <select class="custom-select form-control" id="cmbQual" name="cmbQual" onchange="doQual(this);">
                        <option value="none" selected>--select--</option>
                        <option value="mbbs">MBBS – Bachelor of Medicine, Bachelor of Surgery</option>
                        <option value="bds">BDS – Bachelor of Dental Surgery</option>
                        <option value="bams">BAMS – Bachelor of Ayurvedic Medicine and Surgery</option>
                        <option value="bums">BUMS – Bachelor of Unani Medicine and Surgery</option>
                        <option value="bhms">BHMS – Bachelor of Homeopathy Medicine and Surgery</option>
                        <option value="byns">BYNS- Bachelor of Yoga and Naturopathy Sciences</option>
                        <option value="bvscah">B.V.Sc and AH- Bachelor of Veterinary Sciences and Animal Husbandry</option>
                        <option value="dnb">DNB - Diplomate of National Board</option>
                        <option value="mds">MDS - Master of Dental Surgery</option>
                        <option value="md">MD - Doctor of Medicine</option>
                        <option value="ms">MS - Masters of Surgery</option>
                        <option value="dm">D.M. - Super Specialty Degree in Medicine</option>
                        <option value="mch">M.Ch - Super Specialty Degree in Surgery</option>
                    </select>
                </div>
                <!--                /////////////////////i want --select-- to be default selected//////////////////////////////////////////-->
                <div class="form-group col-md-4">
                    <label for="">Specialization </label>
                    <label for="" class="text-danger">*</label>
                    <!--                    onchange has no purpose right now-->
                    <select class="custom-select form-control" id="cmbSpl" name="cmbSpl" onchange="doSpl(this);">
                        <option value="none" selected>--select--</option>
                        <option>Anaesthesia</option>
                        <option>Anatomy</option>
                        <option>Bariatric Surgery</option>
                        <option>Biochemistry</option>
                        <option>Cardiology - Interventional</option>
                        <option>Cardiology - Non Interventional</option>
                        <option>Cardiothoracic And Vascular Surgery</option>
                        <option>Centre For Spinal Diseases</option>
                        <option>Clinical Haematology And BMT</option>
                        <option>Community Health</option>
                        <option>Corneal Transplant</option>
                        <option>Critical Care Medicine</option>
                        <option>Dermatology</option>
                        <option>Dermatology And Cosmetology</option>
                        <option>Ear, Nose and Throat</option>
                        <option>Emergency Medicine</option>
                        <option>Emergency and Critical care</option>
                        <option>Endocrinology</option>
                        <option>Family Medicine</option>
                        <option>Field Epidemiology</option>
                        <option>Forensic Medicine</option>
                        <option>General Medicine</option>
                        <option>General Surgery</option>
                        <option>Health Administration</option>
                        <option>Immunohematology and transfusion medicine</option>
                        <option>In-Vitro Fertilisation (IVF)</option>
                        <option>Infectious Diseases</option>
                        <option>Internal Medicine</option>
                        <option>Laboratory Medicine</option>
                        <option>Liver Transplant and Hepatic Surgery</option>
                        <option>Maternal and Child Health</option>
                        <option>Maxillofacial Surgery</option>
                        <option>Medical Oncology</option>
                        <option>Medical Oncology and Clinical Hematology</option>
                        <option>Microbiology</option>
                        <option>Minimally Invasive Gynecology</option>
                        <option>Neonatology</option>
                        <option>Nephrology</option>
                        <option>Neuro Modulation</option>
                        <option>Neurology</option>
                        <option>Neurosurgery</option>
                        <option>Nuclear Medicine</option>
                        <option>Nutrition and Dietetics</option>
                        <option>Obstetrics and Gynaecology</option>
                        <option>Ophthalmology</option>
                        <option>Orthopaedic Surgery</option>
                        <option>Orthopaedics</option>
                        <option>Oto-Rhino Laryngology</option>
                        <option>Paediatrics</option>
                        <option>Pain Management</option>
                        <option>Palliative Medicine</option>
                        <option>Pathology</option>
                        <option>Paediatric Surgery</option>
                        <option>Pharmacology</option>
                        <option>Physical Medicine and Rehabilitation</option>
                        <option>Physiology</option>
                        <option>Physiotherapy</option>
                        <option>Psychiatry</option>
                        <option>Pulmonology</option>
                        <option>Radio-Diagnosis</option>
                        <option>Radio-Therapy</option>
                        <option>Renal Transplant</option>
                        <option>Reproductive Medicine and IVF</option>
                        <option>Respiratory diseases</option>
                        <option>Rheumatology</option>
                        <option>Robotic Surgery</option>
                        <option>Rural Surgery</option>
                        <option>Skin and Vereral diseases</option>
                        <option>Social and Preventive Medicine</option>
                        <option>Surgical Gastroenterology</option>
                        <option>Transfusion Medicine</option>
                        <option>Tropical Medicine</option>
                        <option>Tuberculosis and Respiratory diseases</option>
                        <option>Urology</option>
                        <option>Vascular and endovascular surgery</option>
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="txtStudied">Studied from</label>
                    <label for="txtStudied" class="text-danger">*</label>
                    <input type="input" class="form-control" required id="txtStudied" name="txtStudied" placeholder="eg. jipmer, pondicherry">
                </div>
            </div>

            <label for="">&nbsp;</label>

            <h2>Professional Details</h2>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="txtHospital">Hospital / Trust / Clinic Name</label>
                    <label for="txtHospital" class="text-danger">*</label>

                    <input type="text" class="form-control" required id="txtHospital" name="txtHospital">
                </div>
                <div class="form-group col-md-4">
                    <label for="txtWorkExp">Work Experience</label>
                    <label for="txtWorkExp" class="text-danger">*</label>

                    <input type="number" max="85" class="form-control" required id="txtWorkExp" name="txtWorkExp" placeholder="(in years)">
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="txtAddress">Address</label>
                    <label for="txtAddress" class="text-danger">*</label>
                    <input type="text" class="form-control" required id="txtAddress" name="txtAddress" placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="">State</label>
                    <label for="" class="text-danger">*</label>
                    <select class="custom-select form-control" id="cmbState" , name="cmbState">
                        <option value="none">--select--</option>
                        <option>Andaman &amp; Nicobar Islands</option>
                        <option>Andhra Pradesh</option>
                        <option>Arunachal Pradesh</option>
                        <option>Assam</option>
                        <option>Bihar</option>
                        <option>Chandigarh</option>
                        <option>Chhattisgarh</option>
                        <option>Dadra &amp; Nagar Haveli</option>
                        <option>Daman &amp; Diu</option>
                        <option>Delhi</option>
                        <option>Goa</option>
                        <option>Gujarat</option>
                        <option>Haryana</option>
                        <option>Himachal Pradesh</option>
                        <option>Jammu &amp; Kashmir</option>
                        <option>Jharkhand</option>
                        <option>Karnataka</option>
                        <option>Kerala</option>
                        <!--                        <option>Ladakh</option> skip them, databases aren't that updated-->
                        <option>Lakshadweep</option>
                        <option>Madhya Pradesh</option>
                        <option>Maharashtra</option>
                        <option>Manipur</option>
                        <option>Meghalaya</option>
                        <option>Mizoram</option>
                        <option>Nagaland</option>
                        <option>Odisha</option>
                        <option>Pondicherry</option>
                        <option>Punjab</option>
                        <option>Rajasthan</option>
                        <option>Sikkim</option>
                        <option>Tamil Nadu</option>
                        <!--                        <option>Telangana</option>-->
                        <option>Tripura</option>
                        <option>Uttar Pradesh</option>
                        <option>Uttarakhand</option>
                        <option>West Bengal</option>
                    </select>
                </div>
                <div class="form-group col-md-4 ml-3 mr-3">
                    <label for="">City</label>
                    <label for="" class="text-danger">*</label>
                    <select class="custom-select form-control" id="cmbCity" , name="cmbCity">
                        <option value="none">--select--</option>
                    </select>
                </div>

                <div class="form-group col-md-3">
                    <label for="txtPin">Pin code</label>
                    <label for="txtPin" class="text-danger">*</label>
                    <input type="input" class="form-control" id="txtPin" name="txtPin" placeholder="">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="txtWebsite">Website</label>
                    <input type="text" class="form-control" id="txtWebsite" name="txtWebsite" placeholder="example.com">
                </div>
                <div class="form-group col-md-6 ml-4">
                    <label for="cPic" id="labelDegCerti">Degree Certificate</label>
                    <label for="cPic" id="labelDegCertiStar" class="text-danger">*</label>
                    <input type="file" required id="cPic" name="cPic" class="form-control" style="border:0px;padding:0px;padding-top:2px;">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="txtInfo">Additional Info</label>
                    <textarea rows="5" class="form-control" id="txtInfo" name="txtInfo" style="resize:none;"></textarea>
                </div>
            </div>
            <div class="form-row mt-2">
                <div class="form-group col-md-5 ml-5">
                    <input type="submit" class="btn-lg btn-primary form-control" value="Submit" id="btnSubmit">
                </div>
                <div class="form-group col-md-5 ml-4">
                    <input type="submit" class="btn-lg btn-danger form-control" value="Update" id="btnUpdate" formaction="doctor-update.php">
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
There are numerous medical courses which are offered without NEET; since their abbrev. weren't available...so not included

...===not mandatory

hidden fields(jasoos for ppic) -> id=pPicJasoos, name=pPicJasoos
hidden fields(jasoos for cpic) -> id=cPicJasoos, name=cPicJasoos

username -> id=txtUid, name=txtUid
mobile no. ->id=txtContact, name=txtContact
fetch button ->id=btnFetch, value=Fetch
samplePic->id=samplePic


personal details:
doctor name -> id=txtDname, name=txtDname
...email -> id=txtEmail, name=txtEmail
profile pic -> label ki id=labelpPic, label ke star ki id=labelpPicStar, id=pPic,  name=pPic onchange=showpreview()
qualification -> id=cmbQual, name=cmbQual, onchange=doQual(),    onchange has no purpose right now
Splialization -> id=cmbSpl, name=cmbSpl, onchange=doSpl(),    onchange has no purpose right now

studied from -> id=txtStudied, name=txtStudied


professional details:
hospital/trust/clinic -> id=txtHospital, name=txtHospital
work exp. -> id=txtWorkExp, name=txtWorkExp
address -> id=txtAddress,name=txtAddress
state -> id=cmbState, name=cmbState 
city -> id=cmbCity, name=cmbCity 
pin code -> id=txtPin, name=txtPin
...website -> id=txtWebsite, name=txtWebsite
degree certifcate -> label ki id=labelDegCerti, label ke star ki id=labelDegCertiStar, id=cPic, name=cPic
...textarea -> id=txtInfo, name=txtInfo
submit btn -> id=btnSubmit, value=Submit
update btn -> id=btnUpdate, value=Update
Resulting span -> id=errResult
-->

<!--Important
pintable and citytable databases are independent of each other
although, there can be a relation in pincodes and cities(in citytable)...then, little spelling error can affect the searching process(done by patient to find a doctor)
-->
<!--assumption
all uploaded files have different name
-->
<!--pending updation
DONE 1.username and mobile must be readonly

DONE 2.Biggest loophole: submit(&update) ke chalne se pehle fields ki validity check
    DONE 2.1.update submit button->disable/enable toggling
    concept cleared 2.2.combobox doesn't have required
-->
