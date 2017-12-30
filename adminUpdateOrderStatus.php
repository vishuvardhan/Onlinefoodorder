<?php
session_start();
include_once 'mysql.php';
include_once 'adminHeader.php';
include_once 'adminTop.php';
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
        </div>
    </form>
    <?php include_once 'adminLeft.php'; ?>

</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="adminHome.php"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
            <li class="active">Orders</li>
        </ol>
    </div><!--/.row-->
    <?php
    if (isset($_GET['s']) && !empty($_GET['s'])) {
        if (isset($_GET) && !empty($_GET) && $_GET['s'] == 0) {
            ?>                      
            <div class="alert bg-danger" id="danger-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> <?php echo $_GET['st'] ?> </strong>
            </div>                      
        <?php } ?>

        <?php
        if (isset($_GET) && !empty($_GET) && $_GET['s'] == 1) {
            ?>

            <div class="alert bg-success" id="danger-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> <?php echo $_GET['st'] ?> </strong>
            </div>

        <?php } ?>


    <?php } ?>
    <?php if (isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Order Tracking Status - With Order Id <?php echo $_GET['order_num']; ?></h1>
            </div>
        </div><!--/.row-->
        <?php
        $strSQL = "SELECT * FROM orderstatus where order_num='" . $_GET['order_num'] . "'";
        $rs = mysql_query($strSQL);

        if (mysql_num_rows($rs) == 0) {
            ?>
            <div class="alert bg-info" id="danger-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> There is no Order Status Available. </strong>
            </div>
        <?php } else {
            ?>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Orders</div>
                        <div class="panel-body">
                            <table data-toggle="table">
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
                                    $subtotal = 0;
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
                    </div>
                </div>
            </div><!--/.row-->	

        <?php } ?>
    <?php } else { ?>
        <div class="alert bg-info" id="danger-alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong> There is no Orders exists. </strong>
        </div>
    <?php } ?>
            <div class="row">
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                <form enctype="multipart/form-data" method="post" action="adminUpdateOrderStatus1.php" role="form">                                  
                                <div class="form-group"> 
                                    <label for="Name">Place of Item</label> <br>
                                    <textarea name="place" cols="50" rows="5" class="form-control"></textarea>
                                </div> 
                                <div class="form-group"> 
                                    <label for="Name">Time Required in Minutes</label> <br>
                                    <input type="number" name="time_required_min"  class="form-control" min="0">
                                    <input type="text" name="ordernum" value="<?php echo $_GET['order_num']; ?>" hidden="">

                                </div>
                    <div class="form-group"> 
                                    <label for="Name">Status</label> <br>
                                    <select name="order_status" required="" class="form-control">
                                        <option selected="" value="Yet to Deliver">Yet to Deliver</option>
                                        <option value="Order Confirmed">Order Confirmed</option>
                                        <option value="Ready to Deliver">Ready to Deliver</option>
                                        <option value="Delivered">Delivered</option>
										<option value="cancelled">Cancelled</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button> 
                            </form>
                    </div>
            </div>
                                       
                            

           
</div><!--/.main-->





<!-- Classie -->
<?php include_once 'adminFooter.php'; ?>

