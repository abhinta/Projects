<!--
not making any record primary doesn't harm
because ultimately this table's record isn't going to change
-->
<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["uid"];
    $pulse=$_GET["pulse"];
    $dateofrecord=$_GET["dateofrecord"]; 
    $syst=$_GET["syst"];//higher one
    $dia=$_GET["dia"];
    
    if($uid=="" || $dateofrecord=="" || $dia=="" || $syst=="")
        echo "Fill all details first";
    else{
        $query="insert into bprecords values('$uid','$pulse','$dateofrecord','$syst','$dia')";
    $msg=mysqli_query($dbcon,$query);
    
        if($msg=="true")//always true
            echo "Record Submitted";
        else
            echo "Failed";
    }
    
}
else
    echo $isConnected;
?>