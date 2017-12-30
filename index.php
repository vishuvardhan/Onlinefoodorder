<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<div class="wrapper">

    <!--=== Slider ===-->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>


                <!-- SLIDE -->
                <li class="revolution-mch-1" data-transition="fade" data-slotamount="5" data-masterspeed="1000" data-title="Slide 3">
                    <!-- MAIN IMAGE -->
                    <img src="ECommerce/assets/img/main3.jpg"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="cover" 
                     data-bgrepeat="no-repeat">

                   
                </li>
                <!-- END SLIDE -->

            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
        </div>
    </div>
    <!--=== End Slider ===-->

    <!--=== Product Content ===-->
    <div class="container content-md">
        <?php
        $strSQL2 = "SELECT * FROM types";
        $rs2 = mysql_query($strSQL2);
        $i = 0;
        while ($row2 = mysql_fetch_array($rs2)) { //outer Loop No.of Types 
            ?>

            <div class="heading heading-v1 margin-bottom-20">
                <h2><?php echo $row2['type_title']; ?></h2>
            </div>

            <!--=== Illustration v2 ===-->
            <div class="illustration-v2 margin-bottom-60">
                <div class="customNavigation margin-bottom-25">
                    <a class="owl-btn prev rounded-x"><i class="fa fa-angle-left"></i></a>
                    <a class="owl-btn next rounded-x"><i class="fa fa-angle-right"></i></a>
                </div>
                <?php
                $strSQL = "SELECT * FROM category where type_id='" . $row2['id'] . "'";

                $rs = mysql_query($strSQL);
                ?>


                <ul class="list-inline owl-slider">
                    <?php
                    while ($row = mysql_fetch_array($rs)) { //Inner Loop Each type LIMIT 4 times 
                        $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['id'] . "' group by cat_id";
                        $rs1 = mysql_query($strSQL1);
                        $row1 = mysql_fetch_array($rs1);
                        ?>
                        <li class="item">
                            <div class="product-img">
                                <a href="viewCategory.php?id=<?php echo $row['id']; ?>"><img class="full-width img-responsive" style="height: 200px;" src="<?php echo $row['file_location']; ?>" alt="<?php echo $row['file_name']; ?>"></a>
                                <?php if ($row1['stock'] > 0) { ?>
                                    <a class="add-to-cart" href="viewCategory.php?id=<?php echo $row['id']; ?>"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                <?php } ?>
                                <?php if ($row1['stock'] <= 0) { ?> <div class="shop-rgba-red rgba-banner">Out of stock</div> <?php } ?>

                            </div>
                            <div class="product-description product-description-brd">
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price"><a href="viewCategory.php?id=<?php echo $row['id']; ?>"><?php echo $row['name']; ?></a></h4>
                                        <span class="gender text-uppercase"></span>
                                        <span class="gender"></span>
                                    </div>
                                    <div class="product-price">
                                        <span class="title-price">$ <?php echo $row['price_in_dollar']; ?></span>
                                    </div>
                                </div>
                                <div class="overflow-h margin-bottom-5">
                                    <div class="pull-left">
                                        <h4 class="title-price">Stock</h4>
                                        <span class="gender text-uppercase"></span>
                                        <span class="gender"></span>
                                    </div>
                                    <div class="product-price">
                                        <span class="title-price"><?php
                        if ($row1['stock'] > 0) {
                            echo $row1['stock'] . " ";
                        } else {
                            echo "Out of Stock";
                        }
                                ?> </span>
                                    </div>
                                </div>

                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!--=== End Illustration v2 ===-->
        <?php } ?>
    </div>
    <!--=== End Product Content ===-->

    

    <?php include 'footernew.php'; ?>