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
                 <?php
                if (isset($_GET) && !empty($_GET)) {
                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
                        ?>                      
                        <div class="alert alert-danger" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>                      
                    <?php } ?>

                    <?php
                    if (isset($_GET) && !empty($_GET) && $_GET['s'] == 1) {
                        ?>

                        <div class="alert alert-success" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> <?php echo $_GET['st'] ?> </strong>
                        </div>

                        <?php
                    }
                }?>
                                <?php
                                $strSQL = "SELECT * FROM orders where user_id='".$_SESSION['userId']."' group by order_num order by ordered_on desc";
                                $rs = mysql_query($strSQL);
                                if (mysql_num_rows($rs) == 0) {
                                    ?>
                                    <div class="alert alert-info" id="danger-alert">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong> There is no Orders exists. </strong>
                                    </div>
                                <?php } else {
                                    ?>

                                    <div class="cart-view-area">
                                        <div class="cart-view-table" style="background-color:#FFF;m">
                                            <form action="">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Order Id</th>                                    
                                                                <th>Ordered On</th>
                                                                <th>View Order</th> 
                                                                <th>Tracking Status</th>
                                                                <th>Cancel Order</th>
                                                                <th>FeedBack</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            <?php
                                                            $i = 1;
                                                            while ($row = mysql_fetch_array($rs)) {

                                                                if ($i % 4 == 0) {
                                                                    $color = "active";
                                                                } elseif ($i % 4 == 1) {
                                                                    $color = "";
                                                                } elseif ($i % 4 == 2) {
                                                                    $color = "info";
                                                                } elseif ($i % 4 == 3) {
                                                                    $color = "";
                                                                }
                                                                ?>

                                                                <tr> 
                                                                    <th scope="row"><?php echo $i; ?></th>                                         
                                                                    <td><?php echo $row['order_num']; ?></td>                                                                    
                                                                    <td><?php echo $row['ordered_on']; ?></td>
                                                                    <td><a href="viewOrderUser.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-info">View</span></a></td> 
                                                                   <?php 
                                                                     $strSQL1 = "SELECT * FROM orderstatus as os LEFT JOIN orders as o on o.order_num=os.order_num where os.order_num='" . $row['order_num'] . "' order by os.updated_on DESC LIMIT 1";
                                                                     $rs1 = mysql_query($strSQL1);
                                                                     $row1 = mysql_fetch_array($rs1);
                                                                   
                                                                   ?>
                                                                     <?php
                                                                           
                                                                            if (isset($row1['order_status']) && !empty($row1['order_status']) && $row1['order_status'] == "Delivered") {
                                                                            ?>   
                                                                    <td> Delivered</td>
                                                                            <?php }else{
                                                                            ?>
                                                                   <td><a href="viewOrderStatus.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-success">Track Status</span></a></td>
                                                                             <?php } ?>
                                                                    
                                                                    <?php
                                                                           
                                                                            if (isset($row1['order_status']) && !empty($row1['order_status']) && $row1['order_status'] == "Delivered") {
                                                                            ?>   
                                                                    <td> Delivered</td>
																			
																	
                                                                            <?php }else{
                                                                            ?>
                                                                    <td><a href="cancelOrderUser.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-danger">Cancel</span></a></td> 
                                                                            <?php } ?>

                                                                    
																	<?php
                                                                           
                                                                            if (isset($row1['order_status']) && !empty($row1['order_status']) && $row1['order_status'] == "Delivered") {
                                                                            ?>   
                                                                    <td><a href="feedbackUser.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-info">Feed Back</span></a></td>
                                                                            <?php }else{
                                                                            ?>
                                                                   <td>  No Feed Back </td>
                                                                             <?php } ?>
																	
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