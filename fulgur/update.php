<?php session_start();
$path = getcwd();
$path = str_replace("fulgur", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

if(!is_numeric($_GET['id'])){
    echo "NO HAX ALLOWED";
    die();
}

$conn=$ctrl->getConnection();
$sql = "UPDATE `promo_balance` SET `promo`='".$_GET['id']."' WHERE id=8";
    if ($conn->query($sql) === TRUE) {
        $last = $conn->insert_id;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
    
header("Location: index.php");
die();    