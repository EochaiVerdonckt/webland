<?php
session_start();


$path = getcwd();
$path = str_replace("members", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();
$clients=$ctrl->selectStatement("members",1);
foreach ($clients as &$client) {
    $client['title']=$client['info'];
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
echo json_encode($clients);