<?php
session_start();
include_once 'mysql.php';
include_once 'headernew.php';
include_once 'userTopNew.php';
$subTotal=0;
if (isset($_SESSION['userId'])) {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id   where c.user_id='" . $_SESSION['userId'] . "' and c.order_placed=0";
} else {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id  where c.guest_cookie_id='" . $_COOKIE['guest_id'] . "' and c.order_placed=0";
}

$rs = mysql_query($strSQL);
?>
<section id="cart-view" style="margin-bottom: 50px;background-color:#FFF;">
    <div class="container" style="margin-bottom: 150px;">
        <div class="row">
            <div class="col-md-12">
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
                }
                ?>
                <?php
                if (mysql_num_rows($rs) == 0) {
                    ?>
                    
                <?php } else { ?>
                <div class="cart-view-area" style="background-color: #FFF;">
                        <div class="cart-view-table" style="background-color: #FFF;">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Price   </th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysql_fetch_array($rs)) { ?>
                                                <tr>
                                                    <td><a href="deleteCart.php?id=<?php echo $row['id'];?>"><span class="label label-danger">Delete</span></a></td>
                                                    <td><a href="viewCategory.php?catid=<?php echo $row['cat_id'];?>&cartid=<?php echo $row['id']; ?>"><span class="label label-info">Edit</span></a></td>
                                                    <td><img src="<?php echo $row['file_location']; ?>" style="height:50px;width: 50px;"></td>
                                                    <td><a class="aa-cart-title" href="#"><?php echo $row['name']; ?></a></td>
                                                    <td>&#36; <?php echo $row['price_in_dollar']; ?></td>
                                                    <td><?php echo $row['quantity']; ?></td>
                                                    <td><?php echo round($row['price_in_dollar']*$row['quantity'], 2); ?></td>
                                                </tr>
                                                    

                                            <?php
                                            $subTotal+=$row['price_in_dollar']*$row['quantity'];
                                            }
                                        
                                        ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <!-- Cart Total view -->
                        <div class="cart-view-total">
                            <h4>Cart Totals</h4>
                            <table class="aa-totals-table">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>&#36; <?php echo round($subTotal, 2) ; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tax(9%)</th>
                                        <td>&#36;<?php echo round($subTotal*0.09, 2) ; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>&#36; <?php echo round($subTotal+$subTotal*0.09, 2) ; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <a href="checkout1.php" class="btn btn-primary" >Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>



<?php include 'footernew.php'; ?>