<?php session_start();


$path = getcwd();
$path = str_replace("producten", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();

$ds = DIRECTORY_SEPARATOR;  //1
$storeFolder = 'uploads';   //2
if (!empty($_FILES)) {
    $tempFile = $_FILES['file']['tmp_name'];          //3             
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    $conn =$ctrl->getConnection();
    $sql= "INSERT INTO `product_afbeelding`(`foto`, `item`) VALUES ('".$_FILES['file']['name']."',".$_SESSION['item'].")";
    $conn->query($sql);
    $conn->close();
    move_uploaded_file($tempFile,$targetFile); //6
}
 
?>

