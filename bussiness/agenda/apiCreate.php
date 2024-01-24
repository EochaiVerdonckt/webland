<?php
session_start();
$path = getcwd();
$path = str_replace("agenda", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
$ctrl=new AdminController();

$conn=$ctrl->getConnection();
    $sql="INSERT INTO `agenda_item`(`start`, `end`, `titel`, `omschrijving`) VALUES ('".$_POST['start']."','".$_POST['end']."','".$_POST['titel']."','Verlof')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } 
    
    $conn->close();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
    
http_response_code(200);
echo json_encode("ok");