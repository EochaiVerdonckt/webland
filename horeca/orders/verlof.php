<?php
session_start();
$path = getcwd();
$path = str_replace("orders", "", $path);


define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new AdminController();

    // Create connection
    $conn = $ctrl->getConnection();

    $sql = "UPDATE `order_params` SET `vlag`=1 WHERE id=1";

    if ($conn->query($sql) === TRUE) {
       header("Location: /orders");
        die();
    }
    $conn->close();
