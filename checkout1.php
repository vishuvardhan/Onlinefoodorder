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

<section id="aa-myaccount" style="margin-bottom: 50px;background-color:#FFF;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aa-myaccount-area">         
                    <div class="row">
                        <div class="col-md-6">
                            <div class="aa-myaccount-login">
                                <h4>Delivery Address</h4>                                
                                <form method="POST" action="checkout1Status.php" class="aa-login-form">
                                    <label for="">Select Country<span>*</span></label>
                                    <?php   $strSQL1 = "SELECT * FROM priceconversion";
                                            $rs1 = mysql_query($strSQL1); ?>
                                    <div><select name="country" id="status"  style="width: 100%;">
                                            <?php while ($row1 = mysql_fetch_array($rs1)) { ?>
                                            <option value="<?php echo $row1['id']; ?>" selected=""><?php echo $row1['country']; ?></option>
                                            <?php } ?>                     
                                        </select>
                                    </div><br>
                                    <label for="">State<span>*</span></label>
                                    <input type="text" placeholder="State" name="state" required="" pattern="[a-zA-Z ]*">
                                    <label for="">City<span>*</span></label>
                                    <input type="text" placeholder="city" name="city" required="" pattern="[a-zA-Z ]*">
                                    <label for="">Address<span>*</span></label><br>
                                    <textarea cols="50" rows="5" name="address" required=""></textarea><br>
                                    <label for="">Mobile<span>*</span></label>
                                    <input type="text" placeholder="Mobile" name="mobile" required="" pattern="[0-9]{10}">
                                    <button type="submit" class="btn btn-primary">Continue</button>                                                                        
                                </form>
                            </div>
                        </div>                        
                    </div>          
                </div>
            </div>
        </div>
    </div>
</section>






<?php include 'footernew.php'; ?>