<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];
$mob=$_GET["mob"];
$category=$_GET["category"];

    if($uid!="" && $pwd!="" && $mob!="")
    {
        $query="insert into users values('$uid','$pwd','$mob',CURRENT_DATE(),'$category')";
        $msg=mysqli_query($dbcon,$query);
        if($msg==true)
            echo "Signup Successfull !";
        else
            echo "Account with this username already exists";
    }
    else
        echo "no data filled...";
}
else
    echo $isConnected;
?>