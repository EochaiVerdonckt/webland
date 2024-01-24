<?php
session_start();

function toonlijst()
{
      $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;
    $rij = array();

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM cat_balance";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();

    foreach ($rij as &$value) {
        echo '<h3>'.$value['naam'].'</h3>';


        // Create connection
        $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM price_balance where cat=".$value['id']." ORDER BY bedrag";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo '<table style="width: 100%; padding: 2%;">';
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td style="border-top: 1px solid white; text-align: left; padding-left: 2%;">'.$row['naam'].'</td>';
                echo '<td style="border-top: 1px solid white;">'.$row['bedrag'].' EUR</td>';
                echo '</tr>';

            }
            echo '</table>';

        } else {
            echo "0 results";
        }

        $conn->close();
    }


}



function verify()
{

    if(!$_SESSION['user'])
    {
        if($_POST)
        {
            if($_POST['user']=="l-admin" && $_POST['pass']=="balance2016")
            {
                $_SESSION['user']="ok";
            }
            else
            {
                echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                    <span>Foute login gegevens</span>
                                </form>
        ';
            }

        }
        else
        {
            echo '
        
                                <form method="post" class="text-left" style="margin-top: 2%;">
                                    <label style="margin-top: 2%;">USER</label>
                                    <input type="text"  name="user" class="form-control"/>
                                    <label style="margin-top: 2%;">PASSWORD</label>
                                    <input type="password"  name="pass" class="form-control"/>
                                    <input type="submit"  class="form-control" style="margin-top: 2%;"/>
                                </form>
        ';
        }
    }
}


function print_pics()
{

      $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;


// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM foto_balance ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $state =  trim($row['state']);


            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail">
                    <img src="'.$row['naam'].'" width="100%;" alt="">
                    <div class="caption">
                      ';

            if($state==0)
            {
                echo ' <a href="publish.php?product='.$row['id'].'" class="btn btn-default" role="button">publiceer</a>';
            }
            else
            {
                echo '<a href="hide.php?product='.$id.'" class="btn btn-default" role="button">verberg</a>';
            }


            echo '
                       
                       </p>
                    </div>
                 </div></div>';
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);


    $conn->close();
}



function print_artikels()
{

      $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;


// Create connection
    $conn = mysqli_connect($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM artikel_balance";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail">
                    <img src="'.$row['foto'].'" width="50%;" alt="">
                    <div class="caption">              
                       '.$row['info'].'
                       <p> <a href="foto.php?product='.$id.'" class="btn btn-default" role="button">foto</a>
                       <a href="edit.php?product='.$row['id'].'" class="btn btn-default" role="button">bewerk</a>
                       
                       <a href="remove.php?product='.$id.'" class="btn btn-default" role="button">verwijder</a>
                      ';

            if($state==0)
            {
                echo ' <a href="publish.php?product='.$row['id'].'" class="btn btn-default" role="button">publiceer</a>';
            }
            else
            {
                echo '<a href="hide.php?product='.$id.'" class="btn btn-default" role="button">verberg</a>';
            }


            echo '
                       
                       </p>
                    </div>
                 </div></div>';
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
}


function print_add()
{
    echo '
        <form method="POST">
            <label>Album Naam</label>
            <input type="text" name="album"  class="form-control"/>
            <input type="submit"  class="btn btn-warning"/>
        </form>
    
    
    
    ';
}


function showOptions()
{
    echo '<div class="row text-center">
    <div class="col-lg-8 col-lg-offset-4">
        <h2>Mijn Albums</h2>
    </div></div>';



    echo '<div class="row">';
    echo '<div class="col-lg-2 col-lg-offset-2 text-center ">';
    echo '<div class="thumbnail">';
    echo '<div class="caption">
                    <h1><i class="fa fa-arrow-left" style="color: black;"></i></h1>
                    <h3>GA TERUG</h3>
                     <p> <a href="/picV2/admin.php" class="btn btn-default" role="button">VORIG</a></p>
                </div>';

    echo '</div>';
    echo '</div>';




    echo '</div>';
    //END OF ROW 1

   


    print_add();

    echo "</div>";
    //END ROW 2

   
}


if($_POST)
{
     $xml=simplexml_load_file("../db.xml") or die("Error: Cannot create object");
    $usernameDb = $xml->usernameDb;
    $passwordDb = $xml->passwordDb;
    $hostname = $xml->hostname;
    $dbname = $xml->dbname;

    // Create connection
    $conn = new mysqli($hostname, $usernameDb, $passwordDb, $dbname);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO `albums`( `cover`, `naam`) VALUES (0,'".$_POST['album']."')";


    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland news</title>

    <meta name="description" content="Beautiful Balance Bunsbeek | Massages, schoonheid en persoonlijke verzorging" />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
   
 <!-- Bootstrap Css -->
     <link rel="stylesheet" type="text/css" media="screen" href="/css/bootstrap.css">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="/plugins/Lightbox/dist/css/lightbox.css" rel="stylesheet">
    <link href="/plugins/Icons/et-line-font/style.css" rel="stylesheet">
    <link href="/plugins/animate.css/animate.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="/plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/tegels/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>

    <?php verify();?>

    <div class="row" style="padding-bottom: 1%; background-color: white;">
      
    </div>
    <?php
    if($_SESSION['user']=="ok")
    {
        showOptions();
    }
    ?>
  <?php 
         if($_SESSION['input'])
         {
             echo '<h2>'.$_SESSION['input'].'</h2>';
             $_SESSION['input'] =null;
         }
        
        ?>


    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://webland.be">Webland</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://cogitatio.be" id="support">Met de steun van Cogitatio.be</a>
        </div>
    </div>
</div>

<script>
    $( "#verstuur" ).prop( "disabled", true );
    $("#goed").hide();
    function IsEmail()
    {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(regex.test(document.getElementById('email').value))
        {
            $( "#verstuur" ).prop( "disabled", false );
            $("#goed").show();
            $("#fout").hide();
        }
        else
        {
            $("#goed").hide();
            $("#fout").show();
        }
    }
</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->