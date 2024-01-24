<?php
session_start();
$path = getcwd();
$path = str_replace("agenda", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();
$events=$ctrl->selectStatement("agenda_item",1);
foreach ($events as &$event) {
    $event['title']=$event['titel'];
    $event['url']='update.php?id='.$event['id'];
}

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    
http_response_code(200);
  

echo json_encode($events);