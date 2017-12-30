<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
?>
<!-- / Promo section -->
<!-- Products section -->
<section id="cart-view" style="background-color:#FFF;">
    <div class="container" style="margin-bottom: 20px;">
        <div class="row">
            <div class="col-lg-9 col-md-9 col-sm-8 col-md-push-3">
                <?php if (isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?>
                    <?php
                    $strSQL = "SELECT * FROM feedback where order_num='" . $_GET['order_num'] . "'";
                    $rs = mysql_query($strSQL);
                    if (mysql_num_rows($rs) == 0) {
                        ?>
                        <div class="alert alert-info" id="danger-alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong> There is no Feed Back Updated Yet. </strong>
                        </div>
                    <?php } else {
                        ?>
                        <h3 class="title1">Feedback Details - With Order Id <?php echo $_GET['order_num']; ?></h3> 
                        <div class="cart-view-area">
                            <div class="cart-view-table" style="background-color:#FFF;padding: 0px;;">
                             
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>                                                
                                                    <th>#</th>
                                                    <th>Comment</th>
                                                    <th>Commented By</th>
                                                    <th>Commented On</th>
                                                                                
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
                                                        <td><?php echo $row['comment']; ?></td> 
                                                        <td><?php echo $row['commented_by']; ?></td>
                                                        <td><?php echo $row['commented_on']; ?></td>
                                                        
                                                    </tr>
                                                    <?php                                                   
                                                    $i++;
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                             
                                <!-- Cart Total view -->                              
                            </div>
                        </div>
                    <?php } ?>         
                <?php } else { ?>
                        <div class="alert alert-info" id="danger-alert" style="margin-bottom: 10px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no Tracking Updated Yet. </strong>
                    </div>
                <?php } ?>
                        
                      
                            <form enctype="multipart/form-data" method="post" action="updatefeedbackStatus.php" role="form">                                  
                                <div class="form-group"> 
                                    <label for="Name"> Submit Feed Back</label> <br>
                                    <textarea name="comment" cols="50" rows="5" class="form-control"></textarea>
                                     <input type="text" name="order_num" value="<?php echo $_GET['order_num']; ?>" hidden="">
                                      <input type="text" name="commented_by" value="customer" hidden="">
                                </div>                                
                    

                                <button type="submit" class="btn btn-primary">Submit</button> 
                            </form>
                       
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