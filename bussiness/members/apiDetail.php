<?php
session_start();

$path = getcwd();
$path = str_replace("members", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();
$client=$ctrl->selectStatement("members","id=".$_GET['id']);
$client['title']=$client['info'];
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
echo json_encode($client);