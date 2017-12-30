<?php

include_once 'mysql.php';
if (isset($_POST) && !empty($_POST)) {
//echo "<pre>";
//print_r($_POST);
//    exit;
     $sql = "INSERT INTO feedback (order_num,comment,commented_by)
VALUES ('" . $_POST["order_num"] . "','" . $_POST["comment"] . "','" . $_POST["commented_by"] . "')";
//    echo $sql;exit;
    $rs = mysql_query($sql, $conn);

    if ($rs === TRUE) {
        header('Location: feedbackUser.php?s=1&st=Feed Back Updated Succesfully&order_num='.$_POST["order_num"]);
    } else {
        header('Location: feedbackUser.php?s=0&st=Something Went Wrong while Updating Status&order_num='.$_POST["order_num"]);
    }
} else {
    header('Location: feedbackUser.php?s=0&st=Something Went Wrong while Updating Status&order_num='.$_POST["order_num"]);
}

