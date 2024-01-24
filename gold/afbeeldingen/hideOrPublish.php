<?php
session_start();
$path = getcwd();
$path = str_replace("gold/afbeeldingen", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


$service=$ctrl->selectStatement('artikel_balance',' id='.$_GET['id']);
if($service['state']==1){
    $ctrl->updateStatement('artikel_balance','state',0,$_GET['id']);
}
else{
    $ctrl->updateStatement('artikel_balance','state',1,$_GET['id']);
}
     header('Location: /gold/afbeeldingen/');
     exit();
?>