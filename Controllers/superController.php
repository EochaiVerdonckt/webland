<?php session_start();
include (FSPATH."Model/opalus.php");


class SuperController {


public function count($table){
    $conn=$this->getConnection();
    $rij = array();
    $sql = "SELECT count(*) as aantal FROM ".$table;
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $rij= $row['aantal'];
            }
        } 
    $conn->close();
    return $rij;
}

public function updateStatement($table,$field,$value,$key,$dirty=0){
   if($dirty==0)
   {
       $value=$this->sanitize($value);
   }

    $conn = $this->getConnection();
    $sql = "UPDATE `".$table."` SET `".$field."`='".$value."' WHERE id=".$key;
    if ($conn->query($sql) === TRUE) {
            //$_SESSION['input']= "Opgeslagen in de databank.";
           $_SESSION['input']=$sql; 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
    }
    $conn->close();
}
    

public function insertStatement(){
    
}

public function selectStatement($table,$where=1,$sort="`id`"){
    $conn=$this->getConnection();
    $rij = array();
    $sql = "SELECT * FROM ".$table." where ".$where." ORDER BY ".$sort;
    $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($rij,$row);
            }
        } 
    $conn->close();
    if(count($rij)==1)
    {
        $rij=$rij[0];
    }
    return $rij;
}
    
public function sanitize($params){
    if(is_array($params)){
        for ($i = 0; $i < count($params); $i++) {
            $params["i"]=str_replace("'","&#39;",$params["i"]);
            $params["i"]=str_replace('"',"&#34;",$params["i"]);
            $params["i"] = filter_var($params["i"], FILTER_SANITIZE_STRING);
        }
    }
    else{
        $params=str_replace("'","&#39;",$params);
        $params=str_replace('"',"&#34;",$params);
        $params= filter_var($params, FILTER_SANITIZE_STRING);
    }
    return $params;
}  

public function getConnection(){
     $dwarf=new Opalus();
     $conn=$dwarf->makeConnection();
     return $conn;
}

public function print_map(){
    echo '
    <section style="background: black;border-top:2px solid black; margin-top: 8px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2521.2621884793916!2d4.9351272157443935!3d50.80778077952625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c16c69429155a9%3A0x60231b144df80a2e!2sIntermezzo!5e0!3m2!1snl!2sbe!4v1572046152959!5m2!1snl!2sbe" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe> 
    </section>
    ';
}

public function getLogo(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM Gegevens where id=18";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['waarde'];
            }

        } 
        $conn->close();
        return '/logo/'.$item;
}

public function getAboutImg(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT foto FROM missie where id=1";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['foto'];
            }

        } 
        $conn->close();
        return '/about/'.$item;
}

public function getColor(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM color where id=1";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['waarde'];
            }

        } 
        $conn->close();
        return $item;
}

public function getTekstColor(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM color where id=2";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['waarde'];
            }

        } 
        $conn->close();
        return 'color: '.$item;

}

public function getColorChat(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT promo FROM promo_balance where id=4";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['promo'];
            }

        } 
        $conn->close();
        return $item;
}
       
public function getBgChat(){
        $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT promo FROM promo_balance where id=5";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['promo'];
            }

        } 
        $conn->close();
        return $item;
}

function getFbPage(){
    $dwarf=new Opalus();
        $conn=$dwarf->makeConnection();
        $rij = array();

        $sql = "SELECT * FROM Gegevens where id=15";
        $item='';
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $item = $row['waarde'];
            }

        } 
        $conn->close();
        return $item;
}
       
public function print_chat(){
	    echo '

	    <div style=" position:fixed;right:5px; bottom: 0;z-index:999999;">
<div onclick="showChat()" id="chatbox" class="btn-info btn" style="border-color: '.$this->getBgChat().'; background-color: '.$this->getBgChat().';">  <p style="color:'.$this->getColorChat().';"><i class="fa fa-commenting-o fa-2x"></i><span style="padding-left:8px;">Chat</span></p></div>
</div>
<div  id="chatBox" style="float:right;display:none; position:fixed;right:1%; bottom: 0;    z-index: 999999;">
	<div class"btn btn-block btn-info" style="border-color: black; background-color:black;color:white;"><a href="https://webland.be/facebook-chat.php"><i class="fa fa-info" style="color:white;padding-left:2%;" ></i></a><i class="fa fa-times" style="    padding-left: 90%;" onclick="hideChat()"></i></div>
<div class="fb-page" data-href="'.$this->getFbPage().'" data-tabs="messages" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
</div>
<script>
    function showChat() {
        document.getElementById("chatBox").style.display="initial" ;
    }
    function hideChat() {
        document.getElementById("chatBox").style.display="none" ;
    }
</script>
';
}
function getBlogs(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM news where publish=1";
    $result = mysqli_query($conn, $sql);
    $rij=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($rij,$row);
          }
    } else {
        
    }
    mysqli_close($conn);
    return $rij;
}
function getServicesPublished(){
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $sql = "SELECT * FROM services where `publish`=1 ORDER BY id";
    $result = mysqli_query($conn, $sql);
    $rij=array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
          array_push($rij,$row);
          }
    } else {
        
    }
    mysqli_close($conn);
    return $rij;
}
function getCatogs(){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $result = mysqli_query($conn, $sql);
    $rij=array();
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


public function print_nav_rabbit(){
    $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    $services= $this->getServicesPublished();
    
    
    echo '
     <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">Webland</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="/" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="/missie.php" class="nav-link">Missie</a></li>
	          <li class="nav-item"><a href="/fotopagina/" class="nav-link">Fotopagina</a></li>
	          <li class="nav-item"><a href="/newReview.php" class="nav-link">Geef je mening</a></li>
	          <li class="nav-item"><a href="/vragen.php" class="nav-link">Q&A</a></li>
	          <li class="nav-item"><a href="/blog.php" class="nav-link">Blog</a></li>
	          <li><div class="dropdown" id="toolBox" style="margin-top:8px;">
  <button style="background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs" style="color:black;"></i><span style="color:black;"> TOOLS</span>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
  echo '</div>
</div></li>';

echo '
	          <li class="nav-item"><a href="/portaal/" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    
    ';
}

public function print_nav_capricorn(){
    $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    $services= $this->getServicesPublished();
    echo '
          <nav class="navbar navbar-expand-lg navbar-light text-capitalize" style="background: black; background-color: black;">
            <div class="container">
              
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#show-menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="show-menu">
                  <ul class="navbar-nav ml-auto">
                     <li class="nav-item active">
                        <a class="nav-link2" href="/">Home</a>
                     </li>
                    
                       <li class="nav-item"><a class="nav-link2" href="/missie.php" >MISSIE</a></li>
                            <li class="nav-item"><a class="nav-link2"  href=" /fotopagina/">FOTOPAGINA</a></li>
                     ';
                     
                     echo '
                   
                   <li class="nav-item" ><a class="nav-link2"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li class="nav-item" style="padding-left: 0;"><a class="nav-link2"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li class="nav-item" style="padding-left: 0;"><a class="nav-link2" href="/vragen.php" id="contactA">Q&A</a></li>
  <li class="nav-item" style="padding-left: 0;"><a class="nav-link2"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li class="nav-item" style="padding-left: 0;"><a class="nav-link2"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
                  </ul>
               </div>
            </div>
         </nav>
    
    ';

   }
public function print_nav_libra(){
    $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    $services= $this->getServicesPublished();
       echo '     <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="background: white;border-bottom: 1px solid black;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand page-scroll" href="index.php">
                        
                      </a>
                    </div>
                    
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="page-scroll" href="/" >HOME</a></li>
                            <li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                            <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>
                            <li><div class="dropdown" id="toolBox" style="margin-top:8px;">
  <button style="background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs"></i> TOOLS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
  echo '</div>
</div></li>';
  echo '<li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;padding-top: 0px;margin-top:14px;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:black;padding:8px;">'.$value['titel'].'</a></div>';
        }
        echo '<div><a class="dropdown-item" href="/blog.php"style="color:black;padding:8px;">Alle artikels</a></div>';
        echo  '</div></li>';
       
echo  '<li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div>
                  </div><!-- /.container -->
                </nav>';
   }
public function print_nav(){
    $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    $services= $this->getServicesPublished();
       echo '     <nav id="main-navbar" class="navbar navbar-default navbar-fixed-top" role="navigation" style="background: white;border-bottom: 1px solid black;"> <!-- Classes: navbar-default, navbar-inverse, navbar-fixed-top, navbar-fixed-bottom, navbar-transparent. Note: If you use non-transparent navbar, set "height: 98px;" to #header -->

                  <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" onclick="toggleClick();">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand page-scroll" href="index.php">
                        
                      </a>
                    </div>
                    
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a class="page-scroll" href="/" >HOME</a></li>
                            <li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                            <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>
                            <li><div class="dropdown" id="toolBox" style="margin-top: -8px;">
  <button style="background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs"></i> TOOLS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
  echo '</div>
</div></li>';
  echo '<li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:black;padding-top: 0px;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:black;padding:8px;">'.$value['titel'].'</a></div>';
        }
        echo '<div><a class="dropdown-item" href="/blog.php"style="color:black;padding:8px;">Alle artikels</a></div>';
        echo  '</div></li>';
       
echo  '<li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
                        </ul>
                    </div>
                  </div><!-- /.container -->
                </nav>';
   }
public function print_nav_pieces(){
      $services= $this->getServicesPublished();
        $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    echo '
<div id="header" class="header-section">
		<!-- sticky-bar Starts-->
		<div class="sticky-bar-wrap">
			<div class="sticky-section">
				<div id="topbar-hold" class="nav-hold container">
					<nav class="navbar" role="navigation">
						<div class="navbar-header" style="    width: 50%;">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-responsive-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
							</button>
							<!--=== Site Name ===-->
							
						</div>
						
						<!-- Main Navigation menu Starts -->
						<div class="collapse navbar-collapse navbar-responsive-collapse">
							<ul class="nav navbar-nav navbar-right">
								<li><a href="/">HOME</a></li>
								<li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                                <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>';
						
						echo       '<li><div class="dropdown" id="toolBox" >
  <button style="margin-top: 8px;background: transparent;color:white;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs"></i> TOOLS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="    background: black;">';
    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid white;"> <a style="color:white !important;" class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
  echo '</div>
</div></li>';
  echo '<li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    margin-top: 14px;color:white;padding-top: 0px;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:white;padding:8px;">'.$value['titel'].'</a></div>';
        }
        echo '<div><a class="dropdown-item" href="/blog.php"style="color:black;padding:8px;">Alle artikels</a></div>';
        echo  '</div></li>';
        
        echo '
        <li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="#section-contact" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
        ';
						echo '
							</ul>
						</div>
						<!-- Main Navigation menu ends-->
					</nav>
				</div>
			</div>
		</div>
		<!-- sticky-bar Ends-->
		<!--=== Header section Ends ===-->
		
		<!--=== Home Section Starts ===-->
		';
}	
public function print_nav_aquarius(){
    $services= $this->getServicesPublished();
        $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    echo '<nav class="navbar navbar-fixed-top" role="banner" style="background-color: white">
            <div class="container" style="width:100%;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav"> 
                     <li><a href="/">Home</a></li>
                       <li><a class="page-scroll" href="/missie.php" >MISSIE</a></li>
                            <li><a class="page-scroll"  href=" /fotopagina/">FOTOPAGINA</a></li>';
                      echo       '<li><div class="dropdown" id="toolBox" >
  <button style="background: transparent;" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-cogs"></i> TOOLS
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
    foreach ($cats as &$cat) {
                           echo '<div style="padding-left:5px;border-bottom:1px solid black;"> <a style="color:white !important;" class="dropdown-item" href="/shop/index.php?cat='.$cat['id'].'"> '.$cat['naam'].' </a></div>';
                        } 
  echo '</div>
</div></li>';
  echo '<li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="    margin-top: 6px;color:black;padding-top: 0px;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="detail.php?id='.$value['id'].'"style="color:white;padding:8px;">'.$value['titel'].'</a></div>';
        }
        echo '<div><a class="dropdown-item" href="/blog.php"style="color:black;padding:8px;">Alle artikels</a></div>';
        echo  '</div></li>';
        
        echo '
        <li><a class="page-scroll"  href="tel:0485865970"><i class="fa fa-phone" style="color: green; margin-right:8px;"></i> BEL</a></li>
 <li style="padding-left: 0;"><a class="page-scroll"  href="/newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/vragen.php" id="contactA">Q&A</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/contact.php" id="contactA">CONTACT</a></li>
  <li style="padding-left: 0;"><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
        ';
               echo 
                    '</ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    
    
    ';
}
public function print_nav_lion(){
  echo '  
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

     <!-- <h1 class="logo mr-auto"><a href="/">Lion</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->';
    $cats = $this->getCatogs();
    $blogs= $this->getBlogs();
    $services= $this->getServicesPublished();
     echo '
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="/"><i class="fa fa-home"></i></a></li>
          <li><a class="page-scroll" href="/lion-missie.php" >MISSIE</a></li>
          <li><a class="page-scroll"  href=" /fotopagina/lion.php">FOTOPAGINA</a></li>
          <li><div class="dropdown show" id="newsBox">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background:transparent;">
    BLOG
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 300px;">';
      
      foreach ($blogs as &$value) {
            echo '<div><a class="dropdown-item" href="lion-detail.php?id='.$value['id'].'"style="color:black;padding:8px;">'.$value['titel'].'</a></div>';
        }
    echo '
        <div><a class="dropdown-item" href="/lion-blog.php"style="color:black;padding:8px;">Alle artikels</a></div>
        </div></li>
           <li style=""><a class="page-scroll"  href="/lion-newReview.php" id="contactA">GEEF JE MENING</a></li>
  <li style=""><a class="page-scroll"  href="/lion-vragen.php" id="contactA">Q&A</a></li>
  <li style=""><a class="page-scroll"  href="/portaal/"><i class="fa fa-lock "></i></a></li>
          <li><a href="#contact">Contact</a></li>
          <li class="book-a-table text-center"><a href="/menu.php">Bestel</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->';
}
public function print_nav_goat(){
    echo '
    <!-- Header
		============================================= -->
		<header id="header">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="/" class="standard-logo" data-dark-logo="/logo.png"><img src="/logo.png" alt="ons Logo"></a>
							<a href="/" class="retina-logo" data-dark-logo="/logo.png"><img src="/logo.png" alt="ons Logo"></a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<!-- Top Search
							============================================= 
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
							</div> #top-search end -->

							<!-- Top Cart
							============================================= -->';
                           if(isset($_SESSION['basket']['teller'])){ 
						echo	'<div id="top-cart" class="header-misc-icon d-none d-sm-block">
								
								<a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">'.$_SESSION['basket']["teller"].'</span></a>
								<div class="top-cart-content">
									<div class="top-cart-title">
										<h4>Shopping Cart</h4>
									</div>
									<div class="top-cart-items">';
							
									$tot=0;
                    $teller= $_SESSION['basket']['teller'];
                    $totBTW=0;
					
                    for ($i = 1; $i <= $teller; $i++) {
                        $order= array();
                        $order =getItem($_SESSION['basket'][$i]['id']);
                        $btw=($order['prijs']*$_SESSION['basket'][$i]['amount'])*0.21;
                        $btw=round($btw,2);
                        $totaal= ($order['prijs']*$_SESSION['basket'][$i]['amount']);
						$tot=$tot+ $totaal;
                        $pics=getPic($order['id']);
						//<img src="images-goat/shop/small/1.jpg" alt="'.$order['naam'].'" />
						echo '
						<div class="top-cart-item">
						<div class="top-cart-item-image">
							<a href="#">
							<div class="shop-item-pic" style="width: 50px; padding-bottom:50px;background:url(\'/producten/uploads/'.$pics[0].'\');float:left;margin-right: 50px;    background-size: cover;margin-left:8px;"></div>';
							 echo '
							</a>
						</div>
						<div class="top-cart-item-desc">
							<div class="top-cart-item-desc-title">
								<a href="#">'.$order['naam'].'</a>
								<span class="top-cart-item-price d-block">&#x20AC;'.$order['prijs']*$_SESSION['basket'][$i]['amount'].'</span>
							</div>
							<div class="top-cart-item-quantity">x '.$_SESSION['basket'][$i]['amount'].'</div>
						</div>
					</div>';
						/*
                        echo '<div class="col-md-12">';
                        echo '<div class="" style="margin: 5px;border-bottom: 1px solid black;padding-bottom:75px;">';
                        echo '        
                     <div class="shop-item-pic" style="background:url(\'/producten/uploads/'.$pics[0].'\');float:left;margin-right: 50px;    background-size: cover;margin-left:8px;"></div>';
                        echo "<h2 style='font-weight: 800;'>".$order['naam']."</h2>";
                        echo "<hr />";
                        echo "<h3 style='color:black;'><b style='font-weight: bolder;'> Aantal: ".$_SESSION['basket'][$i]['amount']."</b></h3>";
                         echo "<h3 style='color:black;'><b style='font-weight: bolder;'> Bedrag: ".$order['prijs']*$_SESSION['basket'][$i]['amount']." EURO</b></h3>";
                        $tot=$tot+$totaal;
                        echo "<a class='btn btn-default' href='remove-item.php?item=".$order['id']."' style='margin-top:8px;'>VERWIJDER</a>";
                        echo '</div></div>';
						*/
                    }
                 
								echo	'</div>
									<div class="top-cart-action">
										<span class="top-checkout-price">&#x20AC;<?php echo $tot ?></span>
										<a href="#" class="button button-3d button-small m-0">View Cart</a>
									</div>
								</div>
							</div><!-- #top-cart end -->';
                           } 
						echo '</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">

							<ul class="menu-container">
								<li class="menu-item current"><a class="menu-link" href="/"><div>Home</div></a>
									<!--
										<ul class="sub-menu-container">
										<li class="menu-item"><a class="menu-link" href="index-corporate.html"><div>Home - Corporate</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-corporate.html"><div>Corporate - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-corporate-2.html"><div>Corporate - Layout 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-corporate-3.html"><div>Corporate - Layout 3</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-corporate-4.html"><div>Corporate - Layout 4</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-portfolio.html"><div>Home - Portfolio</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-portfolio.html"><div>Portfolio - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-portfolio-2.html"><div>Portfolio - Layout 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-portfolio-3.html"><div>Portfolio - Masonry</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-portfolio-4.html"><div>Portfolio - AJAX</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-blog.html"><div>Home - Blog</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-blog.html"><div>Blog - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-blog-2.html"><div>Blog - Layout 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-blog-3.html"><div>Blog - Layout 3</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-shop.html"><div>Home - Shop</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-shop.html"><div>Shop - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-shop-2.html"><div>Shop - Layout 2</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-magazine.html"><div>Home - Magazine</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-magazine.html"><div>Magazine - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-magazine-2.html"><div>Magazine - Layout 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-magazine-3.html"><div>Magazine - Layout 3</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="landing.html"><div>Home - Landing Page</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="landing.html"><div>Landing Page - Layout 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="landing-2.html"><div>Landing Page - Layout 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="landing-3.html"><div>Landing Page - Layout 3</div></a></li>
												<li class="menu-item"><a class="menu-link" href="landing-4.html"><div>Landing Page - Layout 4</div></a></li>
												<li class="menu-item"><a class="menu-link" href="landing-5.html"><div>Landing Page - Layout 5</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-fullscreen-image.html"><div>Home - Full Screen</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-fullscreen-image.html"><div>Full Screen - Image</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-fullscreen-slider.html"><div>Full Screen - Slider</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-fullscreen-video.html"><div>Full Screen - Video</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-onepage.html"><div>Home - One Page</div></a>
											<ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="index-onepage.html"><div>One Page - Default</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-onepage-2.html"><div>One Page - Submenu</div></a></li>
												<li class="menu-item"><a class="menu-link" href="index-onepage-3.html"><div>One Page - Dots Style</div></a></li>
											</ul>
										</li>
										<li class="menu-item"><a class="menu-link" href="index-wedding.html"><div>Home - Wedding</div></a></li>
										<li class="menu-item"><a class="menu-link" href="index-restaurant.html"><div>Home - Restaurant</div></a></li>
										<li class="menu-item"><a class="menu-link" href="index-events.html"><div>Home - Events</div></a></li>
										<li class="menu-item"><a class="menu-link" href="index-parallax.html"><div>Home - Parallax</div></a></li>
										<li class="menu-item"><a class="menu-link" href="index-app-showcase.html"><div>Home - App Showcase</div></a></li>
									</ul> -->
								</li>
								<!-- Mega Menu 
								============================================= -->
								<li class="menu-item mega-menu"><a class="menu-link" href="#"><div>DIGITALE TOOLS</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-lg-3">
													<li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Uw bedrijf in uw broekzak</div></a>
														<ul class="sub-menu-container">';
													
															$catogs=$this->getCatogs();
														    foreach($catogs as $cat){
														        echo '<li class="menu-item"><a class="menu-link" href="https://webland.be/shop/index.php?cat='.$cat['id'].'"><div>'.$cat['naam'].'</div></a></li>';
														    }
															echo '<!-- <li class="menu-item"><a class="menu-link" href="#"><div>Formal Shoes</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Sports shoes</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Flip Flops</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Slippers</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Sports Sandals</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Party Shoes</div></a></li> -->
														</ul>
													</li>
												</ul>
											
											</div>
										</div>
									</div>
								</li><!-- .mega-menu end 
								<li class="menu-item mega-menu mega-menu-small"><a class="menu-link" href="#"><div>Women</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-lg-6">
													<li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Footwear</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Casual Shoes</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Formal Shoes</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Sports shoes</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Flip Flops</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Slippers</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Sports Sandals</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Party Shoes</div></a></li>
														</ul>
													</li>
												</ul>
												<ul class="sub-menu-container mega-menu-column col-lg-6">
													<li class="menu-item mega-menu-title"><a class="menu-link" href="#"><div>Clothing</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Casual Shirts</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>T-Shirts</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Collared Tees</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Pants / Trousers</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Ethnic Wear</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Jeans</div></a></li>
															<li class="menu-item"><a class="menu-link" href="#"><div>Sweamwear</div></a></li>
														</ul>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li><!-- .mega-menu end -->
								<!--
								<li class="menu-item"><a class="menu-link" href="#"><div>Accessories</div><span>Awesome Works</span></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Sale</div><span>Awesome Works</span></a></li>
								<li class="menu-item"><a class="menu-link" href="#"><div>Blog</div><span>Latest News</span></a></li>
	-->			
							
								<li class="menu-item"><a class="menu-link" href="/blog.php"><div>Blog</div><span>Latest News</span></a></li>
								<li class="menu-item"><a class="menu-link" href="/contact.php"><div>Contact</div><span>Get In Touch</span></a></li>
								<li class="menu-item"><a class="menu-link" href="/portaal"><div>Admin</div><span>Log In</span></a></li>
							</ul>

						</nav>
                        
                        
                        
                        <!-- #primary-menu end 

						<form class="top-search-form" action="search.html" method="get">
							<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
						</form> -->

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

    ';

}
}
?>