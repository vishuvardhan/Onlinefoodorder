<?php
session_start();
include_once 'mysql.php';
$strSQL5 = "SELECT * FROM priceconversion where id='" . $_SESSION['conversionId'] . "'";
$rs5 = mysql_query($strSQL5);
$row5 = mysql_fetch_array($rs5);



include_once 'headernew.php';
include_once 'userTopNew.php';
$subTotal = 0;
if (isset($_SESSION['userId'])) {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id   where c.user_id='" . $_SESSION['userId'] . "' and c.order_placed=0";
} else {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id  where c.guest_cookie_id='" . $_COOKIE['guest_id'] . "' and c.order_placed=0";
}

$rs = mysql_query($strSQL);
?>

<section id="aa-myaccount" style="background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area" style="padding: 0px;">         
                    <div class="row">
                        <div class="col-md-6">
                            <div class="aa-myaccount-login">
                                <h4>Delivery Address</h4>                                
                                <form action="#" class="aa-login-form">
                                    <label for="">Country : <?php echo $row5['country']; ?><span></span></label>
                                    <br>
                                    <label for="">State : <?php echo $_SESSION['state']; ?><span></span></label><br>
                                    <label for="">City : <?php echo $_SESSION['city']; ?><span></span></label><br>
                                    <label for="">Address : <?php echo $_SESSION['address']; ?><span></span></label><br>                                    
                                    <label for="">Mobile : <?php echo $_SESSION['mobile']; ?><span></span></label>                                   
                                                                                                       
                                </form>
                            </div>
                        </div>                        
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>


<section id="cart-view" style="background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (mysql_num_rows($rs) == 0) {
                    ?>
                    <div class="alert alert-info" id="danger-alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong> There is no items in your cart. </strong>
                    </div>
                <?php } else { ?>
                    <div class="cart-view-area">
                        <div class="cart-view-table" style="background-color:#FFF;">
                            <form action="">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>                                              
                                                <th>Image</th>
                                                <th>Category</th>
                                                <th>Price in <?php echo $row5['currency_symbol'] ?></th>
                                                <th>Quantity </th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysql_fetch_array($rs)) { ?>
                                                <tr>                                                   
                                                    <td><img src="<?php echo $row['file_location']; ?>" style="height:50px;width: 50px;"></td>
                                                    <td><a class="aa-cart-title" href="#"><?php echo $row['name']; ?></a></td>
                                                    <td> <?php echo $row5['currency_symbol'] . " " . round($row['price_in_dollar'] * $row5['currency_rate_dollar'], 2)  ?></td>
                                                    <td><?php echo $row['quantity']* $row5['weight_to_lbs']  ; ?></td>
                                                    <td><?php echo round($row['price_in_dollar'] * $row['quantity']* $row5['currency_rate_dollar']* $row5['weight_to_lbs'], 2)  ; ?></td>
                                                </tr>


                                                <?php
                                                $subTotal+=$row['price_in_dollar'] * $row['quantity'] * $row5['currency_rate_dollar']* $row5['weight_to_lbs'];
                                            }
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
                                        <td><?php echo $row5['currency_symbol'] . " " . round($subTotal, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Tax(9%)</th>
                                        <td><?php $tax= ($subTotal * 0.09);echo $row5['currency_symbol'] . " " . round($tax, 2); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td><?php echo $row5['currency_symbol'] . " " . round($subTotal+$tax,2); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php if (isset($_SESSION['userId'])) { ?>
                                <a href="checkoutFinal.php" class="btn btn-primary">Place Order</a>
                            <?php }  ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

                            <?php if (!isset($_SESSION['userId'])) {?>
                                <section id="aa-myaccount" style="background-color:#FFF;">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="aa-myaccount-area">         
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="aa-myaccount-login">
                                                                <h4>Login</h4>                                                                
                                                                <form method="POST" action="userLoginStatus.php" class="aa-login-form">
                                                                    <label for="">Username or Email address<span>*</span></label>
                                                                    <input type="text" placeholder="Username or email" name="username">
                                                                    <label for="">Password<span>*</span></label>
                                                                    <input type="password" placeholder="Password" name="password">
                                                                    
                                                                    <button type="submit" class="btn btn-primary">Login</button>
                                                                    <label class="rememberme" for="rememberme">
                                                                        <input type="text" name="checkout" value="checkout" hidden="">
                                                                       
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="aa-myaccount-register">                 
                                                                <h4>Guest Checkout</h4>                                                                
                                                                <form method="post" class="aa-login-form" action="checkoutFinal.php">
                                                                    <label for="">Email address<span>*</span></label>
                                                                    <input type="text" placeholder="Email" name="username">                                                                    
                                                                    <input type="text" id="guestcheckout" value="guestcheckout" name="guestcheckout" hidden="">
                                                                    <button type="submit" class="btn btn-primary">Place Order</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>



<?php include 'footerNew.php'; ?>