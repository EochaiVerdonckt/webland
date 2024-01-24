<?php session_start();
require('functies.php');


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMI CALCULATOR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
      <?php print_nav(); ?>
<img src="logo.png" alt="Free logo maker, voor de opdracht :)" />
    <h1>Welkom</h1>
    <p>Deze tool is ontwikkeld om uw BMI te berekenen en te evalueren.</p>
    <?php if($_SESSION['user']){
        echo '<a  class=" btn btn-success" href="bmi.php">Bereken</a>';
    
    } else{ echo '<a  class=" btn btn-primary" href="login.php">Aanmelden</a>'; }?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>