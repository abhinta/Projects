<?php
include_once("connection.php");
$isConnected=mysqli_error($dbcon);
if($isConnected==""){
    $uid=$_GET["txtUid"];
//    $contact=$_GET["txtContact"];only uid is sufficient for updating. Contact is readonly
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
    if($uid=="" || $name=="" || $age=="" || $city=="" || $address=="" || $problems=="")
        echo "data entries' empty";
    else{
        $query="select * from patients where uid='$uid'";
        $record=mysqli_query($dbcon,$query);
        $row=mysqli_num_rows($record);//always unique
        if($row==0){//first time registration
            echo "Your account must be registered first. Fill details and click submit";
        }
        else{
        
            $query="update patients set 
            name ='$name',
            age ='$age',
            gender ='$gender',
            city ='$city',
            email ='$email',
            address ='$address',
            problems ='$problems' where uid='$uid'";
            
            $msg=mysqli_query($dbcon,$query);
            if($msg==true)
            {
                echo "Updation Successfull!";
            }
            else
                echo "Account already exists";
        }
    }
}
else
    echo $isConnected;
?>