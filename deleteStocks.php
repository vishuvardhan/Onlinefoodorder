<?php

include_once 'mysql.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    $sql = "delete from stock where id='" . $_GET["id"] . "'";
        $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
            header('Location: stocks.php?s=1&st=Stock Deleted Succesfully');
        }else {
            header('Location: stocks.php?s=0&st=Something Went Wrong while Deleting Stock');
        }
}else{
    header('Location: stocks.php?s=0&st=Something Went Wrong while Deleting Stock');
}
