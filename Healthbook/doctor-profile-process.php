<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_POST["txtUid"];
    $contact=$_POST["txtContact"];
    $dname=$_POST["txtDname"];
    
    $email="";//since they aren't mandatory
    if(isset($_POST["txtEmail"]))
        $email=$_POST["txtEmail"];
    
    $ppicOrg=$_FILES["pPic"]["name"];
    $ppicTmp=$_FILES["pPic"]["tmp_name"];
    
    $qual=$_POST["cmbQual"];
    $spl=$_POST["cmbSpl"];
    $studied=$_POST["txtStudied"];
    $hospital=$_POST["txtHospital"];
    $exp=$_POST["txtWorkExp"];
    $address=$_POST["txtAddress"];
    $state=$_POST["cmbState"];
    $city=$_POST["cmbCity"];
    $pincode=$_POST["txtPin"];
    
    $website="";
    if(isset($_POST["txtWebsite"]))
        $website=$_POST["txtWebsite"];
    
    $cpicOrg=$_FILES["cPic"]["name"];
    $cpicTmp=$_FILES["cPic"]["tmp_name"];
    
    $info="";
    if(isset($_POST["txtInfo"]))
        $info=$_POST["txtInfo"];
    
    
    //just in case this file runs alone, empty record can get filled
    if($uid=="" || $contact=="" || $dname=="" || $ppicOrg=="" || $qual=="" || $spl=="" || $studied=="" || $hospital=="" || $exp=="" || $address=="" || $state=="" || $city=="" || $pincode=="" || $cpicOrg=="")
        echo "data entries' empty";
    else{
    $query="insert into doctors values('$uid','$contact','$dname','$email','$ppicOrg','$qual','$spl','$studied','$hospital','$exp','$address','$state','$city','$pincode','$website','$cpicOrg','$info')";
    $msg=mysqli_query($dbcon,$query);
    if($msg==true)
    {
        echo "Form Submission Successfull!";
        move_uploaded_file($ppicTmp,"uploads/".$ppicOrg);
        move_uploaded_file($cpicTmp,"uploads/".$cpicOrg);
    }
    else
        echo "Account already exist";
    }
    
}
else
    echo $isConnected;
?>