<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
   $uid=$_GET["uid"];
    $query="select * from doctors where uid='$uid'";
    $record=mysqli_query($dbcon,$query);
    $ary=array();
    while($row=mysqli_fetch_array($record))//unique always
        $ary[]=$row;
    echo json_encode($ary);
}
else
    echo json_encode("flag".$isConnected);
?>