<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<div class="wrapper" style="margin-bottom: 100px;">
<?php
if (isset($_GET['cartid']) && !empty($_GET['cartid']) && isset($_GET['catid']) && !empty ($_GET['catid'])) {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,ct.description,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id   where c.id='" . $_GET['cartid'] . "'";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    $strSQL1 = "SELECT sum(stock_in_lbs) as stock FROM stock where cat_id='" . $row['cat_id'] . "' group by cat_id";
                                            $rs1 = mysql_query($strSQL1);
                                            $row1 = mysql_fetch_array($rs1);
            ?>

            <div class="shop-product">
			<!-- Breadcrumbs v5 -->
			<div class="container">
				<ul class="breadcrumb-v5">
					<li><a href="index.php"><i class="fa fa-home"></i></a></li>
					
				</ul>
			</div>
			<!-- End Breadcrumbs v5 -->

			<div class="container">
				<div class="row">
					<div class="col-md-6 md-margin-bottom-50">
						<div class="ms-showcase2-template">
							<!-- Master Slider -->
							<div class="master-slider ms-skin-default">
								<div class="ms-slide">
                                                                    <img style="width: 300px;height: 250px;" src="<?php echo $row['file_location']; ?>" data-src="<?php echo $row['file_location']; ?>" alt="">
									
								</div>
								
							</div>
							<!-- End Master Slider -->
						</div>
					</div>

					<div class="col-md-6">
						<div class="shop-product-heading">
							<h2><?php echo $row['name']; ?></h2>
							
						</div>

						

						<p><?php echo $row['description']; ?></p><br>

						<ul class="list-inline shop-product-prices margin-bottom-10">
							<li class="shop-green">$ <?php echo $row['price_in_dollar']; ?></li>
							
						</ul>
                                                <ul class="list-inline shop-product-prices margin-bottom-10">
                                                    <p></p>
                                                     
							<li class="shop-green">Stock : <?php if($row1['stock'] > 0) { echo $row1['stock']." "; } else{ echo "Out of Stock"; }?></li>
							
						</ul>

						<h3 class="shop-product-title">Quantity</h3>
						<div class="margin-bottom-40">
							<form action="addToCart.php" method="post" name="f1" class="product-quantity sm-margin-bottom-20">
                                                            <input type='number' class="quantity-field" name="quantity" min="1" id="quantity"  max="<?php echo $row1['stock']; ?>" required="" value="<?php echo $row['quantity']; ?>"/>
								  <input type="text" name="catid" id="catid" value="<?php echo $row['cat_id']; ?>" hidden="">
                                                                <input type="text" name="cartid" id="cartid" value="<?php echo $_GET['cartid']; ?>" hidden="">
                                                                <input type="text" name="update" id="update" value="update" hidden="">
                                                                 <input type="text" name="order" id="update" value="order" hidden="">
                                                                  <input type="text" name="order_num" id="update" value="<?php echo $_GET['order_num']; ?>" hidden="">
                                                       
                                                      <?php if($row1['stock'] > 0) { ?>
                                                                 <button type="submit" class="btn-u btn-u-sea-shop btn-u-lg" style="margin-left: 20px;">Add to Cart</button>
                                                     <?php } ?>
							 </form>
						</div><!--/end product quantity-->

						</div>
				</div><!--/end row-->
			</div>
		</div>
    
    <?php
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