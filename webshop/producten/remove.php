<?php
session_start();

$path = getcwd();
$path = str_replace("producten", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


$service=$ctrl->selectStatement('product',' id='.$_GET['id']);
$ctrl->updateStatement('product','publish',0,$_GET['id']);
$ctrl->updateStatement('product','removed',1,$_GET['id']);
     header('Location: /producten/detail.php?id='.$service['catog']);
     exit();
?>