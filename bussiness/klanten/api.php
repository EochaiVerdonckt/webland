<?php
session_start();


$path = getcwd();
$path = str_replace("klanten", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();
$clients=$ctrl->selectStatement("clients",1);
foreach ($clients as &$client) {
    $client['title']=$client['voornaam']." ".$client['naam']." ".$client['email'];
}
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
http_response_code(200);
echo json_encode($clients);