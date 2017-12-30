<?php

include_once 'mysql.php';
if (isset($_GET['order_num']) && !empty($_GET['order_num'])) {

    $strSQL1 = "SELECT * FROM orderstatus as os LEFT JOIN orders as o on o.order_num=os.order_num where os.order_num='" . $_GET['order_num'] . "' order by os.updated_on DESC LIMIT 1";
    $rs1 = mysql_query($strSQL1);
    $row1 = mysql_fetch_array($rs1);
    if (isset($row1['order_status']) && !empty($row1['order_status']) && $row1['order_status'] == "Delivered") {
         header('Location: trackStatus.php?s=0&st=Your Order already delivered. You can not Cancel this time.&order_num='.$_GET['order_num']);
    } else {
        $sql = "delete from orders where order_num='" . $_GET["order_num"] . "'";
        $rs = mysql_query($sql, $conn);
        if (isset($_SESSION['userId'])) {
            if ($rs === TRUE) {
                header('Location: userDashboard.php?s=1&st=Order Cancelled Succesfully');
            } else {
                header('Location: userDashboard.php?s=0&st=Something Went Wrong while Cancelling Order ');
            }
        } else {
            if ($rs === TRUE) {
                header('Location: mycart.php?s=1&st=Order Cancelled Succesfully');
            } else {
                header('Location: mycart.php?s=0&st=Something Went Wrong while Cancelling Order ');
            }
        }
    }
} else {
    header('Location: mycart.php?s=0&st=Something Went Wrong while Cancelling Order');
}

