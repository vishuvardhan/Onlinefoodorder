<?php

include_once 'mysql.php';


if (isset($_POST['update']) && $_POST['update'] == "update") {

    if (isset($_FILES["file"]['name']) && !empty($_FILES["file"]['name'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["file"]["name"]);

        $sql = "update category  set name='" . $_POST["name"] . "',type_id='" . $_POST["type_id"] . "',file_name='" . $_FILES["file"]["name"] . "',file_location='" . $target_file . "',description= '" . $_POST["description"] . "',status='" . $_POST["status"] . "',updsatedOn='".date('Y-m-d H:i:s',  time())."',price_in_dollar='" . $_POST["price"] . "' where id='" . $_POST["id"] . "'";
        $rs = mysql_query($sql, $conn);
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    } else {
        $sql = "update category  set name='" . $_POST["name"] . "',type_id='" . $_POST["type_id"] . "',description= '" . $_POST["description"] . "',status='" . $_POST["status"] . "',updsatedOn='".date('Y-m-d H:i:s',  time())."',price_in_dollar='" . $_POST["price"] . "' where id='" . $_POST["id"] . "'";
        $rs = mysql_query($sql, $conn);
    }
} else {
    if (isset($_POST) && !empty($_POST) && isset($_FILES) && !empty($_FILES)) {
        $target_dir = "uploads/";
        $target_file = $target_dir . time() . basename($_FILES["file"]["name"]);

        $sql = "INSERT INTO category (type_id,name,file_name, file_location,description,status,price_in_dollar)
VALUES ('" . $_POST["type_id"] . "','" . $_POST["name"] . "','" . $_FILES["file"]["name"] . "','" . $target_file . "', '" . $_POST["description"] . "','" . $_POST["status"] . "','" . $_POST["price"] . "')";
        $rs = mysql_query($sql, $conn);
  
        move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
    }
}

if ($rs === TRUE) {
    
        if ($_POST['update'] == "update") {
            header('Location: categories.php?s=1&st=Category Updated Succesfully');
        } else {
            header('Location: categories.php?s=1&st=Category Added Succesfully');
        }
    
} else {
    header('Location: addCategory.php?s=0&st=Something Went Wrong while Adding Category');
}







