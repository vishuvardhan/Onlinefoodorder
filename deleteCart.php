<?php

include_once 'mysql.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    $sql = "delete from cart where id='" . $_GET["id"] . "'";
        $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
            header('Location: mycart.php?s=1&st=Item Removed Succesfully');
        }else {
            header('Location: mycart.php?s=0&st=Something Went Wrong while Deleting Cart');
        }
}else{
    header('Location: mycart.php?s=0&st=Something Went Wrong while Deleting Cart');
}
