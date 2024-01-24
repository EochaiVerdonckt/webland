<?php
session_start();

if(is_numeric($_GET['item']))
{
        //COPY BASKET
        $basket=array();
        $teller=0;
        for ($i =0; $i <= $_SESSION['basket']["teller"]; $i++) {
            
            if($_SESSION['basket'][$i]['id']==$_GET['item']){
               
            }
            else{
                $teller=$teller+1;
                array_push($basket,$_SESSION['basket'][$i]);
            }
            
           
        }
        $_SESSION['basket']=$basket;
        $teller=$teller-1;
        $_SESSION['basket']["teller"]=$teller;
     
  
     
}
      header("Location: checkout.php");
        die();
?>