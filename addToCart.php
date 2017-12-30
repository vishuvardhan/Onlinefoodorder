<?php
session_start();
include_once 'mysql.php';
if(isset($_POST) && !empty($_POST) && !isset ($_POST['update'])){
    if(isset($_SESSION['userId'])){
       $sql = "INSERT INTO cart (cat_id,quantity,user_id)
VALUES ('" . $_POST["catid"] . "','" . $_POST["quantity"] . "','" . $_SESSION['userId'] . "')";
    }else{
        $sql = "INSERT INTO cart (cat_id,quantity,guest_cookie_id)
VALUES ('" . $_POST["catid"] . "','" . $_POST["quantity"] . "','" . $_COOKIE['guest_id'] . "')";
    }   
//    echo $sql;exit;
        $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
             header('Location: index.php');
        }
}elseif (isset($_POST) && !empty($_POST) && isset ($_POST['update']) && ($_POST['update']=="update")) {
    
    $sql = "update  cart set quantity='" . $_POST["quantity"] . "' where id='".$_POST['cartid']."'";
   
    $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
            if(isset($_POST["order_num"])){
                
                 header('Location: updateOrder.php?order_num='.$_POST["order_num"]);
            }else{
                 header('Location: mycart.php');
            }
            
        }
}

