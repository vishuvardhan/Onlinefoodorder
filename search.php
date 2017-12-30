<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>


<!-- Start header section -->

<!-- / header section -->
<!-- menu -->

<?php
$strSQL = "SELECT * FROM category where  name LIKE '%".$_POST['searchtext']."%'";

$rs = mysql_query($strSQL);
?>
<!-- / Promo section -->
<!-- Products section -->
<section id="aa-product">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="aa-product-area">
                        <div class="aa-product-inner">
                            <!-- start prduct navigation -->

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Start men product category -->
                                <div class="tab-pane fade in active" id="cashew">
                                    <ul class="aa-product-catg" style="width:100%;margin-left: 0px;">
                                        <!-- start single product item -->
                                        <?php
                                        while ($row = mysql_fetch_array($rs)) {
                                            $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                                            $rs1 = mysql_query($strSQL1);
                                            $row1 = mysql_fetch_array($rs1);
                                            ?>

                                            <li>
                                                <figure>
                                                    <a class="aa-product-img" href="viewCategory.php?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['file_location']; ?>" alt="<?php echo $row['file_name']; ?>" style="width: 250px;height: 300px;"></a>
                                                      <?php if($row1['stock'] > 0) { ?>
                                                    <a class="aa-add-card-btn"href="viewCategory.php?id=<?php echo $row['id']; ?>"><span class="fa fa-shopping-cart"></span>Add To Cart</a>
                                                      <?php } ?>
                                                    <figcaption>
                                                        <h4 class="aa-product-title" style="font-size: 16px;"><a href="viewCategory.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h4>
                                                        <span class="aa-product-price" style="color: black;">Price : </span><span class="aa-product-price">&#36; <?php echo $row['price_in_dollar']; ?></span><br>
                                                        <span class="aa-product-price" style="color: black;">Available Stock : </span><span class="aa-product-price"><?php if($row1['stock'] > 0) { echo $row1['stock']." "; } else{ echo "Out of Stock"; }?> </span>
                                                    </figcaption>
                                                </figure>                        
                                                <div class="aa-product-hvr-content">
                                                    
                                                     </div>                         

                                            </li>
                                        <?php } ?>
                                    </ul>

                                </div>
                                <!-- / men product category -->                    
                            </div>
                            <!-- quick view modal -->  
                                     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->


<?php include 'footernew.php'; ?>