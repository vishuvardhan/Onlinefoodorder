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
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <?php
                        $strSQL2 = "SELECT * FROM types";
                        $rs2 = mysql_query($strSQL2);
                        while ($row2 = mysql_fetch_array($rs2)) { //outer Loop No.of Types 
                            ?>

                            <div class="aa-product-inner" style="border: 2px solid #0d53c4;margin-bottom: 10px;">
                                <!-- start prduct navigation -->
                                <ul class="nav nav-tabs aa-products-tab" style="background-color: #4d6489;">
                                    <li class="active" style="width:100%;"><a class="pull-left"style="margin-left:15px;color:white;text-decoration:none"><?php echo $row2['type_title']; ?></a></li>

                                </ul>
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- Start men product category -->
                                    <div class="tab-pane fade in active" id="cashew">
                                        <ul class="aa-product-catg" style="width:100%;margin-left: 0px;">
                                            <!-- start single product item -->
                                            <?php
                                            $strSQL = "SELECT * FROM category where type_id='" . $row2['id'] . "' LIMIT 4";

                                            $rs = mysql_query($strSQL);
                                            ?>
                                            <?php
                                            while ($row = mysql_fetch_array($rs)) { //Inner Loop Each type LIMIT 4 times 
                                                $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                                                $rs1 = mysql_query($strSQL1);
                                                $row1 = mysql_fetch_array($rs1);
                                                ?>

                                                <li style="border: 2px solid #0d53c4;">
                                                    <figure style="margin-top:10px;">
                                                        <a class="aa-product-img" href="viewCategory.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['file_location']; ?>" alt="<?php echo $row['file_name']; ?>" style="width: 200px;height: 200px;"></a>
                                                        <?php if ($row1['stock'] > 0) { ?>
                                                            <a class="aa-add-card-btn"href="viewCategory.php?id=<?php echo $row['id']; ?>" style="bottom: 30%;"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                        <?php } ?>
                                                        <figcaption>
                                                            <h4 class="aa-product-title" style="font-size: 16px;"><a href="viewCategory.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h4>
                                                            <span class="aa-product-price" style="color: black;">Price : </span><span class="aa-product-price">&#36; <?php echo $row['price_in_dollar']; ?></span><br>
                                                            <span class="aa-product-price" style="color: black;">Available Stock : </span><span class="aa-product-price">
                                                                <?php
                                                                if ($row1['stock'] > 0) {
                                                                    echo $row1['stock'] . " ";
                                                                } else {
                                                                    echo "Out of Stock";
                                                                }
                                                                ?> </span>
                                                        </figcaption>
                                                    </figure>                        
                                                    <div class="aa-product-hvr-content" >

                                                          </div>                         

                                                </li>
                                            <?php } ?>
                                        </ul>

                                    </div>
                                    <a class="pull-right" href="viewByType.php?type_id=<?php echo $row2['id']; ?>" style="margin-right:25px;font-size: 14px;text-decoration: underline;margin-bottom: 10px;">View More From <?php echo $row2['type_title']; ?></a>
                                    <!-- / men product category -->                    
                                </div>
                                <!-- quick view modal -->  
                                        
                            </div>

                        <?php } ?>






                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->


<?php include 'footernew.php'; ?>