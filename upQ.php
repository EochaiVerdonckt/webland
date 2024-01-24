<?php session_start();
$path = getcwd();
$path=$path."/";
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();
if($_GET['id'])
{
    if(is_numeric($_GET['id']))
    {
        // make connection
     $dwarf=new Opalus();
     $conn=$dwarf->makeConnection();
     
  
     //SUBMIT
      $sql = "UPDATE `vragen` SET `posi`=`posi`+1 WHERE id=".$_GET['id'];


    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "Je hebt de vraag omhoog gestemt";
        $last = $conn->insert_id;


    } 
    $conn->close();

    
    }
   
}


//REDIRECT
header("Location: vragen.php");
die();
?>

