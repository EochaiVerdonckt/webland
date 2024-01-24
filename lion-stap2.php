<?php session_start();

$path = getcwd();
$path = $path.'/';


define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 
include (FSPATH."Controllers/indexController.php"); 
$ctrl=new IndexController();
$seo=$ctrl->getSeo();
$ctrl=new AdminController();



$dates=getNoDates();
$dis="";
foreach ($dates as &$value) {
       $pieces=explode("-",$value);
       $datum=$pieces[2]."/".$pieces[1]."/".$pieces[0];
       if(empty($dis))
       {
           $dis=$datum;
       }
       else
       {
           $dis=$dis.",".$datum;
       }
}
$dis="[".$dis."]";
function getNoDates()
{
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $rij = array();

    
    $aantal=0;
    $sql = "SELECT datum, sum(aantal) FROM `reservaties` WHERE datum>curdate() and aantal>".$aantal." GrOUP BY datum";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row['datum']);
        }
    } else {
    }
    $conn->close();
    return $rij;
}

function getReservatie($id)
{
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();

    $sql = "SELECT * FROM `reservaties` where id=".$id;
  
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $rij=$row;
        }

    } else {
        echo "Reservatie niet gevonden.";
    }

    $conn->close();

    return $rij;
}


if($_POST)
{
    $_POST["vnaam"]= clean( $_POST["vnaam"]);   
    $_POST["naam"]= clean( $_POST["naam"]);   
    $_POST["tel"]= clean( $_POST["tel"]);   
    $_POST["extra"]= clean( $_POST["extra"]);   
    $_POST["aantal"]= clean( $_POST["aantal"]);  
    $_POST["email"]= clean( $_POST["email"]); 
    $conn=$ctrl->getConnection();
    $sql = "INSERT INTO `reservaties`( `vnaam`, `naam`, `email`, `tel`, `extra`, `aantal`,`tijd`) VALUES ('".$_POST["vnaam"]."','".$_POST["naam"]."','".$_POST["email"]."','".$_POST["tel"]."','".$_POST["extra"]."','1','".$_POST["time"]."')";
    if ($conn->query($sql) === TRUE) {
            $_SESSION['quantumSecret'] = $conn->insert_id;
            $_SESSION['challenge'] =$_POST["aantal"];
    } 
    else {
            echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $_SESSION['test']=$_POST['time'];
    $conn->close();
}

function clean($input){
    $input= strip_tags($input);    // -> not a tag < 5
    $input= filter_var ( $input, FILTER_SANITIZE_STRING); 
    return $input;
}


if( $_POST["datum"])
{
    $_POST["datum"]= clean( $_POST["datum"]); 
    $pieces = explode("/", $_POST["datum"]);
    $_POST["datum"]=$pieces[2]."-".$pieces[1]."-".$pieces[0];
    $ctrl=new AdminController();
    $conn= $ctrl->getConnection();
    $sql = "UPDATE `reservaties` SET `datum`='".$_POST["datum"]."' WHERE id=".$_SESSION['quantumSecret'];
    
    if ($conn->query($sql) === TRUE) {
       
    } 
    $conn->close();
    $msg="Beste klant we hebben uw reservatie om ".$_SESSION['tijd']." op ".$_POST["datum"]." ontvangen";
    mail($_SESSION['email'],"Wij hebben uw reservatie ontvangen.",$msg);
    
    
    $res=getReservatie($_SESSION['quantumSecret']);

    // send email
    
   
    
    // use wordwrap() if lines are longer than 70 characters
 $msg="U heeft een reservatie om ".$_SESSION['tijd']." op ".$_POST["datum"]." ontvangen aantal:".$res['aantal']." email: ".$res['email']." tel: ".$res['tel']." naam: ".$res['vnaam']." ".$res['naam'];
   
$to      = 'info@badmengroup.be';
$subject = 'U heeft een reservatie ontvangen';
$headers = 'From:robot@webland.be' . "\r\n" .
    'Reply-To: info@yumyumsushi.be' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $msg, $headers);
    $_SESSION['book'] ="Wij hebben uw reservatie ontvangen.";
    header("Location: index.php#book-a-table");
    die();
}


function toonLijstEten()
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM cat_balance  WHERE `DrankofEten`=1  AND id!=112 ORDER by sort";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij,$row);
        }

    } else {
       
    }
    $conn->close();
    return $rij;
}

function print_basket()
{
    if(empty($_SESSION['basket']))
    {
        return;
    }
    
    echo '
    <div style="width:10%; position: fixed; top:10%;z-index:99; right:2%;">
    <div class="thumbnail" style="background: white; border: 1px solid black; padding: 5px;">
      <span class="badge" style="float:right; background: black;color: white;">'.$_SESSION['basket']["teller"].'</span>
      <i class="fa fa-shopping-basket fa-5x" style="color: "></i>
      <div class="caption">
        <p><a href="checkout.php" class="btn btn-primary" role="button">Checkout</a></p>
      </div>
    </div></div>';

    
}


function getSideButtons()
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = 'SELECT * FROM `slide_opt` WHERE naam="button"';
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}



function getServices()
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT * FROM services";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function print_artikels()
{

    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            echo '<div class="col-lg-4">';
            echo '<div class="thumbnail" style="border: 10px double gray;background:yellow;    padding: 0;"><div style="background: white;">
                    <img src="/news/'.$row['foto'].'" width="100%;" alt="">
                    <div class="caption" style="background: black;padding-top: 2%;margin-top: 2%;">              
                       '.$row['info'].'
                       <p> 
                      ';
            echo '</p></div>
                 </div></div></div>';
        }
    }
    mysqli_close($conn);
}
function getPromo()
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();

    $sql = "SELECT promo FROM promo_balance where id=1";
    $item='';
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $item = $row['promo'];
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}

function getHours()
{
    $ctrl=new AdminController();
    $conn=$ctrl->getConnection();
    
    $sql = "SELECT * FROM hours";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item,$row);
        }

    }
    else
    {
        echo "LOAD HOURS FAILED;";
    }

    $conn->close();
    return $item;
}



$slide_buttons=getSideButtons();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
	  <title><?php echo $seo['0']['waarde']?> | STAP 2 KIES JE DATUM.</title>
  <meta property="og:description" 
  content="<?php echo $seo['1']['waarde']?>" />
  <meta name="description" content="<?php echo $seo['1']['waarde']?>">
  <link href="/lion/assets/img/favicon.png" rel="icon">
  <link href="/lion/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/lion/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="/lion/assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="/lion/assets/vendor/aos/aos.css" rel="stylesheet">
    <!-- mmenu -->
  <link type="text/css" rel="stylesheet" href="vendor/mmenu/css/jquery.mmenu.css" />
 
   <link rel="stylesheet" type="text/css" media="screen" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/font5/css/fontawesome.min.css">

  <!-- Template Main CSS File -->
  <link href="/lion/assets/css/style.css" rel="stylesheet">
 <style>
 
 .form-control{
     border: 1px solid #cda45e;
     background: black;
     color: #cda45e;
 }
         
.blackboard {
			width: 640px;
			max-width:100%;
			margin: 7% auto;
			border: silver solid 12px;
			border-top: silver solid 12px;
			border-left: silver solid 12px;
			border-bottom: silver solid 12px;
			box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
			background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
			background-color: #333;

		}
.krijt{
			vertical-align: middle;
			font-family: 'Permanent Marker', cursive;
			font-size: 1.6em;
			color: rgba(238, 238, 238, 0.7);
			padding: 10px;
			min-height: 250px;
		}
	.btn{
	        background: #cda45e;
    margin-top: 12px;
	}
	#dropdownMenuLink{
	    margin-top:0;
	}
	.dot {
    height: 25px;
    width: 25px;
    background-color: white;
    border: 1px solid #ff7b00;
    border-radius: 50%;
    display: inline-block;
    color: #ff7b00;
    padding-top: 5px;
    text-align: center;
    
}
.dot h4 {
    color: #ff7b00;
}

.strong-item{
    margin-top: 12px;
    margin-right:8px;
}

.white{
    background-color: white !important;
    background: white !important;`
    margin:20px;
}
.sub-sq{
    margin-top:8px;
}
.reviews p{
    color: black !important ;
    font-size:2em;
}
.hide {
      display: none;
    }

    .clear {
      float: none;
      clear: both;
    }

    .rating {
        width: 90px;
        unicode-bidi: bidi-override;
        direction: rtl;
        text-align: center;
        position: relative;
    }

    .rating > label {
        float: right;
        display: inline;
        padding: 0;
        margin: 0;
        position: relative;
        width: 1.1em;
        cursor: pointer;
        color: #fff;
    }

    .rating > label:hover,
    .rating > label:hover ~ label,
    .rating > input.radio-btn:checked ~ label {
        color: transparent;
    }

    .rating > label:hover:before,
    .rating > label:hover ~ label:before,
    .rating > input.radio-btn:checked ~ label:before,
    .rating > input.radio-btn:checked ~ label:before {
        content: "\2605";
        position: absolute;
        left: 0;
        color: #FFD700;
    }
    .checked {
  color: orange;
}


.btn[disabled] {
  opacity: 0.90;
  filter: alpha(opacity=90);
  background-color: #690000;
  color: #777;
}

.disabled-date
{
  background-color: darkred;   
}

.datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
    background: black !important;
    color: #777777;
    cursor: default;
}

 </style>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <a href="tel:<?php echo $seo['3']['waarde'] ?>"><i class="icofont-phone"></i><?php echo $seo['3']['waarde'] ?></a>
       <!-- <span class="d-none d-lg-inline-block"><i class="icofont-clock-time icofont-rotate-180"></i> Mon-Sat: 11:00 AM - 23:00 PM</span>-->
      </div>
      <!--
      <div class="languages">
        <ul>
          <li>En</li>
          <li><a href="#">De</a></li>
        </ul>
      </div>
      -->
    </div>
  </div>
    <?php $ctrl->print_nav_lion();?>
  
       	<div class="row text-center" style="padding-top:125px;">
    	    <div id="banner" class="text-center" style="width:100%;margin-top:12px;">
    	        <h2 style="width: 80%;margin-left:10%;color: white;">Hebt u een allergie, laat het ons dan zeker weten.</h2>
    	    </div>
	    </div>
   
  <main id="main">
          

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

 <div class="col-md-12">
                <form method="post" id="datumForm">
                    <h1 style="color:white; text-align: center;margin-top:5%;">STAP 2</h1>
                    <div style="width: 40%;margin-left:30%;">
                         <input type="text" name="datum" id="rDate" placeholder="Kies je datum" class="form-control" style="color: black; background: white;">
                                             <p style="color: white; text-align: center;margin-top: 5px;margin-bottom:5px;">Datums in het verleden, wanneer we gesloten zijn of al volzet zijn, zijn niet beschikbaar en daarom zwart</p>
                         <input type="submit" style="border-color: white; margin-top:8px;color: white; background: black;" class="btn btn-block"/>
                           <p id="disTxt" style="display:none;"><?php echo $dis;?></p>
                    <p style="color:white;">Disclaimer: Deze gegevens worden 9maanden bewaart in de Webland DB, niet gebruikt voor commerciële doeleinden, noch doorverkocht, en zjn beveiligd met een (andere) geheime sleutel. Voor uw reservatie gebruiken we een cookie. Waarin we enkel een openbare unieke sleutel bewaren. Enkel de gegevens van dit formulier worden opgeslagen. Onze databank is bovendien beschermt tegen aanvallers. Veiligheid, privacy en transparantie draagt Webland hoog in het vaandel.</p>
                    </div>
                  
                </form>
            </div>
 

      </div>
    </section><!-- End About Section -->
    
  </main><!-- End #main -->
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2497.1082196414395!2d4.492848015760644!3d51.253916779594306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3f80c5c14b541%3A0x1e9d18d753bf6c9b!2sWilgendaalstraat%2C%202900%20Schoten!5e0!3m2!1snl!2sbe!4v1606993338245!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>  
    <?php $ctrl->print_chat();?>
  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container">
      <div class="text-center">
        <a href="https://www.facebook.com/webland.belgie" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/webland_belgie/" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>    
      <div class="copyright">
        &copy; Copyright <strong><span><?php echo $seo['0']['waarde']?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Developed by <a href="https://webland.be/">Webland</a>
      </div>
    </div>
  </footer><!-- End Footer -->

    <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="/lion/assets/vendor/jquery/jquery.min.js"></script>
  <script src="/lion/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/lion/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="/lion/assets/vendor/php-email-form/validate.js"></script>
  <script src="/lion/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="/lion/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/lion/assets/vendor/venobox/venobox.min.js"></script>
  <script src="/lion/assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="/lion/assets/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script>
    var showNav=true;
        var elmnt = document.getElementById("main-navbar");
    var height = elmnt.offsetHeight+"px";
    var box= document.getElementById("slides-box");
    box.style.marginTop = height;
    function toggleClick()
    {
        if(showNav)
        {
            showNav=false;
            $("#bs-example-navbar-collapse-1").show();
            $("#nav-brand").hide();
            $("#logoBanner").hide();
        }
        else
        {
             $("#bs-example-navbar-collapse-1").hide();
             $("#nav-brand").show();
             $("#logoBanner").show();
             showNav=true;
        }
       
    }
</script>
<script>
    $(function(){
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    var maxDate = day + '-' + month + '-' + year;
    
    var now = new Date();
    now.setDate(now.getDate() + 30);
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var year = now.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    var now = day + '-' + month + '-' + year;
    var noDate=$("#disTxt").text();
    console.log(noDate);
    $('#rDate').datepicker({
        format: 'dd/mm/yyyy',
        startDate: maxDate,
        endDate: now,
        datesDisabled: noDate,
         daysOfWeekDisabled: "6"
    });
});

$('#rDate').change(function () {
    //$("#datumForm").submit();
});
</script>
 	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>
</body>

</html>