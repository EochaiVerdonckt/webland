<?php 
session_start();

$path = getcwd();
define ("FSPATH",$path);
include (FSPATH."Controllers/superController.php");
include (FSPATH."Controllers/indexController.php"); 

$ctrl=new IndexController();

function getcatog($id=1)
{
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT naam FROM `catog` where id=".$id;
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $brand= $row['naam'];
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $brand;
}


function getmerk($id=1)
{
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT naam FROM `merk` where id=".$id;
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $brand= $row['naam'];
        }
    } else {
        echo "opgelet, product zonder merk";
    }
    $conn->close();
    return $brand;
}

echo json_encode(getProds());
 
function getProds(){
    $ctrl=new IndexController();
    $conn=$ctrl->getConnection();
    $filer="";
    
    if(!empty($_GET['cat']))
        {
            if(isset($_GET['cat']))
            {
                if(is_numeric($_GET['cat']))
                {
                    $filter=" and catog=".$_GET['cat'];
                }            
            }
        }
     if(!empty($_GET['merk']))
        {
            if(isset($_GET['merk']))
            {
                if(is_numeric($_GET['merk']))
                {
                    $filter=$filter." and merk=".$_GET['merk'];
                }            
            }
        }
    if(!empty($_GET['sort']))
    {
        if(is_numeric($_GET['sort']))
        {
            if($_GET['sort']==1)
            {
                $filter=$filter." ORDER BY prijs";
            }
            if($_GET['sort']==2)
            {
                $filter=$filter." ORDER BY prijs DESC";
            }
            if($_GET['sort']==3)
            {
                $filter=$filter." ORDER BY naam";
            }
            if($_GET['sort']==4)
            {
                $filter=$filter." ORDER BY naam DESC";
            }
        }
    }
    if(empty($_GET['sort'])){
         $filter=$filter." ORDER BY id DESC";
     }
    
    

    $sql = "SELECT * FROM `product` where publish=1 ".$filter;
    
    if($_POST['zoek']){
        $sql = "SELECT * FROM `product` where publish=1  and naam LIKE  '%".$_POST['zoek']."%'".$filter;
    }
    
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
               $row['brand']=getmerk($row['merk']);
               $row['catog']=getcatog($row['catog']);
               array_push($rij,$row);
        }
    } else {
        
    }
    $conn->close();
    return $rij;
}



?>
