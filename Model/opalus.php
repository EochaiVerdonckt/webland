<?php
class Opalus { 
    
    /*
    * Get the connection object.
    */
   function makeConnection(){
        $hostname ="webland.be.mysql";
        $usernameDb = "webland_be_webland";
        $passwordDb = "Luckies7Databank";
        $dbname = "webland_be_webland";
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;

   }
   
}

?>