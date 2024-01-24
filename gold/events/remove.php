<?php
$path = getcwd();
$path = str_replace("gold/events", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

$conn= $ctrl->getConnection();

$sql = "DELETE FROM `events` WHERE id=".$_GET['product'];

if ($conn->query($sql) === TRUE) {
    $_SESSION['input']= "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: /gold/events/");
die();