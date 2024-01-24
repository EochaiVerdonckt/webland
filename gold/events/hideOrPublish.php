<?php
session_start();
$path = getcwd();
$path = str_replace("events", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 

$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


$service=$ctrl->selectStatement('events',' id='.$_GET['id']);
if($service['state']==1){
    $ctrl->updateStatement('events','state',0,$_GET['id']);
}
else{
    $ctrl->updateStatement('events','state',1,$_GET['id']);
}
     header('Location: /events/');
     exit();
?>