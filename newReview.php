<?php session_start();
$path = getcwd();
$path=$path.'/';
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/adminController.php");
include (FSPATH."Controllers/blogController.php");
$ctrl=new indexController();
$blgCtrl=new BlogController();
$adminCtrl = new AdminController();
if($_POST['tekst'])
{
   $conn=$ctrl->getConnection();

  
   $_POST['naam'] = $_POST['name'];  
    $sql="INSERT INTO `reviews`( `info`, `naam`, `rating`) VALUES ('".$_POST['tekst']."','".$_POST['naam']."','".$_POST['star']."')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "Uw review is toegevoed. En kan u na moderatie bekijken.";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="nl">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
     <title>GWM | Geef je mening.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="Uw mening is belangrijk, help ons te verbteren">
    <meta name="keywords" content="">
    <meta name="author" content="Eoghain Verdonckt">

    <!-- Bootstrap Css -->
   
     <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Style -->
    <link href="/plugins/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.theme.css" rel="stylesheet">
    <link href="/plugins/owl-carousel/owl.transitions.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash|Cinzel+Decorative|Megrim" rel="stylesheet">

    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    .contact-wrapper .form-inline .form-control {
    display: inline-block;
    width: 100%;
    border-radius: 0;
    vertical-align: middle;
    margin:8px;
}
    .contact-wrapper {
    position: relative;
    background: url(../img/contact-back-img.jpg) center center / cover no-repeat fixed;
}
    
    .font-1
    {
        font-family: 'Berkshire Swash', cursive;
    }
    
    .font-2
    {
        font-family: 'Cinzel Decorative', cursive;
        padding-bottom: 2%;
    margin-bottom: 0%;
    padding-top: 2%;
    text-align: center;
    color: #B29600;
    }
    
    .font-3
    {
        font-family: 'Megrim', cursive;
    }
    
    a:hover, a:visited, a:link, a:active
    {
          text-decoration: none  !important;
    }
    
    
    .special-input
    {
        border: 2px solid black;
        border-radius: 0;
    }
    
    @media only screen and (max-width: 500px) {
        #artwork,  #artwork3, #bigScreen, #bigScreen2, #bigScreen3, #bigScreen4 {
            display:none;
        }
        .hideSmall
        {
            display:none;
        }
    }
    @media only screen and (min-width: 501px) {
        #artwork2, #smallScreen, #smallScreen2 {
            display:none;
        }
    }
    
    

    .link h1
    {
        margin-bottom: 0; padding: 4%;text-align: center;
    }
    
      .link a
    {
        border:0; color: black; padding: 5px;    text-shadow: 2px 0 black, 0 1px black, 1px 0 black, 0 -1px black;
    }
     
    .nav-link
    {
        text-shadow: none !important;
        
    }
     
     .krijt {
    vertical-align: middle;
    font-family: 'Permanent Marker', cursive;
    font-size: 1.6em;
    color: rgba(238, 238, 238, 0.7);
    padding: 10px;
    min-height: 250px;
}

.blackboard {
    width: 640px;
    max-width: 100%;
    margin: 7% auto;
    border: silver solid 12px;
    border-top: silver solid 12px;
    border-left: silver solid 12px;
    border-bottom: silver solid 12px;
    box-shadow: 0px 0px 6px 5px rgba(58, 18, 13, 0), 0px 0px 0px 2px silver, 0px 0px 0px 4px silver, 3px 4px 8px 5px rgba(0, 0, 0, 0.5);
    background-image: radial-gradient( circle at left 30%, rgba(34, 34, 34, 0.3), rgba(34, 34, 34, 0.3) 80px, rgba(34, 34, 34, 0.5) 100px, rgba(51, 51, 51, 0.5) 160px, rgba(51, 51, 51, 0.5)), linear-gradient( 215deg, transparent, transparent 100px, #222 260px, #222 320px, transparent), radial-gradient( circle at right, #111, rgba(51, 51, 51, 1));
    background-color: #333;
}

.fa-star
{
     color: white;
    text-shadow: -1px 0 #B29600, 0 1px #B29600, 1px 0 #B29600, 0 -1px #B29600;
}

.snow-flake
{
    padding-bottom: 150px;
}

@media only screen and (max-width: 500px) {
  .blackboard {
   width: 640px;
    max-width: 100%;
  }
}


.navbar-default, .navbar-default.navbar-fixed-top.navbar-shrink {
    background-color: white;
}
     .custom-button {
    padding: 8px 20px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 1px;
    color: #929292;
    font-size: 14px;
    font-family: 'Roboto Condensed', sans-serif;
    font-style: italic;
    text-transform: uppercase;
    font-weight: 300;
    letter-spacing: 1.3px;
}

.blog-wrapper .blog-container, .blog-wrapper .blog-date-wrapper {
    padding: 15px;
    border-color: #d7d7d7;
    border-style: solid;
    border-width: 0px 1px 1px 1px;
    padding-bottom: 21px;
}

#el-zwaan
{
    font-family: 'Roboto Slab', serif;
    color: #117CCA;
}

.blauw
{
    background: #117ECD;
    color: white !important;
}
.price-tag{
        position: absolute;
    z-index: 9;
    right:8%;
        top: 5%;
}
.dot {
    height: 100px;
    width: 100px;
    background-color: darkred;
    border-radius: 50%;
    display: inline-block;
    color: white;
    padding-top:30px;
    text-align: center;
    position: absolute;
    z-index: 9;
    right:8%;
        top: 5%;
}



#logo
{
    float: left;width: 25%;margin-right: 5px;
}


@media only screen and (max-width: 1250px) {
#logo
{
    float: left;width: 40%;margin-right: 5px;
}
}

@media only screen and (max-width: 800px) {
#logo
{
    float: left;width: 50%;margin-right: 5px;
}
}

@media only screen and (max-width: 750px) {
#logo
{
    float: left;width: 90%;margin-right: 5px;
}
}

.shop-item-pic
{
    padding-bottom:250px;
    width:250px;

}

@media only screen and (max-width: 1250px) {
.shop-item-pic
{
    padding-bottom: 125px;
    width: 125px;
}

}
@media only screen and (max-width: 925px) {
    .price-tag{
            right: 5%;
    }
}
#catogLijst{
    display:none;
}
@media only screen and (max-width: 750px) {
    .price-tag{
            right: 0%;
            position: initial;
    }
    .price-tag h2{
        padding:0;
    }
    #searchForm{
        width:75%;
    }
    #searchBar{
        width:50%;
        margin-right: 0;
        float: left;
    }
}
@media only screen and (max-width: 830px) {
    #catogKnop{
        display:none;
    }
    #searchForm{
        width: 60%;
    }
    #searchBar{
        width:80%;
        float: left;
    }
    #catogLijst{
        display:block;
    }
}
#main-navbar{
    margin-bottom: 0;
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
        color: #000;
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

    </style>
</head>

<body style="background-color: white;">
    <?php $ctrl->print_nav();?>
     
    


  <!-- GET IN TOUCH -->
  <section id="contact-section" class="contact-wrapper section-padding" style="background:url('/img/review.jpg');background-size:cover;">
      <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center">
            <div style="width:fit-content;margin-left:auto;margin-right:auto;background: rgba(0,0,0,0.5);padding:10px;">
                <h1 style="color:white;text-align: center;font-family: 'Open Sans', sans-serif !important;text-shadow: 2px 2px #000;"><span style="color: e6ff00">Uw</span> mening is belangrijk</h1>
            <h2 style="color:white;text-align: center;font-family: 'Open Sans', sans-serif !important;text-shadow: 2px 2px #000;">Help ons te verbeteren</h2>
            </div>
            
      </div>
    </div><!-- row -->
  </div>
    <div class="container">
      <div class="row">
        <div class="wow zoomIn col-xs-12 col-sm-12 col-md-12 " style=" background: rgba(0,0,0,0.5);padding-top:8px;">
     
           <form action="" method="post" name="rfqfrm" id="rfqfrm"  style="background: rgba(255,255,255,0.6); padding: 4%;">
               
                <label>*Naam:</label>
                <input name="name" type="text" id="name" size="25" class="form-control">
               
                <input name="lastname" type="text" id="lastname" size="25" class="form-control" value="lastName" style="display:none;">
                <label>*Email:</label>
                <input name="email" type="text" id="email" size="30" class="form-control">
         

                <label>Bericht: </label>
                <textarea name="tekst" cols="30" rows="7" id="comments"class="form-control" placeholder="Pen hier je feedback neer"></textarea>
                <label>Star rating</label>
             <div class="rating">
            <input id="star5" name="star" type="radio" value="5" class="radio-btn hide" />
            <label for="star5" >☆</label>
            <input id="star4" name="star" type="radio" value="4" class="radio-btn hide" />
            <label for="star4" >☆</label>
            <input id="star3" name="star" type="radio" value="3" class="radio-btn hide" />
            <label for="star3" >☆</label>
            <input id="star2" name="star" type="radio" value="2" class="radio-btn hide" />
            <label for="star2" >☆</label>
            <input id="star1" name="star" type="radio" value="1" class="radio-btn hide" />
            <label for="star1" >☆</label>
            <div class="clear"></div>
        </div>
                 <input type="submit" name="Submit2" value="Verzenden" class="btn btn-danger btn-block"></td>
                 
                
                 <p style="color: black;">Deze gegevens worden  strik vertrouwlijk behandeld. En worden enkel na moderatie geplaatst op de website</p>
                 <p style="color: black;">
                 <?php
                 if($_SESSION['input'])
                 {
                     echo $_SESSION['input'];
                     $_SESSION['input']=null;
                 }
                 ?>
                 </p>
            </form>
        </div> <!-- /.col-xs-12 .col-sm-offset-2 .col-sm-8 -->
        <div class="col-xs-12">
                
        </div><!-- /.col-xs-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section><!-- get in touch -->
<?php $gegevens=$adminCtrl->getSeo();?>
    <footer>
        <div class="container-fluid">
            <div class="row" style="padding-top:2%; padding-bottom:2%; background-color:white;">
                <h4 style="margin-bottom: 0; padding: 4%; padding-bottom:0;   width: 100%;" class="text-center">IBAN: <?php echo $gegevens[14]['waarde']?> BTW-NUMMER: <?php echo $gegevens[13]['waarde']?></h4>
                <h4 style="margin-bottom: 0; padding: 4%;padding-top:1%;    width: 100%;" class="text-center font-2">  © 2019 Comet Web OS - Libra edition All rights reserved by <a href="http://webland.be">webland</a> <a href="/GDPR.pdf"  style="color: black" class="nav-link"> GDPR</a> <a href="/portaal/"  style="color: black" class="nav-link"> <i class="fa fa-lock "></i></a> </h4>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row" style="background-color: black;">
            </div>
            
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/jquery.stellar.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <!-- JS PLUGINS -->
    <script src="/plugins/owl-carousel/owl.carousel.min.js"></script>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5&appId=138543326488158";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
	</script>

<script>
//
$('#newsBox').css('margin-top','13px');
$('#toolBox').css('margin-top','8px');
$(window).on('scroll', function(){
  if( $(window).scrollTop()>670 ){
    $('.navbar-default').addClass('navbar-fixed-top');
  } else {
    $('.navbar-default').removeClass('navbar-fixed-top');
  }
});

</script>
</body>

</html>