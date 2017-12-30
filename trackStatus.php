<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<!-- / Promo section -->
<!-- Products section -->
<section id="cart-view" style="margin-bottom: 50px;background-color:#FFF;">
    <div class="container">
        <div class="row">
            <?php
                if (isset($_GET['s']) && !empty($_GET)) {
                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
                        ?>                      
                        <div class="alert alert-danger" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>                      
                    <?php } ?>

                    <?php
                    if (isset($_GET['s']) && !empty($_GET['s']) && $_GET['s'] == 1) {
                        ?>

                        <div class="alert alert-success" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>

                        <?php
                    }
                }
                ?>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <form action="trackStatus.php" method="GET">
                    <div class="aa-prod-quantity">
                        <label>Order Number </label><br>
                        <input type="text" name="order_num" id="order_num" required="" class="form-control" style="width: 50%;"  <?php if (isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?> value="<?php echo $_GET['order_num']; ?>" <?php } ?>>
                        <br>  <button type="submit" class="btn btn-primary" >Get Status</button>                                                              
                    </div>
                </form>
                <br>
                <?php if (isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?>
                    <?php
                    $strSQL = "SELECT * FROM orderstatus where order_num='" . $_GET['order_num'] . "'";
                    $rs = mysql_query($strSQL);
                    if (mysql_num_rows($rs) == 0) {
                        ?>
                        <div class="alert alert-info" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> There is no Tracking Updated Yet. </strong>
                        </div>
                    <?php } else {
                        ?>
                        <h3 class="title1">Order Tracking Details - With Order Id <?php echo $_GET['order_num']; ?></h3> 
                        <div class="cart-view-area">
                            <div class="cart-view-table" style="background-color:#FFF;">
                                <form action="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                                
                                                    <th>#</th>
                                                    <th>Message</th>
                                                    <th>Updated On</th>
                                                    <th>Time Required in Minutes</th>
                                                    <th>Status</th>
                                                </tr>

                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
                                                $subTotal = 0;
                                                while ($row = mysql_fetch_array($rs)) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>                                         
                                                        <td><?php echo $row['place_of_item']; ?></td> 
                                                        <td><?php echo $row['updated_on']; ?></td>
                                                        <td><?php echo $row['time_required_min']; ?></td>
                                                        <td><?php echo $row['order_status']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <!-- Cart Total view -->                              
                            </div>
                        </div>
                    <?php } ?>       

                     <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?php if(isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?>
                <?php
                $strSQL = "SELECT * FROM orders where order_num='" . $_GET['order_num'] . "'";
                $rs = mysql_query($strSQL);
                if (mysql_num_rows($rs) == 0) {
                    ?>
                    <div class="alert alert-info" id="danger-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no Orders exists. </strong>
                    </div>
                <?php } else {
                    ?>
                <h3 class="title1">Order Details - With Order Id <?php echo $_GET['order_num']; ?></h3> 
                    <div class="cart-view-area">
                        <div class="cart-view-table" style="background-color:#FFF;">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>                                             
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                
                                                <th>Quantity</th>
                                                <th>Price per Unit</th>
                                                <th>Total</th>                                    
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            $subTotal = 0;
                                            while ($row = mysql_fetch_array($rs)) {

                                                $strSQL1 = "SELECT * FROM category where id='" . $row['cat_id'] . "'";
                                                $rs1 = mysql_query($strSQL1);
                                                $row1 = mysql_fetch_array($rs1);
                                                $priceSymbol = $row['price_symbol'];
                                                
                                                ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $row1['name']; ?></td> 
                                                    <td><img src="<?php echo $row1['file_location']; ?>" style="height:50px;width: 50px;"></td>  
                                                    <td><?php echo $row['quantity']; ?></td> 
                                                    <td><?php echo $row['price_symbol'] . " " . ($row['price'] / $row['quantity']); ?></td>
                                                    <td><?php echo $row['price_symbol'] . " " . ($row['price']); ?></td>
                                                </tr>


                                                <?php
                                                $subTotal+=$row['price'];
                                                $i++;
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                            <!-- Cart Total view -->
                            <div class="cart-view-total">
                                <h4>Order Totals</h4>
                                <table class="aa-totals-table" style="background-color:#FFF;">
                                    <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td>&#36; <?php echo $subTotal; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Tax(9%)</th>
                                            <td>&#36;<?php echo $subTotal * 0.09; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td>&#36; <?php echo $subTotal + $subTotal * 0.09; ?></td>
                                        </tr>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                <?php } ?>         
                <?php } else { ?>
                <div class="alert alert-info" id="danger-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no Orders exists. </strong>
                    </div>
                <?php } ?>
            </div>
            

        </div>
                    
                <?php } else { ?>
                    <div class="alert alert-danger" id="danger-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> Please Enter Order Number to Track. </strong>
                    </div>
                <?php } ?>
            </div>


        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->


<?php include 'footernew.php'; ?>