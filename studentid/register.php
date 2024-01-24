<?php session_start();
require('functies.php');


if($_POST){
  
    
    $servername = "webland.be.mysql";
    $username = "webland_be_webland";
    $password = "Luckies7Databank";
    $dbname = "webland_be_webland";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // prepare sql and bind parameters
        if (false === ( $stmt = $conn->prepare("INSERT INTO `studentid_user`( `firstname`, `lastname`, `username`, `gender`, `password`) VALUES (:firstname,:lastname,:username,:gender,:password)"))) {
           echo 'error preparing statement: ' . $conn->error;
         
        }
        
        $firstname=filter_var ($_POST['firstname'], FILTER_SANITIZE_STRING); 
        $lastname=filter_var ($_POST['lastname'], FILTER_SANITIZE_STRING); 
        $username=filter_var ($_POST['username'], FILTER_SANITIZE_STRING); 
        $gender=filter_var ($_POST['geslacht'], FILTER_SANITIZE_STRING); 
        $password=hash('ripemd160',$_POST['password']); 
        
        
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $_SESSION['form_respons']= "Uw account is aangemaakt";
    
    } catch(PDOException $e) {
        $_SESSION['form_respons']=  $e->getMessage();
     
    }
        $conn = null;
}


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMI CALCULATOR - Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
     <?php print_nav(); ?>
<img src="logo.png" alt="Free logo maker, voor de opdracht :)" />
<div class='container'>
    <div class='row'>
            <form method="POST">
                <label>Firstname</label>
                <input type="text" class="form-control" name="firstname"  required="true"/>
                <label>Lastname</label>
                <input type="text" class="form-control" name="lastname" required="true"/>
                <label>Username</label>
                <input type="text" class="form-control" name="username" required="true"/>
                <label>Geslacht</label>
                <select id="geslacht" name="geslacht" class="form-control">
                    <option value="M">Man</option>
                    <option value="V">Vrouw</option>
                </select>    
              
                <label>Wachtwoord</label>
                <input type="password" class="form-control" name="password" required="true"/>
                  <?php
                 if(isset($_SESSION['form_respons'])){
                      echo '<p>'.$_SESSION['form_respons'].'</p>';
                     $_SESSION['form_respons']=null;
                 }
                ?>
                <input style="margin-top:8px;" type="submit" class="form-control  btn btn-dark" />
              
                <a href="login.php">Aanmelden</a>
    </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>