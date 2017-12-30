<?php

include_once 'mysql.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    $sql = "delete from priceconversion where id='" . $_GET["id"] . "'";
        $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
            header('Location: prices.php?s=1&st=Category Deleted Succesfully');
        }else {
            header('Location: prices.php?s=0&st=Something Went Wrong while Deleting Category');
        }
}else{
    header('Location: prices.php?s=0&st=Something Went Wrong while Deleting Category');
}
