<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $query="select * from doctors";
    $record=mysqli_query($dbcon,$query);
    $ary=array();
    while($row=mysqli_fetch_array($record)){
        $ary[]=$row;
    }
    echo json_encode($ary);
}
else
    echo $isConnected;
?>