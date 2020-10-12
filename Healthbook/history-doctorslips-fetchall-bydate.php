<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $patientid=$_GET["patientid"];
    $dateFrom=$_GET["dateFrom"];
    $dateTo=$_GET["dateTo"];
    
    //in case dateTo is empty
    if($dateTo=="undefined")
        $query="select * from slips where patientid='$patientid' and dovisit>='$dateFrom'";
    else
        $query="select * from slips where patientid='$patientid' and dovisit>='$dateFrom' and dovisit<='$dateTo'";
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