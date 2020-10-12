<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];
    if($pwd!="" && $uid!="")
    {
        $query="update users set pwd='$pwd' where uid='$uid'";
        $msg=mysqli_query($dbcon,$query);
        if($msg==true){
            echo "updated";
        }
        else//not possible generally
            echo $msg;
    }
    else//will happe never
        echo "details not filled...";
}
else
    echo $isConnected;
?>