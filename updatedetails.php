<?php

require_once "dbcon.php";

$id= $_POST['id'];
$name= $_POST['name'];
$email= $_POST['email'];
$phone= $_POST['phone'];

echo $id.$name.$email.$phone;

$updatesql="UPDATE user SET name='$name',email='$email',phone='$phone' WHERE id=$id";
$updateQuery= mysqli_query($conn,$updatesql);
if($updateQuery){
    echo '1';
}else{
    echo "Error: " . $sql . "" . mysqli_error($conn);
}

?>