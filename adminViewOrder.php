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
    <?php if (isset($_GET['order_num']) && !empty($_GET['order_num'])) { ?>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Order Details - With Order Id <?php echo $_GET['order_num']; ?></h1>
            </div>
        </div><!--/.row-->
        <?php
        $strSQL = "SELECT * FROM orders where order_num='" . $_GET['order_num'] . "'";
        $rs = mysql_query($strSQL);

        if (mysql_num_rows($rs) == 0) {
            ?>
            <div class="alert bg-info" id="danger-alert">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong> There is no Orders exists. </strong>
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
                                    $subtotal = 0;
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
                                            <td><?php echo $row['quantity'] . " " . $row['quantity_symbol']; ?></td> 
                                            <td><?php echo $row['price_symbol'] . " " . round(($row['price'] / $row['quantity']), 2); ?></td>
                                            <td><?php echo $row['price_symbol'] . " " . ($row['price']); ?></td>
                                        </tr> 
                                        <?php
                                        $subtotal+=$row['price'];
                                        $i++;
                                    }
                                    ?>
                                    <tr> 
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Tax(9%)</td>
                                        <td><?php echo $priceSymbol . " " . ($subtotal * 0.09); ?></td>                                    
                                    </tr> 
                                    <tr> 
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Grand Total</td>
                                        <td><?php echo $priceSymbol . " " . ($subtotal + ($subtotal * 0.09)); ?></td>                                    
                                    </tr> 
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
</div><!--/.main-->





<!-- Classie -->
<?php include_once 'adminFooter.php'; ?>
