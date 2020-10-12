<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["uid"];
    $dateFrom=$_GET["dateFrom"];
    $dateTo=$_GET["dateTo"];
    
    //in case dateTo is empty
    if($dateTo=="undefined")
        $query="select * from bprecords where uid='$uid' and dateofrecord>='$dateFrom'";
    else
        $query="select * from bprecords where uid='$uid' and dateofrecord>='$dateFrom' and dateofrecord<='$dateTo'";
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