<?php

$path = getcwd();
$path = str_replace("fotopagina", "", $path);


define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php");
include (FSPATH."Controllers/fotoPaginaController.php"); 
$ctrl=new FotoPaginaController();
$company_data=$ctrl->getCompanyData();

if(!is_numeric($_GET['id']))
{
    echo "NO HAX ALLOWED";
}
?>

<?php

if(!is_numeric($_GET['id']))
{
    echo 'GO AWAY';
    die();
}

function checkArrowLeft(){
    $rij = array();
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT MIN(id)  as antw from artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['antw']);
            $id= trim($row['antw']);
            
        }
    }
    mysqli_close($conn);
    
    
    if($id==$_GET['id'])
    {
        return false; 
    }
    return true;
}

function checkArrowRight(){
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $rij = array();
    $sql = "SELECT MAX(id)  as antw from artikel_balance where state=1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['antw']);
            $id= trim($row['antw']);
            
        }
    }
    mysqli_close($conn);
    
    
    if($id==$_GET['id'])
    {
        return false; 
    }
    return true;
}
    

function getHigher(){
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $rij = array();
    $sql = "SELECT  id  from artikel_balance where state=1 and id>".$_GET['id'].' ORDER BY id';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if(is_null($resultaat))
            {
                $resultaat= $row['id'];
            }
        }
    }
    mysqli_close($conn);
    return $resultaat;
}


function getLower(){
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $rij = array();
    $sql = "SELECT  id  from artikel_balance where state=1 and id<".$_GET['id'].' ORDER BY id DESC';
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if(is_null($resultaat))
            {
                $resultaat= $row['id'];
            }
        }
    }
    mysqli_close($conn);
    return $resultaat;
}

function print_pic()
{
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $rij = array();
    $sql = "SELECT * FROM artikel_balance where state=1 and album=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            echo '	<div>';
            echo '<img src="/picV2/uploads/'.$row['foto'].'"  style="width:100%;"/>';
              echo '<div class="text-center"><h3>'.$row['info'].'</h3></div> ';
            echo '</div>';
          

        }
    }
    mysqli_close($conn);
}

function print_navi(){
    $ctrl=new FotoPaginaController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM artikel_balance where state=1 and album=".$_GET['id'];
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            echo '	<div>';
            echo '<img src="/picV2/uploads/'.$row['foto'].'"  style="width:100%;"/>';
            echo '</div> ';
        }
    }
    mysqli_close($conn);
}


?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="/slick/slick/slick/slick-theme.css"/>
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.css">
<!-- s-->
  <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .slider {
        width: 50%;
        margin: 100px auto;
    }

    .slick-slide {
      margin: 0px 20px;
    }

    .slick-slide img {
      width: 100%;
    }

    .slick-prev:before,
    .slick-next:before {
      color: black;
    }


    .slick-slide {
      transition: all ease-in-out .3s;
      opacity: .2;
    }
    
    .slick-active {
      opacity: .5;
    }

    .slick-current {
      opacity: 1;
    }
    .dropdown-toggle{
    padding-top: 15px !important;
    }
  </style>
</head>
<body>
  <?php $ctrl->print_nav();?>
  <div id="page">
     
	<div class="row">
		<div class="column small-11 small-centered">
			<div class="slider slider-single">
			    <?php print_pic(); ?>
			</div>
			<div class="slider slider-nav">
			    <?php print_navi(); ?>
			</div>
		</div>
	</div>
</div>



  <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="/bootstrap-assets/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $("#toolBox").css({'margin-top':'0px'});
$('.slider-single').slick({
 	slidesToShow: 1,
 	slidesToScroll: 1,
 	arrows: true,
 	fade: false,
 	adaptiveHeight: true,
 	infinite: false,
	useTransform: true,
 	speed: 400,
 	cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
 });

 $('.slider-nav')
 	.on('init', function(event, slick) {
 		$('.slider-nav .slick-slide.slick-current').addClass('is-active');
 	})
 	.slick({
 		slidesToShow: 7,
 		slidesToScroll: 7,
 		dots: false,
 		focusOnSelect: false,
 		infinite: false,
 		responsive: [{
 			breakpoint: 1024,
 			settings: {
 				slidesToShow: 5,
 				slidesToScroll: 5,
 			}
 		}, {
 			breakpoint: 640,
 			settings: {
 				slidesToShow: 4,
 				slidesToScroll: 4,
			}
 		}, {
 			breakpoint: 420,
 			settings: {
 				slidesToShow: 3,
 				slidesToScroll: 3,
		}
 		}]
 	});

 $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
 	$('.slider-nav').slick('slickGoTo', currentSlide);
 	var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
 	$('.slider-nav .slick-slide.is-active').removeClass('is-active');
 	$(currrentNavSlideElem).addClass('is-active');
 });

 $('.slider-nav').on('click', '.slick-slide', function(event) {
 	event.preventDefault();
 	var goToSingleSlide = $(this).data('slick-index');

 	$('.slider-single').slick('slickGoTo', goToSingleSlide);
 });
</script>

</body>
</html>



