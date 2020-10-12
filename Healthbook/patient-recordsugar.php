<!--
not making any record primary doesn't harm
because ultimately this table's record isn't going to change
-->
<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["uid"];
    $dateofrecord=$_GET["dateofrecord"];
    $timerecord=$_GET["timerecord"];
    $sugartime=$_GET["sugartime"];
    $sugarresult=$_GET["sugarresult"];
    $medintake=$_GET["medintake"];
    $urineresult=$_GET["urineresult"];
    
    if($uid=="" || $dateofrecord=="")
        echo "Fill all details first";
    else{
        //since default time was not getting recorded even if time field was empty at front end

        if($timerecord=="")
            $query="insert into sugarrecord values('$uid', '$dateofrecord', CURRENT_TIME, '$sugartime', '$sugarresult', '$medintake', '$urineresult')";
        else
            $query="insert into sugarrecord values('$uid', '$dateofrecord', '$timerecord', '$sugartime', '$sugarresult', '$medintake', '$urineresult')";
        
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