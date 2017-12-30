<?php

session_start();
include_once 'mysql.php';
if (isset($_GET['order_num']) && !empty($_GET['order_num'])) {

    $strSQL = "SELECT * FROM orders where order_num='" . $_GET['order_num'] . "'";
    $rs = mysql_query($strSQL);

    while ($row = mysql_fetch_array($rs)) {
        $strSQL1 = "SELECT * FROM category where id='" . $row['cat_id'] . "'";
        $rs1 = mysql_query($strSQL1);
        $row1 = mysql_fetch_array($rs1);
        $strSQL2 = "SELECT * FROM cart where id='" . $row['cart_id'] . "'";
        $rs2 = mysql_query($strSQL2);
        $row2 = mysql_fetch_array($rs2);
        $sql = "update  orders set quantity='" . $row2["quantity"] . "',price='" . $row2["quantity"] * $row1['price_in_dollar'] . "' where order_num='" . $_GET['order_num'] . "' and cart_id='" . $row2['id'] . "'";
        $rs = mysql_query($sql, $conn);
    }
      header('Location: trackStatus.php?s=1&st=order Updated Successfully&order_num='.$_GET["order_num"]);
}

?>