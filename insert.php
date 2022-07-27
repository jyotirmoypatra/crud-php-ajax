<?php

require_once "dbcon.php";

$name= $_POST['name'];
$email= $_POST['email'];
$phone= $_POST['phone'];

$sql="INSERT INTO user (name,email,phone) VALUES ('$name','$email','$phone')";
$sqlQuery= mysqli_query($conn,$sql);
if($sqlQuery){
    echo '1';
}else{
    echo "Error: " . $sql . "" . mysqli_error($conn);
}


?> 