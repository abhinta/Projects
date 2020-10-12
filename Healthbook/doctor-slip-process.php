<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $patientid=$_POST["txtPatientId"];
    $doctorname=$_POST["txtDoctorName"];
    $dovisit=$_POST["txtDoVisit"];
    $city=$_POST["txtCity"];
    $hospital=$_POST["txtHospital"];
    $problem=$_POST["txtProblem"];
    
    $nextdov="";
    if(isset($_POST["txtNextDov"]))
        $nextdov=$_POST["txtNextDov"];
    $discussion="";
    if(isset($_POST["txtDiscussion"]))
       $discussion=$_POST["txtDiscussion"];
    
    $slippicOrg=$_FILES["slipPic"]["name"];//no need for updation, therefore no jasoos
    $slippicTmp=$_FILES["slipPic"]["tmp_name"];


    //just in case this file runs alone, empty record can get filled
    if($patientid=="" ||
       $doctorname=="" ||
       $dovisit=="" ||
       $city=="" ||
       $hospital=="" ||
       $problem=="" ||
       $slippicOrg=="")
        echo "data entries' empty";
    else{
    $query="insert into slips values(NULL,
    '$patientid',
    '$doctorname',
    '$dovisit',
    '$city',
    '$hospital',
    '$problem',
    '$nextdov',
    '$discussion',
    '$slippicOrg')";
    $msg=mysqli_query($dbcon,$query);
    if($msg==true)
    {
        echo "Slip Submitted Successfully!!!";
        move_uploaded_file($slippicTmp,"uploads/".$slippicOrg);
    }
    else
        echo "Account already exists";
    }
    
}
else
    echo $isConnected;
?>
