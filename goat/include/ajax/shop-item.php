<?php session_start();

$path = getcwd();

$path = str_replace("include/ajax","" , $path);

define ("FSPATH",$path);
require (FSPATH."Controllers/superController.php");
require (FSPATH."Controllers/slidesController.php"); 
require (FSPATH."Controllers/indexController.php"); 
$ctrl=new SlidesController();
$slide1=$ctrl->getSlide(1);
$slide2=$ctrl->getSlide(2);
$slide3=$ctrl->getSlide(3);

$ctrl=new IndexController();
$seo=$ctrl->getSeo();


function getProducts(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and publish=1 and removed=0 and star=1";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($rij, $row);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

function getReviews($ctrl){
    return $ctrl->selectStatement('reviews',1);
}
function printStars($rating){
    $output = "";
    if($rating==5){
      
        $output=$output. '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        
    }
     if($rating==4){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==3){
    
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==2){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==1){
        
        $output=$output.  '<i class="fa fa-star" style="color: yellow;"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    if($rating==0){
        
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        $output=$output.  '<i class="fa fa-star"></i>';
        
    }
    return $output;
}
function getCatogs(){
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `catog`";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    $extra1="";
    $extra="";
    if($_GET['sort'])
        {
            $extra1="&sort=".$_GET['sort'];
        }
    if($_GET['merk'])
    {
        $extra="&merk=".$_GET['merk'];
    }    
    $extra1=$extra1.$extra;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
              
            $blauw="";  
            if($row['id']==$_GET['cat'])
            {
                $blauw= "blauw";
            }
            echo '
            <li class="menu-item"><a class="menu-link" href="/shop/index.php?cat='.$row['id'].$extra1.'"><div>'.$row['naam'].'</div></a></li>
            
            ';
            
            
        }
    } else {
       
    }
    $conn->close();
    return $rij;
}
function getProds(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$_GET['id'];
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}
function getItem($id){
     $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `product` where aantal>0 and id=".$id;
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               $rij=$row;
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}
function getPic($id){
    $ctrl=new IndexController();
    $conn= $ctrl->getConnection();
    $sql = "SELECT * FROM `product_afbeelding` where item=".$id." ORDER BY created DESC";
    $picture=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            array_push($picture,$row['foto']);
        }
    }
    $conn->close();

    return $picture;
}

function getBlogs(){
    $ctrl=new IndexController();
    $conn = $ctrl->getConnection();
    $sql = "SELECT * FROM `news` where publish=1 ";
    $rij=array();
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
               array_push($rij,$row);
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    return $rij;
}

$item = getItem($_GET['id']);
$pics = getPic($_GET['id']);
?>           
           
           
           <div class="single-product shop-quick-view-ajax">

                    <div class="ajax-modal-title">
                        <h2><?php echo $item['naam']?></h2>
                    </div>

                    <div class="product modal-padding">

                        <div class="row gutter-40 col-mb-50">
                            <div class="col-md-6">
                                <div class="product-image">
                                    <div class="fslider" data-pagi="false">
                                        <div class="flexslider">
                                            <div class="slider-wrap">
                                                <?php 
                                                echo '<div class="slide"><a href="/producten/uploads/'.$pics[0].'" title="'.$item['naam'].'"><img src="/producten/uploads/'.$pics[0].'" alt="'.$item['naam'].'"></a></div>';
                                                if($pics[1]){
                                                    echo '<div class="slide"><a href="/producten/uploads/'.$pics[1].'" title="'.$item['naam'].'"><img src="/producten/uploads/'.$pics[1].'" alt="'.$item['naam'].'"></a></div>';
                                                }    if($pics[2]){
                                                    echo '<div class="slide"><a href="/producten/uploads/'.$pics[2].'" title="'.$item['naam'].'"><img src="/producten/uploads/'.$pics[2].'" alt="'.$item['naam'].'"></a></div>';
                                                }
                                                if($pics[3]){
                                                    echo '<div class="slide"><a href="/producten/uploads/'.$pics[3].'" title="'.$item['naam'].'"><img src="/producten/uploads/'.$pics[3].'" alt="'.$item['naam'].'"></a></div>';
                                                }

                                                ?>
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        if($item['promo_prijs']){
                                                echo ' <div class="sale-flash badge bg-danger p-2">Sale!</div>';
                                        }
                                    ?>
                                   
                                </div>
                            </div>
                            <div class="col-md-6 product-desc">
                                <?php    if($item['promo_prijs']){
                                                echo '<div class="product-price"><del>&#8364;'.$item['prijs'].'</del> <ins>&#8364;'.$item['promo_prijs'].'</ins></div>';
                                        }  else{
                                            echo '<div class="product-price"><del>  </del> <ins>&#8364;'.$item['prijs'].'</ins></div>';
                                        } ?>
                                <!--
                                <div class="product-rating">
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star3"></i>
                                    <i class="icon-star-half-full"></i>
                                    <i class="icon-star-empty"></i>
                                </div>
                                    -->
                                <div class="clear"></div>
                                <div class="line"></div>

                                <!-- Product Single - Quantity & Cart Button
                                ============================================= -->
                                <form class="cart mb-0" method="post" enctype='multipart/form-data'>
                                    <div class="quantity">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" step="1" min="1" max="<?php echo $item['aantal'] ?>"  name="quantity" value="1" title="Qty" class="qty" size="4" />
                                        <input type="button" value="+" class="plus">
                                    </div>
                                    <button type="submit" class="add-to-cart button m-0">Add to cart</button>
                                </form><!-- Product Single - Quantity & Cart Button End -->

                                <div class="clear"></div>
                                <div class="line"></div>
                                <?php echo $item['omschrijving'];  ?>
                                <!--
                                <ul class="iconlist">
                                    <li><i class="icon-caret-right"></i> Dynamic Color Options</li>
                                    <li><i class="icon-caret-right"></i> Lots of Size Options</li>
                                    <li><i class="icon-caret-right"></i> 30-Day Return Policy</li>
                                </ul>
                                    -->
                                <div class="card product-meta mb-0">
                                    <div class="card-body">
                                        <span itemprop="productID" class="sku_wrapper">SKU: <span class="sku"> <?php echo $item['id'];  ?></span></span>
                                        <span class="posted_in">Categorie: <a href="#" rel="tag"> <?php echo $item['catog'];  ?></a>.</span>
                                        <!--<span class="tagged_as">Tags: <a href="#" rel="tag">Barena</a>, <a href="#" rel="tag">Blazers</a>, <a href="#" rel="tag">Tailoring</a>, <a href="#" rel="tag">Unconstructed</a>.</span>-->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>