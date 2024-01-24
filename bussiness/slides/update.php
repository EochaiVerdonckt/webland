<?php
session_start();
$path = getcwd();
$path = str_replace("slides", "", $path);
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Edit pagina";

if(!is_numeric($_GET['id'])){
    echo "NOT ALLOWED";
    die();
}


if($_POST)
{
    $table='slides';
    $field="titel";
    $key= $_POST['id'];
    $value=$_POST['titel'];
    $value=str_replace("'","	&#39;",$value);
    $ctrl->updateStatement($table,$field,$value,$key,1);
    
    $field="TitelVlag";
    $value=0;
    if($_POST['titelVlag'])
    {
        $value=1;
    }
    $ctrl->updateStatement($table,$field,$value,$key,1);
    
    $field="Conclusie";
    $value=$_POST['conclusie'];
    $value=str_replace("'","	&#39;",$value);
    $ctrl->updateStatement($table,$field,$value,$key,1);
    
    $field="ConclusieVlag";
    $value=0;
    if($_POST['conclusieVlag'])
    {
        $value=1;
    }
    UpdateAllWp($ctrl);
    updateWpFlagAll($ctrl);

}

function updateWpFlagAll($ctrl)
{
    updateWpFlag($ctrl,1);
    updateWpFlag($ctrl,2);
    updateWpFlag($ctrl,3);
    updateWpFlag($ctrl,4);
    updateWpFlag($ctrl,5);
    updateWpFlag($ctrl,6);
    updateWpFlag($ctrl,7);
    updateWpFlag($ctrl,8);
    updateWpFlag($ctrl,9);
}

function updateWpFlag($ctrl,$number){
    $field="wp-".$number."-flag";
    $value=0;
    $special='wp-'.$number.'-toon';
    if($_POST[$special])
    {
        $value=1;
    }
    $ctrl->updateStatement('slides',$field,$value,$_POST['id'],1);
}

function UpdateAllWp($ctrl){
    updateWp($ctrl,1);
    updateWp($ctrl,2);
    updateWp($ctrl,3);
    updateWp($ctrl,4);
    updateWp($ctrl,5);
    updateWp($ctrl,6);
    updateWp($ctrl,7);
    updateWp($ctrl,8);
    updateWp($ctrl,9);
}

function updateWp($ctrl,$number){
    $field="wp-".$number;
    $value=$_POST[$field];
    $ctrl->updateStatement('slides',$field,$value,$_POST['id'],1);
}


function getChecked($item){
    $resp=" ";
    if($item)
    {
        $resp="checked"; 
    }
    return $resp;
}

function showOptions($ctrl,$title){
    $item=$ctrl->selectStatement('slides',"id=".$_GET['id']);
    echo "<div class='row'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style=''>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                <h1>'.$title.'</h1>
                <hr /> 
                <form method="post">';
                 echo '<input type="hidden" name="id" value="'.$item['id'].'"/>';
                echo '<div style="text-align:left;"><label>Pas hier de titel aan</label></div>';
                echo  '<input type="text" name="titel" value="'.$item['titel'].'" class="form-control"/>';
                echo  '<div style="text-align: left;">
                <div>
                <input type="checkbox" id="titelVlag" name="titelVlag" value="1" '.getChecked($item['TitelVlag']).'>
                <span>Toon de titel</span>
                </div> ';
                echo '
                
                <div>
                <label>Pas de conclusie aan</label>
                <input type="text" class="form-control" name="conclusie" value="'.$item['Conclusie'].'">
                <input type="checkbox" name="conclusieVlag" value="1" '.getChecked($item['conclusieVlag']).'>Toon conslusie
                
                <div>
                <label>Pas waypoint 1 aan:</label>
                <input type="text" class="form-control" name="wp-1" value="'.$item['wp-1'].'">
                <input type="checkbox" name="wp-1-toon" value="1" '.getChecked($item['wp-1-flag']).'>Toon waypoint
                </div>
                
                <div>
                 <label>Pas waypoint 2 aan:</label>
                 <input type="text" class="form-control" name="wp-2" value="'.$item['wp-2'].'">
                 <input type="checkbox" name="wp-2-toon" value="1" '.getChecked($item['wp-2-flag']).'> Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 3 aan:</label>
                <input type="text" class="form-control" name="wp-3" value="'.$item['wp-3'].'">
                <input type="checkbox" name="wp-3-toon" value="1" '.getChecked($item['wp-3-flag']).'> Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 4 aan:</label>
                <input type="text" class="form-control" name="wp-4" value="'.$item['wp-4'].'">
                <input type="checkbox" name="wp-4-toon" value="1" '.getChecked($item['wp-4-flag']).'> Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 5 aan:</label>
                <input type="text" class="form-control" name="wp-5" value="'.$item['wp-5'].'">
                <input type="checkbox" name="wp-5-toon" value="1" '.getChecked($item['wp-5-flag']).'>Toon waypoint
                </div>
                <div>
                <label>Pas waypoint 6 aan:</label>
                <input type="text" class="form-control" name="wp-6" value="'.$item['wp-6'].'">
                <input type="checkbox" name="wp-6-toon" value="1" '.getChecked($item['wp-6-flag']).'>Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 7 aan:</label>
                <input type="text" class="form-control" name="wp-7" value="'.$item['wp-7'].'">
                <input type="checkbox" name="wp-7-toon" value="1" '.getChecked($item['wp-7-flag']).'>Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 8 aan:</label>
                <input type="text" class="form-control" name="wp-8" value="'.$item['wp-8'].'">
                <input type="checkbox" name="wp-8-toon" value="1" '.getChecked($item['wp-8-flag']).'>Toon waypoint
                </div>
                
                <div>
                <label>Pas waypoint 9 aan:</label>
                <input type="text" class="form-control" name="wp-9" value="'.$item['wp-9'].'">
                <input type="checkbox" name="wp-9-toon" value="1" '.getChecked($item['wp-9-flag']).'> Toon waypoint 
                </div>
            </div>';
               
    echo '<input type="submit" class="btn btn-dark" style="margin-top:8px;" />';
    echo '</form>';
    echo '</div>';
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
    <!-- Bootstrap css -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Icons Font -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/font5/css/fontawesome.min.css">
    <link href="/font5/css/brands.css" rel="stylesheet">
    <link href="/font5/css/solid.css" rel="stylesheet">
     
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    </div>
</div>
    <!-- JS SCRIPTS -->
    
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/ckeditor5/document/ckeditor.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
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
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->