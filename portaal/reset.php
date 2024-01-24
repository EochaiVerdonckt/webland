<?php
session_start();

$path = getcwd();

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
resetLogo($ctrl);
resetGegevens($ctrl);
resetHours($ctrl);
resetServices($ctrl);

header('Location: /portaal/index.php');
exit();

function resetServices($ctrl){
   resetOneService($ctrl,1);
   resetOneService($ctrl,2);
   resetOneService($ctrl,3);
   resetOneService($ctrl,4);
   resetOneService($ctrl,5);
   resetOneService($ctrl,6);
   resetOneService($ctrl,7);
   resetOneService($ctrl,8);
   resetOneService($ctrl,9);
}

function resetOneService($ctrl,$id){
    $table="services";
    $field="naam";
    $ctrl->updateStatement($table,$field,"Kies de naam van uw dienst.",$id);
    $field="omschrijving";
    $ctrl->updateStatement($table,$field,"Beschrijf uw dienst.",$id);
    $field="foto";
    $ctrl->updateStatement($table,$field,"new.png",$id);
    $field="publish";
    $ctrl->updateStatement($table,$field,0,$id);
}

function resetLogo($ctrl){
    $table="Gegevens";
    $field="waarde";
    $ctrl->updateStatement($table,$field,"new.png",18);
}

function resetGegevens($ctrl){
    $table="Gegevens";
    $field="waarde";
    
    $ctrl->updateStatement($table,$field,'Uw bedrijfsnaam',1);
    $ctrl->updateStatement($table,$field,'Omschrijf in het kort uw project',2);
    $ctrl->updateStatement($table,$field,'Geef een unieke titel, slogan van uw project',3);
    $ctrl->updateStatement($table,$field,'Uw nummer',4);
    $ctrl->updateStatement($table,$field,'test@webland.be',5);
    $ctrl->updateStatement($table,$field,'  ',6);
    $ctrl->updateStatement($table,$field,'  ',7);
    $ctrl->updateStatement($table,$field,'  ',8);
    $ctrl->updateStatement($table,$field,'  ',9);
    $ctrl->updateStatement($table,$field,'  ',10);
    $ctrl->updateStatement($table,$field,'GEEN',11);
    $ctrl->updateStatement($table,$field,'GEEN',12);
    $ctrl->updateStatement($table,$field,'Test123',13);
    $ctrl->updateStatement($table,$field,'Test123',14);
    $ctrl->updateStatement($table,$field,'GEEN',15);
    $ctrl->updateStatement($table,$field,'GEEN',16);
    $ctrl->updateStatement($table,$field,'GEEN',17);
}

function resetHours($ctrl){
    $ctrl->updateStatement('hours','waarde','GESLOTEN',1);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',2);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',3);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',4);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',5);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',6);
    $ctrl->updateStatement('hours','waarde','GESLOTEN',7);
}

?>