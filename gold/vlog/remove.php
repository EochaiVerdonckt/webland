<?php

$path = getcwd();
$path = str_replace("gold/vlog", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

$conn= $ctrl->getConnection();

$sql = "DELETE FROM `vlog` WHERE id=".$_GET['id'];

if ($conn->query($sql) === TRUE) {
    $_SESSION['input']= "New record created successfully";
} 

$conn->close();

header("Location: /gold/vlog/");
die();