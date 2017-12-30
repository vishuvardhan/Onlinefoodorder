<?php

include_once 'mysql.php';
if(isset($_GET['id']) && !empty($_GET['id'])){
    $sql = "delete from types where id='" . $_GET["id"] . "'";
        $rs = mysql_query($sql, $conn);
        if ($rs === TRUE) {
            header('Location: types.php?s=1&st=Food Type Deleted Succesfully');
        }else {
            header('Location: types.php?s=0&st=Something Went Wrong while Deleting Food Type');
        }
}else{
    header('Location: types.php?s=0&st=Something Went Wrong while Deleting Food Type');
}
