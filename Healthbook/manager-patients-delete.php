<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["uid"];
    $query="delete from patients where uid='$uid'";
    $msg=mysqli_query($dbcon,$query);
    
    if($msg=="true")//will always be true and no. of records will always be 1 since uid is unique
        echo "Record Deleted";
}
else
    echo $isConnected;
?>