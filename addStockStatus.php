<?php

include_once 'mysql.php';

//echo "<pre>";
//print_r($_POST);exit;
if (isset($_POST['update']) && $_POST['update'] == "update") {    
        $sql = "update stock  set cat_id='" . $_POST["category"] . "',stock_in_lbs= '" . $_POST["stock"] . "',added_by='" . $_POST["addedby"] . "',updated_on='".date('Y-m-d H:i:s',  time())."' where id='" . $_POST["id"] . "'";
        $rs = mysql_query($sql, $conn);
   
} else {
    if (isset($_POST) && !empty($_POST)) {        

        $sql = "INSERT INTO stock (cat_id,stock_in_lbs, added_by)
VALUES ('" . $_POST["category"] . "','" . $_POST["stock"] . "','" . $_POST["addedby"] . "')";
        $rs = mysql_query($sql, $conn);
    
        
    }
}

if ($rs === TRUE) {
    
        if ($_POST['update'] == "update") {
            header('Location: stocks.php?s=1&st=Stock Updated Succesfully');
        } else {
            header('Location: stocks.php?s=1&st=Stock Added Succesfully');
        }
    
} else {
    header('Location: addStock.php?s=0&st=Something Went Wrong while Adding Category');
}







