<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $pincode=$_GET["pincode"];
    $query="select * from pintable where pincode='$pincode'";
    $record=mysqli_query($dbcon,$query);
    $rows=mysqli_num_rows($record);
    if($rows==0)
        echo "Invalid";
    else
        echo "Valid";
}
else
    echo $isConnected;
?>