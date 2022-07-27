<?php

require_once "dbcon.php";

$dataid= $_POST['id'];



$usersql="SELECT * FROM `user` WHERE id=$dataid";
$userQuery= mysqli_query($conn,$usersql);
$res=array();
while($row= mysqli_fetch_assoc($userQuery)){
$res=$row;
}
echo json_encode($res);

?>