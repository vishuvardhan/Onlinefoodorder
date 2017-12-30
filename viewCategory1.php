<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>

<?php
if (isset($_GET['id']) && !empty($_GET['id']) && !isset($_GET['catid'])) {

    $strSQL = "SELECT * FROM category where id='" . $_GET['id'] . "'";
    $rs = mysql_query($strSQL);
    if (mysql_num_rows($rs) == 0) {
        ?>
        <div class="alert alert-info" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> No category Exists with the Selected Item. </strong>
        </div>
    <?php } else {
        while ($row = mysql_fetch_array($rs)) {
            $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                                            $rs1 = mysql_query($strSQL1);
                                            $row1 = mysql_fetch_array($rs1);
            ?>

            <section id="aa-product-details">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-product-details-area">
                                <div class="aa-product-details-content">
                                    <div class="row">
                                        <!-- Modal view slider -->
                                        <div class="col-md-5 col-sm-5 col-xs-12">                              
                                            <a data-lens-image="<?php echo $row['file_location']; ?>" class="simpleLens-lens-image">
                                                <img src="<?php echo $row['file_location']; ?>" class="simpleLens-big-image">
                                            </a>
                                        </div>
                                        <!-- Modal view content -->
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <div class="aa-product-view-content">
                                                <h3><?php echo $row['name']; ?></h3>
                                                <div class="aa-price-block">
                                                    <span class="aa-product-view-price">&#36; <?php echo $row['price_in_dollar']; ?></span>
                                                    <p class="aa-product-avilability">Avilability: <span><?php if($row1['stock'] > 0) { echo $row1['stock']." "; } else{ echo "Out of Stock"; }?> </span></p>
                                                </div>
                                                <p><?php echo $row['description']; ?></p>
                                                <form action="addToCart.php" method="post">
                                                    <div class="aa-prod-quantity">
                                                                <label>Quantity  </label><br>
                                                                <input type="number" name="quantity" id="quantity" min="0" max="<?php echo $row1['stock']; ?>" required="" style="width: 30%;">
                                                                <input type="text" name="catid" id="catid" value="<?php echo $row['id']; ?>" hidden="">                                                              
                                                            </div>
                                                      <div>
                                                    <?php if($row1['stock'] > 0) { ?>
                                                          <a  href="#"><button type="submit" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button></a>   
                                                     <?php } ?>
                                                </div>
                                                </form>
                                                
                                                
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="aa-product-details-bottom" >
                                    <ul class="nav nav-tabs" id="myTab2">
                                        <li><a href="#description" data-toggle="tab" style="font-weight: bolder;margin-top: 50px;">Description</a></li>                                                    
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="description">
                                            <p><?php echo $row['description']; ?></p>                                           
                                            
                                        </div>
                                                   
                                    </div>
                                </div>
                                <!-- Related product -->
                                <div class="aa-product-related-item">
                                    <h3 style="font-weight: bolder;margin-top: 50px;">Related Products</h3>
                                    <ul class="aa-product-catg aa-related-item-slider">
                                        <?php
                                        $strSQL = "SELECT * FROM category where id!='".$_GET['id']."' LIMIT 4";
                                        $rs = mysql_query($strSQL);
                                        while ($row = mysql_fetch_array($rs)) {
                                            $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                                            $rs1 = mysql_query($strSQL1);
                                            $row1 = mysql_fetch_array($rs1);
                                            ?>

                                            <li style="border: 1px solid #ccdc00;">
                                                    <figure style="margin-top:10px;">
                                                        <a class="aa-product-img" href="viewCategory.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['file_location']; ?>" alt="<?php echo $row['file_name']; ?>" style="width: 200px;height: 200px;"></a>
                                                        <?php if ($row1['stock'] > 0) { ?>
                                                            <a class="aa-add-card-btn"href="viewCategory.php?id=<?php echo $row['id']; ?>" style="bottom: 30%;"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                        <?php } ?>
                                                        <figcaption>
                                                            <h4 class="aa-product-title" style="font-size: 16px;"><a href="viewCategory.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h4>
                                                            <span class="aa-product-price" style="color: black;">Price : </span><span class="aa-product-price">&#36; <?php echo $row['price_in_dollar']; ?></span><br>
                                                            <span class="aa-product-price" style="color: black;">Available Stock : </span><span class="aa-product-price"><?php
                                                                if ($row1['stock'] > 0) {
                                                                    echo $row1['stock'] . " ";
                                                                } else {
                                                                    echo "Out of Stock";
                                                                }
                                                                ?> </span>
                                                        </figcaption>
                                                    </figure>                        
                                                                            

                                                </li>
                                        <?php } ?>                                                                                  
                                    </ul>
                                    <!-- quick view modal -->                  
                                    
                                    <!-- / quick view modal -->   
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }
    }
} elseif (isset($_GET['cartid']) && !empty($_GET['cartid']) && isset($_GET['catid']) && !empty ($_GET['catid'])) {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,ct.description,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id   where c.id='" . $_GET['cartid'] . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['cat_id'] . "' group by cat_id";
                                            $rs1 = mysql_query($strSQL1);
                                            $row1 = mysql_fetch_array($rs1);
            ?>

            <section id="aa-product-details">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="aa-product-details-area">
                                <div class="aa-product-details-content">
                                    <div class="row">
                                        <!-- Modal view slider -->
                                        <div class="col-md-5 col-sm-5 col-xs-12">                              
                                            <a data-lens-image="<?php echo $row['file_location']; ?>" class="simpleLens-lens-image">
                                                <img src="<?php echo $row['file_location']; ?>" class="simpleLens-big-image">
                                            </a>
                                        </div>
                                        <!-- Modal view content -->
                                        <div class="col-md-7 col-sm-7 col-xs-12">
                                            <div class="aa-product-view-content">
                                                <h3><?php echo $row['name']; ?></h3>
                                                <div class="aa-price-block">
                                                    <span class="aa-product-view-price">&#36; <?php echo $row['price_in_dollar']; ?></span>
                                                    <p class="aa-product-avilability">Avilability: <span><?php if($row1['stock'] > 0) { echo $row1['stock']." "; } else{ echo "Out of Stock"; }?> </span></p>
                                                </div>
                                                <p><?php echo $row['description']; ?></p>
                                                <form action="addToCart.php" method="post">
                                                    <div class="aa-prod-quantity">
                                                                <label>Quantity in </label><br>
                                                                <input type="number" name="quantity" id="quantity" min="0" max="<?php echo $row1['stock']; ?>" required="" style="width: 30%;" value="<?php echo $row['quantity']; ?>">
                                                                <input type="text" name="catid" id="catid" value="<?php echo $row['cat_id']; ?>" hidden="">
                                                                <input type="text" name="cartid" id="cartid" value="<?php echo $_GET['cartid']; ?>" hidden="">
                                                                <input type="text" name="update" id="update" value="update" hidden="">
                                                            </div>
                                                      <div>
                                                    <?php if($row1['stock'] > 0) { ?>
                                                          <a  href="#"><button type="submit" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button></a>   
                                                     <?php } ?>
                                                </div>
                                                </form>
                                                
                                                
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="aa-product-details-bottom" >
                                    <ul class="nav nav-tabs" id="myTab2">
                                        <li><a href="#description" data-toggle="tab" style="font-weight: bolder;margin-top: 50px;">Description</a></li>                                                    
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="description">
                                            <p><?php echo $row['description']; ?></p>                                           
                                            
                                        </div>
                                                   
                                    </div>
                                </div>
                                <!-- Related product -->
                                 
                            </div>
                        </div>
                    </div>
                </div>
            </section><?php
}else {
    ?>

    <div class="alert alert-info" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong> No category Exists with the Selected Item</strong>
    </div>

    <?php
}
?>


<?php include 'footernew.php'; ?>