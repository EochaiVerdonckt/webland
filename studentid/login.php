<?php session_start();
require('functies.php');
if($_POST){
    $servername = "webland.be.mysql";
    $username = "webland_be_webland";
    $password = "Luckies7Databank";
    $dbname = "webland_be_webland";
    $mysqli = new mysqli( $servername, $username, $password, $dbname );
    $stmt = $mysqli->prepare("SELECT `username`, `password`,`id` FROM `studentid_user` WHERE username=?");
    $username=filter_var ($_POST['username'], FILTER_SANITIZE_STRING); 
    $stmt -> bind_param('i',$username);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($username, $password,$id);
    $stmt -> fetch();
    if($password==hash('ripemd160',$_POST['password'])){
             $_SESSION['user']=$id;
             header('Location: index.php');
             die();
    } else{
          $_SESSION['form_respons']= "Foutief gebruiker of wachtwoord.";
    }
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
        <label>Username</label>
        <input type="text" class="form-control" name="username"/>
        <label>Wachtwoord</label>
        <input type="password" class="form-control" name="password"/>
        <?php if($_SESSION['form_respons']){
            echo '<p>'.$_SESSION['form_respons'].'</p>';
            $_SESSION['form_respons']=null;
        } ?>
        <input type="submit" class="form-control  btn btn-dark" />
        <a href="register.php">Registreer</a>
    </form>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>