<?php
session_start();

$path = getcwd();
$path = str_replace("gold/vlog", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Voeg een artikel toe";


if(isset($_POST['tekst']))
{
    $conn = $ctrl->getConnection();
     $sql = "INSERT INTO `vlog`(`link`, `title`, `tekst`) VALUES ('".$_POST['link']."','".$_POST['title']."','".$_POST['tekst']."')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['input']= "New record created successfully";
        $last = $conn->insert_id;


    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function print_papier()
{
    echo '<form method="post" style="text-align:left;">';
    echo '<label>Titel</label>';  
    echo '<input type="text" name="title" class="form-control" />';  
        echo '<label>YT Link</label>';  
    echo '<input type="text" name="link" class="form-control" />';  
    echo '<label style="text-aling: left;">Schrijf er op los</label>';
    echo '<div id="toolbar-container"></div>
    <div id="editor">
    </div>
    <textarea name="tekst" id="backUp" style="display:none;"></textarea>';
    echo '<input type="submit" class="form-control" style="margin-top: 2%;"/></form>';

    $_SESSION['input']="";
}



function showOptions($ctrl,$title){
    echo "<div class='row'>";
         $ctrl->side_nav();   
    echo "<div class='col-md-9' style='background:url(future.jpg);min-height: 150vh;background-size:cover;'>";
    echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <h3>Gelieve bij de link het deel na v= te kiezen.</h3>
                <hr /> 
          <div>';
    echo '<div class="row">';      
    print_papier();
    echo '</div>'; 
    echo '</div>';    
    echo '</div>'; 
 
    
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
    <style>
                .snow-flake
        {
            width:100%;
            padding-bottom: 60%;
        }
        .btn-light{
            border: 1px solid black;
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
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN.130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->