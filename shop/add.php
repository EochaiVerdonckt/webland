<?php
session_start();
if($_POST)
{
        if(empty($_SESSION['basket']["teller"]))
        {
            $_SESSION['basket']["teller"]=1;    
        }
        else
        {
            $_SESSION['basket']["teller"]=$_SESSION['basket']["teller"]+1;
        }
        $teller=$_SESSION['basket']["teller"];
        $_SESSION['basket'][$teller]['amount']=$_POST['amount'];
        $_SESSION['basket'][$teller]['id']=$_POST['id'];
        header("Location: index.php");
        die();
}

?>