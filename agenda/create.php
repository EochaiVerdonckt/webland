<?php
session_start();

$path = getcwd();
$path = str_replace("agenda", "", $path);

define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/adminController.php"); 


$ctrl=new AdminController();
$ctrl->verify();
$title= "Uw online agenda";

if($_GET['klant']){
    if(!is_numeric($_GET['klant'])){
        echo "NO HAX ALLOWED";
        die();
    }
}

if($_POST)
{
    $conn=$ctrl->getConnection();
    $sql="INSERT INTO `agenda_item`(`start`, `end`, `titel`, `omschrijving`) VALUES ('".$_POST['start']."','".$_POST['end']."','".$_POST['titel']."','".$_POST['info']."')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
    } 
    
    $conn->close();
    if($_POST['client'])
    {
       
        $_POST['client'] = explode(' ', $_POST['client']);
        $_POST['client'] = array_pop($_POST['client']);
        $client=getClient($ctrl,$_POST['client']);
        $client=$client['id'];
        $ctrl->updateStatement('agenda_item','klant',$client,$last_id);
        
    }
    if($_POST['client-url'])
    {
        $client=$_POST['client-url'];
        $ctrl->updateStatement('agenda_item','klant',$client,$last_id);
    }
    if($_POST['member2']){
        $member=getMember($ctrl,$_POST['member2']);
        $member=$member['id'];
        $ctrl->updateStatement('agenda_item','member',$member,$last_id);
        
    }
    if($_POST['member-url']){
        $member = $_POST['member-url'];
        $ctrl->updateStatement('agenda_item','member',$member,$last_id);
    }
    if($_POST['depart2']){
    
        $depart=getDepart($ctrl,$_POST['depart2']);
        $depart=$depart['id'];
        $ctrl->updateStatement('agenda_item','departement',$depart,$last_id);
        
    }
    if($_POST['depart-url']){
        $member = $_POST['depart-url'];
        $ctrl->updateStatement('agenda_item','departement',$member,$last_id);
    }
    if($_POST['functie2']){
    
        $depart=getFunctie($ctrl,$_POST['functie2']);
        $depart=$depart['id'];
        $ctrl->updateStatement('agenda_item','functie',$depart,$last_id);
        
    }
    
    if($_POST['functie-url']){
        $member = $_POST['functie-url'];
        $ctrl->updateStatement('agenda_item','functie',$member,$last_id);
    }
    header('Location: index.php');
    exit();
}

function getClient($ctrl,$email)
{
    $client=$ctrl->selectStatement("clients","email='".$email."'");
    return $client;
}

function getMember($ctrl,$info)
{
    $client=$ctrl->selectStatement("members","info='".$info."'");
    return $client;
}


function getDepart($ctrl,$info)
{
    $client=$ctrl->selectStatement("departments","naam='".$info."'");
    return $client;
}


function getFunctie($ctrl,$info)
{
    $client=$ctrl->selectStatement("functies","naam='".$info."'");
    return $client;
}


function showOptions($ctrl,$title){
    echo "<div class='row'>";
         $ctrl->side_nav();   
        echo "<div class='col-md-9' style=''>";
                echo '<div class="well text-center" style="width: 100%;margin-top:50px; padding:20px;">
                
                <h1>'.$title.'</h1>
                <hr /> 
        <div class="row">';
      echo '<form method="post" style="width:100%">';
      echo '<div style="text-align:left;"><label>Start</label></div>';
      echo '<input id="start" type="text" class="form-control" name="start"/>';
      echo '<div style="text-align:left;"><label>Einde</label></div>';
      echo '<input id="end" type="text" class="form-control" name="end"/>';
      echo '<div style="text-align:left;"><label>Titel</label></div>';
      echo '<input type="text" class="form-control" name="titel"/>';
     
      
      if(!$_GET['member']){
        echo '<div style="text-align:left;"><label>Member (mag leeg zijn)</label></div>';
        echo '<input type="hidden" class="form-control" name="member" id="member-hidden"/>
        <div class="autocomplete" >
        <input type="text" class="form-control"  id="membersInput" name="member2"/>
        </div>
        ';  
      }
      else{
           echo ' <input type="hidden" class="form-control" name="member-url" value="'.$_GET['member'].'" id="client-url"/>';
      }

      if(!$_GET['klant']){
        echo '<div style="text-align:left;"><label>Klant (mag leeg zijn)</label></div>';
      echo '
      <input type="hidden" class="form-control" name="client" id="client-hidden"/>
        <div class="autocomplete" >
        <input type="text" class="form-control"  id="clientsInput"/>
        </div>
        ';    
      }
      else{
          echo ' <input type="hidden" class="form-control" name="client-url" value="'.$_GET['klant'].'" id="client-url"/>';
      }
      
       if(!$_GET['depart']){
      
        echo '<div style="text-align:left;"><label>Departement (mag leeg zijn)</label></div>';
        echo '<input type="hidden" class="form-control" name="depart" id="depart-hidden"/>
        <div class="autocomplete" >
        <input type="text" class="form-control"  id="departInput" name="depart2"/>
        </div>
        ';  
       }
       else{
            echo ' <input type="hidden" class="form-control" name="depart-url" value="'.$_GET['depart'].'" id="depart-url"/>';
       }
       
       if(!$_GET['functie']){     
        echo '<div style="text-align:left;"><label>Functie (mag leeg zijn)</label></div>';
        echo '<input type="hidden" class="form-control" name="functie" id="functie-hidden"/>
        <div class="autocomplete" >
        <input type="text" class="form-control"  id="functieInput" name="functie2"/>
        </div>
        '; 
         } else{
            echo ' <input type="hidden" class="form-control" name="functie-url" value="'.$_GET['functie'].'" id="functie-url"/>';
       }
       
        
      echo '<div style="text-align:left;"><label>Omschrijving</label></div>';
      echo '<div id="toolbar-container"></div>
    <div id="editor">
      
    </div>
    <textarea name="info" id="backUp" style="display:none;"></textarea>';
    echo '<input type="submit" class="form-control" style="margin-top: 2%;"/>
            </form>';
                
        echo '</div></div>';
    
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
    <link rel="stylesheet" type="text/css" href="jquery.datetimepicker.min.css" >
    <style>
    #clientsInputautocomplete-list{
        text-align: left;
    }
    #membersInputautocomplete-list{
        text-align: left;
    }
    #departInputautocomplete-list{
        text-align: left;
    }
    
     #functieInputautocomplete-list{
        text-align: left;
    }
            
    </style>
</head>
<body>
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
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="/ckeditor5/document/ckeditor.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bootstrap-assets/js/bootstrap.min.js"></script>
    <script src="jquery.datetimepicker.full.min.js"></script>
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
         $('#start').datetimepicker();
        $('#end').datetimepicker();
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
    <script>
    function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
   
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        
        console.log(arr);
     
        if (arr[i]['title'].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i]['title'].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i]['title'].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i]['title'] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
               document.getElementById("client-hidden").value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}
$.get( "/klanten/api.php", function( data ) {
  autocomplete(document.getElementById("clientsInput"), data);
});



$.get( "/members/api.php", function( data ) {
  autocomplete(document.getElementById("membersInput"), data);
});

$.get( "/departments/api.php", function( data ) {
  autocomplete(document.getElementById("departInput"), data);
});

$.get( "/functies/api.php", function( data ) {
  autocomplete(document.getElementById("functieInput"), data);
});


</script>
</body>
</html>
<!-- GELIEVE ZELF JE CODE TE SCHRIJVEN. 130EURO PER GEKOPIEERDE FUNCTIE VOOR VRAGEN CONTACTEER SABAM-->
<!-- (SOFTWARE VALT ONDER DE AUTEURSWETGEVING.)-->