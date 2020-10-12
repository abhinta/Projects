<?php
session_start();
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
$uid=$_GET["uid"];
$pwd=$_GET["pwd"];
    $query="select pwd,category,mobile from users where uid='$uid'";
    $record=mysqli_query($dbcon,$query);
    
    if(mysqli_num_rows($record)==0)//uid doesn't exist
        echo json_encode("Invalid username/password"); 
    else{
        $ary=array();
        while($row=mysqli_fetch_array($record))//always one or none
            $ary[]=$row;
    
        if($ary[0]['pwd']==$pwd)
        {
            $_SESSION["activeuser"]=$uid;
            $_SESSION["activeusermobile"]=$ary[0]['mobile'];
            echo json_encode($ary[0]['category']);
        }
        else{//if pwd is wrong
            echo json_encode("Invalid username/password");        
        }
    }
    
}
else
    echo json_encode($isConnected);
?>