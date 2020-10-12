<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $state=$_GET["state"];
    $query="select city_name from citytable where city_state='$state'";
    $record=mysqli_query($dbcon,$query);
    $ary=array();
    while($row=mysqli_fetch_array($record))
        $ary[]=$row;
    echo json_encode($ary);
}
else
    echo json_encode($isConnected);
?>