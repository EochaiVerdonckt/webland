<?php session_start();
$path = getcwd();
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();

if(isset($_POST['id']) && is_numeric($_POST['id']) && $_SESSION['user'])
{
       //CLEAN Question
     $_POST['answer'] = filter_var($_POST['answer'], FILTER_SANITIZE_STRING);
     // make connection
     $dwarf=new Opalus();
     $conn=$dwarf->makeConnection();
     
  
     //SUBMIT
      $sql = "UPDATE `vragen` SET `antw`='".$_POST['answer']."' WHERE id=".$_POST['id'];


    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "Je hebt het antwoord aangepast";
        $last = $conn->insert_id;


    } 
    $conn->close();
    //REDIRECT
header("Location: vragen.php");
die();
}



        



?>

