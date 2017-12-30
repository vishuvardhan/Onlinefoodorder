<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<!-- / Promo section -->
<!-- Products section -->
<section id="cart-view" style="background-color:#FFF;">
    <div class="container" style="margin-bottom: 150px;">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
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
                            <div class="cart-view-table" style="background-color:#FFF;margin-bottom: 100px;">
                                <form action="">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                                
                                                    <th>#</th>
                                                    <th>Current Status</th>
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
                <?php } else { ?>
                        <div class="alert alert-info" id="danger-alert" style="margin-bottom: 100px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no Tracking Updated Yet. </strong>
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