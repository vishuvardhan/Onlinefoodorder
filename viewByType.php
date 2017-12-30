<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>


<!-- Start header section -->

<!-- / header section -->
<!-- menu -->


<!-- / Promo section -->
<!-- Products section -->
 <?php
                       if (isset($_GET['type_id']) && !empty($_GET['type_id'])) {
                        $strSQL2 = "SELECT * FROM types where id='".$_GET['type_id']."'";
                        $rs2 = mysql_query($strSQL2);
                        $row2 = mysql_fetch_array($rs2);
                            ?>
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">                     

                            <div class="aa-product-inner" style="border: 1px solid #ccdc00;margin-bottom: 10px;">
                                <!-- start prduct navigation -->
                                <ul class="nav nav-tabs aa-products-tab" style="background-color: #6E6E6E;">
                                    <li class="active" style="width:100%;"><a class="pull-left"style="margin-left:15px;color:white;text-decoration:none"><?php echo $row2['type_title']; ?></a></li>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Start men product category -->
                                    <div class="tab-pane fade in active" id="cashew">
                                        <ul class="aa-product-catg" style="width:100%;margin-left: 0px;">
                                            <!-- start single product item -->
                                            <?php
                                            $strSQL = "SELECT * FROM category where type_id='" . $_GET['type_id'] . "'";

                                            $rs = mysql_query($strSQL);
                                            ?>
                                            <?php
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
                                                    <div class="aa-product-hvr-content" >

                                                        <a href="#" data-toggle2="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#quick-view-modal<?php echo $row['id']; ?>" ><span class="fa fa-search"></span></a>                          
                                                    </div>                         

                                                </li>
                                            <?php } ?>
                                        </ul>

                                    </div>
                                    
                                    <!-- / men product category -->                    
                                </div>
                                <!-- quick view modal -->  
                                <?php
                                $strSQL = "SELECT * FROM category where type_id='" . $_GET['type_id'] . "'";
                                $rs = mysql_query($strSQL);
                                while ($row = mysql_fetch_array($rs)) {
                                    $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                                    $rs1 = mysql_query($strSQL1);
                                    $row1 = mysql_fetch_array($rs1);
                                    ?>

                                    <div class="modal fade" id="quick-view-modal<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">                      
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <div class="row">
                                                        <!-- Modal view slider -->
                                                        <div class="col-md-6 col-sm-6 col-xs-12">                              
                                                            <a  data-lens-image="<?php echo $row['file_location']; ?>">
                                                                <img src="<?php echo $row['file_location']; ?>" class="simpleLens-big-image" style="width:250px;height: 300px;">
                                                            </a>
                                                        </div>
                                                        <!-- Modal view content -->
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <div class="aa-product-view-content">
                                                                <h3><?php echo $row['name']; ?></h3>
                                                                <div class="aa-price-block">
                                                                    <span class="aa-product-view-price">&#36; <?php echo $row['price_in_dollar']; ?></span>
                                                                    <p class="aa-product-avilability">Avilability: <span><?php
                                                                            if ($row1['stock'] > 0) {
                                                                                echo $row1['stock'] . " ";
                                                                            } else {
                                                                                echo "Out of Stock";
                                                                            }
                                                                            ?></span></p>
                                                                </div>
                                                                <p><?php echo $row['description']; ?> </p>   
                                                                <form action="addToCart.php" method="post">
                                                                    <div class="aa-prod-quantity">
                                                                        <label>Quantity in </label><br>
                                                                        <input type="number" name="quantity" id="quantity" min="0" max="<?php echo $row1['stock']; ?>" required="" style="width: 60%;">
                                                                        <input type="text" name="catid" id="catid" value="<?php echo $row['id']; ?>" hidden="">                                                              
                                                                    </div>
                                                                    <div class="aa-prod-view-bottom">
                                                                        <?php if ($row1['stock'] > 0) { ?>
                                                                            <a  href="#"><button type="submit" class="aa-add-to-cart-btn"><span class="fa fa-shopping-cart"></span>Add To Cart</button></a>

                                                                        <?php } ?>
                                                                        <a href="viewCategory.php?id=<?php echo $row['id']; ?>" class="aa-add-to-cart-btn">View Details</a>
                                                                    </div>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                        
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- / quick view modal -->      
                                <?php } ?>          
                            </div>

                       



<?php
}else {
    ?>

    <div class="alert alert-info" id="danger-alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong> No category Exists with the Selected Type</strong>
    </div>

    <?php
}
?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->


<?php include 'footernew.php'; ?>