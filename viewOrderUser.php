<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<!-- / Promo section -->
<!-- Products section -->
<section id="cart-view" style="background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
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
                        <div class="cart-view-table" style="background-color:#FFF; margin-bottom: 100px;">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>                                             
                                                <th>#</th>
                                                <th>Category</th>
                                                <th>Image</th>
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
                                                    <td><?php echo $row['quantity']  ?></td> 
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
                                <table class="aa-totals-table">
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
            <div class="col-lg-3 col-md-3 col-sm-4 col-md-pull-9">
                <aside class="aa-sidebar">
                    <!-- single sidebar -->
                    <div class="aa-sidebar-widget">
                        <h3>My Dashboard</h3>
                        <ul class="aa-catg-nav">
                            <li><a href="userDashboard.php">My Orders</a></li>               
                        </ul>
                    </div>            
                </aside>
            </div>

        </div>
    </div>
</section>
<!-- / Products section -->
<!-- banner section -->


<?php include 'footernew.php'; ?>