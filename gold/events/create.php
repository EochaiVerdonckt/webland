<?php
session_start();

$path = getcwd();
$path = str_replace("gold/events", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Voeg je event toe.";

if(isset($_POST['omschrijving']))
{
    $conn=$ctrl->getConnection();
    $sql = "INSERT INTO `events`( `info`) VALUES ('".$_POST['omschrijving']."')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "Je event is toegevoegd.";
        $last = $conn->insert_id;
        $date=$_POST['date']." 00:00:00";
        $sql = "UPDATE events SET `datum`='".$date."' WHERE id=".$last;
        $conn->query($sql);
        
        $sql = "UPDATE events SET `titel`='".$_POST['titel']."' WHERE id=".$last;
        $conn->query($sql);
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
    
    //$date= $_POST['date'];
    //var_dump($_POST['date']);die();
    //$date= $_POST['date']." 00:00:00";
    $date2 = $_POST['date']." 23:59:00";
    $sql="INSERT INTO `agenda_item`(`start`, `end`, `titel`, `omschrijving`) VALUES ('".$date."','".$date2."','".$_POST['titel']."','".$_POST['omschrijving']."')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } 
   
   

    $conn->close();
}

function getCompanyData($ctrl){
    $rij = array();
    // Create connection
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `Gegevens` order by id";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item, $row);
        }

    } else {
        echo "0 results";
    }

    $conn->close();
    return $item;
}


function showOptions($ctrl,$title){
    $formdata=getCompanyData($ctrl);
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <hr /> 
                <h3>Gelieve alle velden waarheidsgetrouw in te vullen.</h3>
                <div>';
                
     echo '<form method="post">';
      echo '<div style="text-align:left;"><label>Titel</label></div>';
    echo '<div><input type="text" name="titel" class="form-control"/></div>';
    echo '<div style="text-align:left;"><label>Datum</label></div>';
    echo '<div><input type="date" name="date" class="form-control"/></div>';
    echo '      <div style="text-align:left;">
                    <label >Schrijf er op los</label>
                </div>';
      echo '
               
    <div id="toolbar-container"></div>
    <div id="editor">
        
    </div>
    <textarea name="omschrijving" id="backUp" style="display:none;"></textarea>';
    echo    '<input type="submit" class="form-control" style="margin-top: 2%;"/>
                <p>'.$_SESSION['input'].'</p>    
            </form>
         ';
    $_SESSION['input']="";
    echo  '</div></div>';
    echo '</div>';
    echo "</div>";
}



?>




<!DOCTYPE html>
<html>
<head lang="nl">
    <meta charset="UTF-8">
    <title>Webland | Backoffice</title>
    
    <meta name="description" content=">Webland | " />
    <meta name="google-site-verification" content="ExQ89lGiGlXTIDoWcfx5CxMkRu-Wtubn8FYir2BJRU8" />

    <?php $ctrl->printStyles(); ?>
    <style>
        .form-control{
            border: 2px solid black;
        }
    </style>
</head>
<body>
<div class="container-fluid ruimte-top">

    <div id="vliegerContent" style="padding-top: 4%; padding-bottom: 4%; border-bottom: 1px solid black;background: url('/portaal/bg.jpg'); background-size: cover;" class="text-center">
        <h1 style=" text-shadow: 3px 3px #000; color: white; margin-top: 0; margin-left: auto; margin-right: auto; padding-top: 5%; padding-bottom: 5%;"class="text-vertical-center" data-stellar-background-ratio="0.5">Beheerders Pagina</h1>
    </div>
<?php $ctrl->print_supernav(); ?> 
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
    <script src="/ckeditor5/document/ckeditor.js"></script>
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
       
        $("#password2").keyup(function() {
            
            if($("#password2").val()==$("#password").val()){
               $("#passLabel").text("Wachtwoord bevestiging"); 
               $("#password2").css("border-color", "#000");
            }
            else{
               $("#password2").css("border-color", "#991A00");
               $("#passLabel").text("Wachtwoorden zijn niet gelijk");
            }
        });
        
        $("#emailField").keyup(function() {
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if(regex.test( $("#emailField").val())){
               $("#emailLabel").text("Email"); 
               $("#emailField").css("border-color", "#000");
            }
            else{
               $("#emailField").css("border-color", "#991A00");
               $("#emailLabel").text("Geen geldig email");
            }
        });
    </script>
  <script>
        
        DecoupledEditor
            .create( document.querySelector( '#editor' ), {
        ckfinder: {
            // Upload the images to the server using the CKFinder QuickUpload command.
            uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json'
        }
    }  )
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );
                document.querySelector( '#backUp' ).value=editor.getData();
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                    document.querySelector( '#editor' ).addEventListener( 'DOMSubtreeModified', () => {
                        const editorData = editor.getData();
                        document.querySelector( '#backUp' ).value=editorData;
                    }); 
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
                    document.querySelector( '#editor' ).addEventListener( 'keyup', () => {
                        const editorData = editor.getData();
                        document.querySelector( '#backUp' ).value=editorData;
                    });     
                    
                    //
            } )
            .catch( error => {
                console.error( error );
            } );
    
      
    </script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->