<?php
session_start();
$path = getcwd();
$path = str_replace("gold/blog", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


$service=$ctrl->selectStatement('news',' id='.$_GET['id']);
if($service['publish']==1){
    $ctrl->updateStatement('news','publish',0,$_GET['id']);
}
else{
    $ctrl->updateStatement('news','publish',1,$_GET['id']);
}
     header('Location: /gold/blog/index.php');
     exit();
?>