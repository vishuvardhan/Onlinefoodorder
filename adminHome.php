<?php
session_start();
$_SESSION['page']="orders";
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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Orders</h1>
        </div>
    </div><!--/.row-->
<?php
                if (isset($_GET) && !empty($_GET)) {
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

                        <?php
                    }
                }

                $strSQL = "SELECT * FROM orders  group by order_num order by ordered_on DESC";
                $rs = mysql_query($strSQL);

                if (mysql_num_rows($rs) == 0) {
                    ?>
                    <div class="alert alert-info" id="danger-alert">
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
                                    <th>Order Id</th>
                                    <th>User Name</th>
                                    <th>Mobile</th>
                                    <th>Ordered On</th>
                                    <th>View Order</th> 
                                    <th>Update Tracking Status</th>
                                    <th>Feedback</th>
                            </tr>
                        </thead>
                        <tbody> 
                                <?php
                                $i = 1;
                                while ($row = mysql_fetch_array($rs)) {

                                   
                                    ?>

                                    <tr > 
                                         <td><?php echo $i; ?></td>                                        
                                        <td><?php echo $row['order_num']; ?></td> 
                                        <td><?php echo $row['username']; ?></td> 
                                        <td><?php echo $row['mobile']; ?></td> 
                                        <td><?php echo $row['ordered_on']; ?></td>
                                        <td><a href="adminViewOrder.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-info">View</span></a></td> 
                                        <td><a href="adminUpdateOrderStatus.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-success">Update Status</span></a></td>
                                        <td><a href="feedbackAdmin.php?order_num=<?php echo $row['order_num']; ?>"><span class="label label-success">Feed Back</span></a></td>
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

</div><!--/.main-->





<!-- Classie -->
<?php include_once 'adminFooter.php'; ?>