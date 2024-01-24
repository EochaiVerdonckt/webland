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

<?php if ($_POST) {
    $btw = $_POST['bedrag']*0.21;

    ?>
    <div class="container-fluid ruimte-top">
        <!--HEADER-->
        <div class="row">
            <h1 class="text-center">FACTUUR</h1>
        </div>

        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
                <img src="logo.png" alt="Mobile Express logo" id="logo"/>
            </div>
        </div>
        <!--FIRST SLIDE-->
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1">
                <p class="kleintje">MOBILE EXPRESS</p>
                <p class="kleintje">Diestsesteenweg 93</p>
                <p class="kleintje">3010 Kessel-Lo</p>
                <p class="kleintje">BE 0633.586.875</p>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 ">
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 ">
                <p class="kleintje"><?php echo $_POST['schuldenaar']; ?></p>
                <p class="kleintje"><?php echo $_POST['adres1']; ?></p>
                <p class="kleintje"><?php echo $_POST['adres2']; ?></p>
                <p class="kleintje"><?php echo $_POST['btw']; ?></p>
            </div>
        </div>

        <div class="row" style="border: solid black 1px; margin-top:4%;">
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1">
                <p>Plaats: Kessel-Lo</p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1">
                <p>Factuurdatum: <?php echo date("d/m/Y"); ?></p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1">
                <p>Vervaldatum: <?php echo date('d/m/Y', strtotime($Date . ' + 14 days')); ?></p>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-1 col-md-offset-1">
                <p>Factuurnummer:  <?php echo $_POST['nummer']?></p>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-4 col-md-4  col-lg-offset-4 col-md-offset-4">
                <table class="factuurTable">
                    <thead>
                    <th><h2>Omschrijving</h2></th>
                    <th class="factuurTableRechts"><h2>Bedrag</h2></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h4><?php echo $_POST['omschrijving'];?></h4></td>
                        <td class="factuurTableRechts"><h4><?php echo $_POST['bedrag'];?>€</h4></td>
                    </tr>
                    <tr>
                        <td><h4>Totaal exclusief btw: </h4></td>
                        <td class="factuurTableRechts"><h4><?php echo $_POST['bedrag'];?>€</h4></td>
                    </tr>
                    <tr>
                        <td><h4>BTW (21%):</h4></td>
                        <td class="factuurTableRechts"><h4><?php  echo number_format((float)$btw, 2, '.', '');?>€</h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row" style="border: solid black 1px; margin-top:4%;">
            <div class="col-lg-10 col-md-10 col-sm-10 col-lg-offset-1 col-md-offset-1">
                <h1 style="float: left; width:75%;">Totaal te betalen: </h1>
                <h1><?php echo  number_format((float)$_POST['bedrag']*1.21, 2, '.', ''); ?>€</h1>
            </div>
        </div>

        <div class="row text-center" style="margin-top:4%;">
            <p>Betaling binnen de 14 dagen op ons rekenningnumer BE 75 7360 1671 1851 t.a.v. ALDUR HEJA met vermelding
                van nummer: <?php echo $_POST['nummer']?></p>
        </div>


    </div>
<?php } else { ?>

    <div class="container-fluid ruimte-top">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-lg-offset-2 col-md-offset-2">
                <form method="post">
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
                    </div>
                    <label>Omschrijving</label>
                    <input type="text" name="omschrijving" placeholder="omschrijving" class="form-control"/>
                    <label>Bedrag</label>
                    <input type="text" name="bedrag" placeholder="bedrag" class="form-control"/>
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
    </div>
<?php } ?>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.  130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->