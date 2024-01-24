<?php
session_start();

$path = getcwd();
$path = str_replace("bussiness/agenda", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Uw agenda";



function showOptions($ctrl,$title){
    echo "<div class='row'>";
       
         $ctrl->side_nav();   
      
        
        echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <hr /> 
                <div>

                <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="pd-20 bg-white box-shadow mb-30">
					<div class="row calendar-wrap">
						<div class="col-xl-2 col-lg-3 col-md-12 col-sm-12">
							<div id="external-events">
							    <a href="create.php" class="btn btn-info" style="color: white;">Maak een event.</a>
                                <h4>Drag drop Verlof</h4>
                                <div class="fc-event ui-draggable ui-draggable-handle" id="1uur">1 uur </div>
                                <div class="fc-event ui-draggable ui-draggable-handle" id="2uur">2 uur</div>
                                <div class="fc-event ui-draggable ui-draggable-handle" id="4uur">4 uur </div>
                                <div class="fc-event ui-draggable ui-draggable-handle" id="allDay">1 dag</div>
							</div>
						</div>
						<div class="col-xl-10 col-lg-9 col-md-12 col-sm-12">
							<div id="calendar"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

                </div>
                
                </div>';
        echo '</div>';
    
    echo "</div>";
}



?>




<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />
    <?php $ctrl->printStyles(); ?>
    	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="/BAP/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-119386393-1');
	</script>
	<link rel="stylesheet" type="text/css" href="/BAP/src/plugins/fullcalendar/fullcalendar.css">
	<style>
	    .main-container {
            padding: 0px !important; 
   
        }
	</style>
</head>
<body style="background: white;">
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/portaal/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 

    <div class="row" style="padding-bottom: 1%; background-color: white;">

    </div>
<?php
    if($_SESSION['user']=="ok")
    {
    showOptions($ctrl,$title);
    }
?>



    <div class="row" style="border-top: 1px solid black;    margin-right: 0; margin-left: 0;">
        <div class="text-center ruimte-top">
            <p>Copyright © Webland, design by <a href="http://mobile-express.be">Webland</a> All rights reserved</p>
        </div>
    </div>
    <div class="row ruimte-bottom" style="   margin-right: 0; margin-left: 0;">
        <div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-2 col-md-offset-2 col-sm-offset-2">
            <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/3.0/"><img
                    alt="Creative Commons License" style="border-width:0"
                    src="https://i.creativecommons.org/l/by-nc-nd/3.0/88x31.png"/></a><a rel="license"
                                                                                         href="http://creativecommons.org/licenses/by-nc-nd/3.0/"></a>
        </div>
    </div>
</div>
    <!-- JS SCRIPTS -->
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script src="/BAP/vendors/scripts/script.js"></script>
	<script src="/BAP/src/plugins/fullcalendar/lib/jquery-ui.min.js"></script>
	<script src="/BAP/src/plugins/fullcalendar/fullcalendar.min.js"></script>
	   <script>
        $("#businessList").hide();
        $("#mySiteList").hide();
        $("#horecaList").hide();
        $("#webshopList").hide();
        $("#futureList").hide();
        $("#whrList").hide();
        //
        $("#futurePanel").click(function() {
            $("#futureList").toggle();
        });
        $("#businessPanel").click(function() {
            $("#businessList").toggle();
        });
         $("#mySitePanel").click(function() {
             $("#mySiteList").toggle();
        });
        $("#horecaPanel").click(function() {
             $("#horecaList").toggle();
        });
         $("#webshopPanel").click(function() {
             $("#webshopList").toggle();
        });
         $("#whrPanel").click(function() {
             $("#whrList").toggle();
        });
    </script>
	<script>
		$(document).ready(function() {
		    function postEvent(){
		        let event=$('#calendar').fullCalendar('clientEvents').pop();
		        if(event.start==null){
		            location.reload();
		        }
		        
		        if(event.end==null){
		            location.reload();
		        }
		        
		        
		        $.post( "apiCreate.php", { start: event.start.toISOString(), end: event.end.toISOString(), titel: event.title }, function( data ) {
                    
                });
                
		    }
		    
		    
		    $.get( "api.php", function( data ) {
               $('#calendar').fullCalendar({
				themeSystem: 'bootstrap4',
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: true,
				droppable: true,
				drop: function() {
					postEvent();
				},
				events: data
			});
            });
			
		});
	</script>
    <script>
       
        
        $('#1uur').data('event', {
        title: 'Pauze 1uur', // use the element's text as the event title
        stick: true, // maintain when user navigates (see docs on the renderEvent method)
        duration: "1:00"
      });
        
      $('#2uur').data('event', {
        title: 'Pauze 2uur', // use the element's text as the event title
        stick: true, // maintain when user navigates (see docs on the renderEvent method)
        
      });
      
      $('#4uur').data('event', {
        title: 'Pauze 4uur', // use the element's text as the event title
        stick: true, // maintain when user navigates (see docs on the renderEvent method)
        duration: "4:00"
      });
      
    $('#allDay').data('event', {
        title: 'Verlofdag', // use the element's text as the event title
        stick: true, // maintain when user navigates (see docs on the renderEvent method)
        duration: "8:00"
      });
      
 
    $('#external-events .fc-event').each(function() {
      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0, //  original position after the drag
      });
    });
 
    </script>

</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. SHIVAN GE SUCKT. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->