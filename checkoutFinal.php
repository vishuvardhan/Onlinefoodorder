<?php
session_start();
include_once 'mysql.php';


$strSQL5 = "SELECT * FROM priceconversion where id='" . $_SESSION['conversionId'] . "'";
$rs5 = mysql_query($strSQL5);
$row5 = mysql_fetch_array($rs5);
$username="";
$userId='';
$ordernum=  rand(1, 99).  time();
$category = 0;
if(isset($_POST['guestcheckout']) && ($_POST['guestcheckout']=="guestcheckout")){
    $username=$_POST['username'];
}else{
    $username=$_SESSION['username'];
    $userId = $_SESSION['userId'];
}
if (isset($_SESSION['userId'])) {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id   where c.user_id='" . $_SESSION['userId'] . "' and c.order_placed=0";
} else {
    $strSQL = "SELECT c.id,c.quantity,ct.name,ct.id as cat_id,ct.price_in_dollar,c.updated_on,ct.file_location FROM cart c LEFT JOIN category ct on c.cat_id=ct.id  where c.guest_cookie_id='" . $_COOKIE['guest_id'] . "' and c.order_placed=0";
}

$rs = mysql_query($strSQL);
while ($row = mysql_fetch_array($rs)) {
    $sql = "INSERT INTO orders (order_num,cart_id, user_id,username,cat_id,quantity,quantity_in_lbs,quantity_symbol,price,price_symbol,country,state,city,address,mobile)
    VALUES ('" . $ordernum . "','" . $row['id'] . "','" . $userId . "', '" . $username . "','" . $row['cat_id'] . "','" . $row['quantity']* $row5['weight_to_lbs'] . "','" . $row['quantity']. "','".$row5['weight_symbol']."',"
            . "'".$row['price_in_dollar'] * $row['quantity']* $row5['currency_rate_dollar']* $row5['weight_to_lbs']."','".$row5['currency_symbol']."','".$row5['country']."','".$_SESSION['state']."','".$_SESSION['city']."','".$_SESSION['address']."','".$_SESSION['mobile']."')";
        //echo $sql;
    $rs4 = mysql_query($sql, $conn);
        
    $sqlUpdate="update cart set order_placed=1 where id='".$row['id']."'";
    $rs3 = mysql_query($sqlUpdate, $conn);
    
    $sqlUpdate1="update stock set stock_in_lbs=(stock_in_lbs-'".$row['quantity']."') where cat_id='".$row['cat_id']."'";
    $rs2 = mysql_query($sqlUpdate1, $conn);    
        $category = $row['cat_id'];
        
}
if ($rs4 === TRUE) {
     
    $strSQL5 = "SELECT * FROM category where id='" . $category . "'";
     $rs5 = mysql_query($strSQL5);
     $row9 = mysql_fetch_array($rs5);
    ini_set('max_execution_time', 3000);

    require 'mailer/PHPMailerAutoload.php';

    $strSQL2 = "SELECT * FROM emailsendingaddress";
    $rs2 = mysql_query($strSQL2);
    $row2 = mysql_fetch_array($rs2);

   
    $mail = new PHPMailer;
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
//$mail->SMTPDebug = 4;
    $mail->isSMTP();
    $mail->Host = gethostbyname($row2['emailhost']);
    $mail->SMTPAuth = true;
    $mail->Username = trim($row2['senderemail']);
    $mail->Password = trim($row2['emailpassword']);
    $mail->SMTPSecure = 'tls';
    $mail->Port = trim($row2['emailport']);
    $mail->setFrom(trim($row2['senderemail']), 'Online Food Order System');
    $mail->addReplyTo(trim($username), 'Online Food Order System');
    $mail->addAddress($username, $username);  
    $mail->isHTML(true);
    
    $mail->Subject = "Hey...! " . $username. " " . $row9['name'] . " Ordered Successfully";
    $mail->Body = 'Dear ' . $username . ', '
                . '<br>Your Food: ' . $row9['name'] . ' ordered Successfully.
                    <br>Your Order Number : ' . $ordernum . '
					
					<br> Thank You for your order. You can know your order status or change you order by clicking on below links.... <br>
                    <br>Track Status  :<a href="' . $row2['siteurl'] . '/trackStatus.php?order_num=' . $ordernum . '">  Track Status </a><br>
					   
                    <br>Modify Order  :<a href="' . $row2['siteurl'] . '/updateOrder.php?order_num=' . $ordernum . '">  Update Order </a><br>
				   
                    <br>Cancel Order  :<a href="' . $row2['siteurl'] . '/cancelOrderUser.php?order_num=' . $ordernum . '">Cancel Order </a><br>  
                   ';
  
    if (!$mail->send()) {

        $message = $mail->ErrorInfo;
    } else {
        $message = "Mail Sent Successfully";
    }
//    echo $message;exit;
     header('Location: mycart.php?s=1&st=Order Placed Successfully with Order Id='.$ordernum);
}
?>

