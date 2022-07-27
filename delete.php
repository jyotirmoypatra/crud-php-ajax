<?php

require_once "dbcon.php";

$id= $_POST['id'];


$dltsql="DELETE FROM user WHERE id=$id";
$deleteQuery= mysqli_query($conn,$dltsql);
if($deleteQuery){
    echo '1';
}else{
    echo "Error: " . $sql . "" . mysqli_error($conn);
}


?> 