<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);

if($isConnected==""){
    include_once("SMS_OK_sms.php");

$uid=$_GET["uid"];
    if($uid!="")
    {
        $query="select mobile from users where uid='$uid'";
        $record=mysqli_query($dbcon,$query);
        if(mysqli_num_rows($record)==0)
            echo "unauthorized";
        else{
            $row=mysqli_fetch_array($record);//unique
//            echo $row["mobile"];
            $otp=mt_rand(100000,999999);
            $msg="Your OTP is: ".$otp;
                $resp=SendSMS($row["mobile"],$msg);
//                	$resp=SendSMS($mob,"You are signed up successfully...");

            echo ($otp);
        }
    }
    else
        echo "no data filled...";
}
else
    echo $isConnected;
?>