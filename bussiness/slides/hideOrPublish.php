<?php
session_start();
$path = getcwd();
$path = str_replace("slides", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


$service=$ctrl->selectStatement('slides',' id='.$_GET['id']);
if($service['publish']==1){
    $ctrl->updateStatement('slides','publish',0,$_GET['id']);
}
else{
    $ctrl->updateStatement('slides','publish',1,$_GET['id']);
}
     header('Location: /slides/index.php');
     exit();
?>