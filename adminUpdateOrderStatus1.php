<?php

include_once 'mysql.php';
if (isset($_POST) && !empty($_POST)) {

//print_r($_POST);
    
     $sql = "INSERT INTO orderstatus (order_num,place_of_item,time_required_min,order_status)
VALUES ('" . $_POST["ordernum"] . "','" . $_POST["place"] . "','" . $_POST["time_required_min"] . "','" . $_POST["order_status"] . "')";
//    echo $sql;exit;
    $rs = mysql_query($sql, $conn);

    if ($rs === TRUE) {
        header('Location: adminUpdateOrderStatus.php?s=1&st=Status Updated Succesfully&order_num='.$_POST["ordernum"]);
    } else {
        header('Location: adminUpdateOrderStatus.php?s=0&st=Something Went Wrong while Updating Status&order_num='.$_POST["ordernum"]);
    }
} else {
    header('Location: adminUpdateOrderStatus.php?s=0&st=Something Went Wrong while Updating Status&order_num='.$_POST["ordernum"]);
}

