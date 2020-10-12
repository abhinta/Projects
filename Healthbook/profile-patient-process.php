<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["txtUid"];
    $contact=$_GET["txtContact"];
    $name=$_GET["txtName"];
    $age=$_GET["txtAge"];
    $gender=$_GET["cmbGender"];
    $city=$_GET["txtCity"];
    
    $email="";//since they aren't mandatory
    if(isset($_GET["txtEmail"]))
        $email=$_GET["txtEmail"];
    
    $address=$_GET["txtAddress"];
    $problems=$_GET["txtProblems"];
    
    //just in case this file runs alone, empty record can get filled
    if($uid=="" || $contact=="" || $name=="" || $age=="" || $city=="" || $address=="" || $problems=="")
        echo "data entries' empty";
    else{
    $query="insert into patients values('$uid','$contact','$name','$age','$gender','$city','$email','$address','$problems')";
    $msg=mysqli_query($dbcon,$query);
    if($msg==true)
    {
        echo "Form Submission Successfull!";
    }
    else
        echo "Account already exists";
    }
    
}
else
    echo $isConnected;
?>