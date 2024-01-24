<?php session_start();
require('functies.php');
    $gegevens = array();
    $servername = "webland.be.mysql";
    $username = "webland_be_webland";
    $password = "Luckies7Databank";
    $dbname = "webland_be_webland";
    $mysqli = new mysqli( $servername, $username, $password, $dbname );
    //
    $stmt = $mysqli->prepare("SELECT `date`, `length`, `mass`, `age`, `result` FROM `studentid_bmi` where id=?");
    $stmt->bind_param("i", $_SESSION ["user"]);
    $stmt ->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
      array_push($gegevens,$row);
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMI CALCULATOR - Tabel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
     <?php print_nav(); ?>
<img src="logo.png" alt="Free logo maker, voor de opdracht :)" />
<div class='container'>
    <div class='row'>
        
         
           <?php
            if(!empty($gegevens)){
           ?>
             <h1>Uw calculaties</h1>
           <table>
               <tr>
                   <th>Datum</th>
                   <th>Lengte</th>
                   <th>Massa</th>
                   <th>Leeftijd</th>
                   <th>BMI</th>
               </tr>
               <?php
                    foreach ($gegevens as &$value) {
                       echo '<tr>';
                         echo '<td>';
                         echo $value['date'];   
                         echo '</td>';
                         
                          echo '<td>';
                         echo $value['length'];   
                         echo '</td>';
                         
                          echo '<td>';
                         echo $value['mass'];   
                         echo '</td>';
                         
                          echo '<td>';
                         echo $value['age'];   
                         echo '</td>';
                         
                          echo '<td>';
                         echo $value['result'];   
                         echo '</td>';
                       echo '</tr>';
                    }
               ?>
           </table>
           <?php }  else{
                echo '<h3>U heeft nog geen berekening toe gevoegd. <a href="bmi.php">Voeg toe </a></h3>';
           } ?>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>