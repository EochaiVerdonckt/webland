<?php
class FotoPaginaController extends SuperController{ 
  
function print_artikels($id)
{
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

  
    $sql = "SELECT * FROM artikel_balance where state=1 and album=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $state =  trim($row['state']);
            $id= trim($row['id']);
            
            
            echo '
            
            					<div class="portfolio all logo" data-cat="logo">
						<div class="portfolio-wrapper">	
						    <div onclick="location.href=\'/fotopagina/detail.php?id='.$row['id'].'\';" style="background-image: url(\'/picV2/uploads/'.$row['foto'].'\'); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; width: 100%; margin: 8px;">
						    
						    </div>
						
							<div class="label">
								<div class="label-text">
									<a class="text-title"> '.$row['info'].'</a>
								</div>
								<div class="label-bg"></div>
							</div>
						</div>
					</div>
            
            
            ';
        }
    }
    mysqli_close($conn);
}

function getCompanyData()
{

    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();
    $sql = "SELECT * FROM `Gegevens`";
    $item=array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($item, $row);
        }

    } 

    $conn->close();
    return $item;
}  



function getPic($id)
{
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();

    $sql = "SELECT * FROM artikel_balance where id=".$id;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            
            $pic= trim($row['foto']);
            
        }
    } else {
        echo "0 results";
    }
    mysqli_close($conn);
    return $pic;
}



function print_albums()
{
    $dwarf=new Opalus();
    $conn=$dwarf->makeConnection();
    $rij = array();

  
    $sql = "SELECT * FROM albums";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {

            $id= trim($row['id']);
            
            
            echo '
            
            					<div class="portfolio all logo respo" data-cat="logo">
						<div class="portfolio-wrapper">	
						    <div onclick="location.href=\'/fotopagina/album_detail.php?id='.$row['id'].'\';" style="background-image: url(\'/picV2/uploads/'.$this->getPic($row['cover']).'\'); /* The image used */
  background-color: #cccccc; /* Used if the image is unavailable */
  height: 500px; /* You must set a specified height */
  background-position: center; /* Center the image */
  background-repeat: no-repeat; /* Do not repeat the image */
  background-size: cover; width: 100%; margin: 8px;">
						    
						    </div>
						
							<div class="label">
								<div class="label-text">
									<a class="text-title"> '.$row['naam'].'</a>
								</div>
								<div class="label-bg"></div>
							</div>
						</div>
					</div>
            
            
            ';
        }
    }
    mysqli_close($conn);
}
 
}

?>