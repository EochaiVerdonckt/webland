<?php session_start();
require('functies.php');

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMI CALCULATOR - Calculatie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
     <?php print_nav(); ?>
<img src="logo.png" alt="Free logo maker, voor de opdracht :)" />
<div class='container'>
    <div class='row'>
            <form method="POST" id="form1" action="verstuur.php">
                <label>Lengte (m)</label>
                <input type="decimal" class="form-control" name="lengte"  required="true"/>
                <label>Leeftijd (jr)</label>
                <input type="number" class="form-control" name="leeftijd" required="true"/>
                <label>Gewicht (kg)</label>
                <input type="number" class="form-control" name="gewicht" required="true"/>
                <input style="margin-top:8px;" type="submit" class="form-control  btn btn-dark" />
                <a href="index.php">home</a>
                <?php
               
                ?>
    </form>
    </div>
</div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
     
  </body>
</html>