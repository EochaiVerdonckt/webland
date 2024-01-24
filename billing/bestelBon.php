<?php

function print_aantal()
{
    echo '
            <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2">
             <form method="post">
                <label>Aantal posten</label>
                <input type="number" name="aantal">
                <button class="btn btn-success">Volgende</button>
            </form>
            
            
                    </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- mobile_fac_1 -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-3598185186227907"
                 data-ad-slot="4628217470"
                 data-ad-format="auto"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
    
    ';
}

function generate_line($aantal)
{
    $out = "";

    for ($x = 1; $x <= $aantal; $x++) {
        $out.= '
    
              <label>Omschrijving</label> 
              <input type="text" name="omschrijving'.$x.'" placeholder="omschrijving" class="form-control"/> 
              <label>Bedrag</label>
              <input type="text" name="bedrag'.$x.'" placeholder="bedrag" class="form-control"/>
    
    ';
    }


    echo $out;
}

function print_makebill($aantal)
{
    echo '
            <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2">
          <form method="post"> 
                <input type="hidden" name="aantal2" value="'.$aantal.'"/>
              <label>Naam klant</label> 
              <input type="text" name="schuldenaar" placeholder="naam klant" class="form-control"/> 
              <label>Straatnaam en nummer</label> 
              <input type="text" name="adres1" placeholder="straatnaam en nummer" class="form-control"/> 
              <label>Postcode en gemeente</label> 
              <input type="text" name="adres2" placeholder="postcode en gemeente" class="form-control"/>
              <label>Btw nummer</label> 
              <input type="text" name="btw" placeholder="btw-nummer" class="form-control"/> 
              <div>
                     <span>Btw nummer kan je leeg laten voor particulieren.</span> 
              </div> ';

    generate_line($aantal);

    echo '
              <label>Factuur nummer</label> 
              <input type="text" name="nummer" placeholder="factuur nummer" class="form-control"/>  
              <div>                  
                     <input type="submit" class="btn btn-primary form-control"/> 
              </div>                 
           </form> 
           
                   </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2">
            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <!-- mobile_fac_1 -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-3598185186227907"
                 data-ad-slot="4628217470"
                 data-ad-format="auto"></ins>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
        </div>
    </div>
           
           ';
}


function printBill()
{

    echo '
    
    
           <div class="row">
            <h1 class="text-center">FACTUUR</h1>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <img src="/logo.png" alt="Mobile Express logo" id="logo"/>
            </div>
        </div>

        <table width="100%;" style="margin-left: 1%;">
            <tr>
                <td>Latrant</td>
                <td style="width: 60%;"></td>
                <td>'.$_POST['schuldenaar'].'</td>
            </tr>
            <tr>
                <td>Diestsesteenweg 93</td>
                <td style="width: 60%;"></td>
                <td>'.$_POST['adres1'].'</td>
            </tr>
            <tr>
                <td>3010 Kessel-Lo</td>
                <td style="width: 60%;"></td>
                <td>'.$_POST['adres2'].'</td>
            </tr>
            <tr>
                <td>BE 0633.586.875</td>
                <td style="width: 60%;"></td>
                <td>'.$_POST['btw'].'</td>
            </tr>
        </table>
       

        <table style="padding: 5px; border: solid black 1px; margin-top:4%; width: 100%;">
            <tr>
                <th><p style="margin-left: 1%; padding-left: 2%; margin-bottom: 0px;">Plaats: Kessel-Lo</p></th>
                <th>Factuurdatum: '.date("d/m/Y").'</th>
                <th>Vervaldatum: '.date('d/m/Y',strtotime($Date . ' + 14 days')).'</th>
                <th>Factuurnummer: '.$_POST['nummer'].'</th>
            </tr>
         </table>
         
         
                  <div class="row">
            <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">
                <table class="factuurTable">
                    <thead>
                    <th><h2>Omschrijving</h2></th>
                    <th class="factuurTableRechts"><h2>Bedrag</h2></th>
                    </thead>
                    <tbody>
         
         ';

    $tot=0;
    for ($x = 1; $x <= $_POST['aantal2']; $x++) {
        $tot=$tot+$_POST['bedrag'.$x];
        echo '
        
        
         <tr>
                        <td><h4>'.$_POST['omschrijving'.$x].'</h4></td>
                        <td class="factuurTableRechts"><h4>'.$_POST['bedrag'.$x].'€</h4></td>
                    </tr>
        ';
    }
    $btw=$tot*0.21;

    echo '
    
        <tr>
                        <td><h4>Totaal exclusief btw: </h4></td>
                        <td class="factuurTableRechts"><h4>'.$tot.'€</h4></td>
                    </tr>
                    <tr>
                        <td><h4>BTW (21%):</h4></td>
                        <td class="factuurTableRechts"><h4>'.number_format((float)$btw, 2, '.', '').'€</h4></td>
                    </tr>
    
    ';

    echo '
    
                            </tbody>
                </table>
            </div>
        </div>
            
    ';


    echo '
    
        <div class="row" style="border: solid black 1px; margin-top:4%;">
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1">
                <h1 style="width:100%;">Totaal te betalen: <span style="float: right;">'.number_format((float)$tot*1.21, 2, '.', '').'€</span></h1>
            </div>
        </div>
    
    ';

    echo   '<div class="row text-center" style="margin-top:4%;">
            <p>Betaling binnen de 14 dagen op ons rekenningnumer BE 75 7360 1671 1851 t.a.v. ALDUR HEJA met vermelding
                van nummer: '.$_POST['nummer'].'</p>
        </div>
    
    ';
}

/*






 * */
?>


<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Mobile Express</title>
    <!-- JS SCRIPTS -->
    <script src="/jquery.min.js"></script>
    <script src="/bootstrap.min.js"></script>
    <script src="/owl.carousel.min.js"></script>
    <script src="/behaviour.js"></script>
    <!-- CSS STYLES -->
    <link rel="stylesheet" type="text/css" href="/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/owl.carousel.css">
    <link href="/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta name="description" content="Hier kan je je smartphone of tablet laten herstellen, supersnel en goedkoop"/>
</head>
<body>

<div class="container-fluid ruimte-top">
    <?php
    if($_POST)
    {
        if($_POST['aantal'])
        {
            print_makebill($_POST['aantal']);
        }
        else
        {
            printBill();
        }
    }
    else{
        print_aantal();
    }

    ?>



</div>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.  130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->