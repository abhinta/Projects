<?php
//WORKS(implicitly) for both cases, whether user clicks fetch button or not

include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_POST["txtUid"];
//    $mobile=$_POST["txtMobile"];not required, only uid is sufficient
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
    
    $pPicJasoos=$_POST["pPicJasoos"];
    $cPicJasoos=$_POST["cPicJasoos"];
    
    $info="";
    if(isset($_POST["txtInfo"]))
        $info=$_POST["txtInfo"];
    
    //whether he selects new images or wants it unchanged
    $filenameppic=$pPicJasoos;
        if($ppicOrg!="")
            $filenameppic=$ppicOrg;
    $filenamecpic=$cPicJasoos;
        if($cpicOrg!="")
            $filenamecpic=$cpicOrg;
    
    
    //just in case this file runs alone, empty record can get filled
    if($uid=="" || $dname=="" || $filenameppic=="" || $qual=="" || $spl=="" || $studied=="" || $hospital=="" || $exp=="" || $address=="" || $state=="" || $city=="" || $pincode=="" || $filenamecpic=="")
        echo "data entries' empty";
    else{
        $query="select * from doctors where uid='$uid'";
        $record=mysqli_query($dbcon,$query);
        $row=mysqli_num_rows($record);//always unique
        if($row==0){//first time registration
            echo "Your account must be registered first. Fill details and click submit";
        }
        else{
            //here the user is a registered one with all (necessary)fields filled..hence, there would be never error
    $query="update doctors 
    set dname='$dname',
    email='$email',
    ppic='$filenameppic',
    qual='$qual',
    spl='$spl',
    studied='$studied',
    hospital='$hospital',
    exp='$exp',
    address='$address',
    state='$state',
    city='$city',
    pincode='$pincode',
    website='$website',
    cpic='$filenamecpic',
    info='$info' where uid='$uid'";
    $msg=mysqli_query($dbcon,$query);
            if($msg==true){
        echo "Updation Successfull!";
        if($filenameppic==$ppicOrg)
            move_uploaded_file($ppicTmp,"uploads/".$ppicOrg);
        if($filenamecpic==$cpicOrg)
            move_uploaded_file($cpicTmp,"uploads/".$cpicOrg);
        }
            else
                echo "lolololo";//not ever possible
       
    }
    
}
}
else
    echo $isConnected;
?>
