<?php

include_once 'mysql.php';


if (isset($_POST['update']) && $_POST['update'] == "update") {


    $sql = "update types  set type_title='" . $_POST["type_title"] . "' where id='" . $_POST["id"] . "'";
    $rs = mysql_query($sql, $conn);
} else {
    if (isset($_POST) && !empty($_POST)) {

        $sql = "INSERT INTO types (type_title) VALUES ('" . $_POST["type_title"] . "')";
        $rs = mysql_query($sql, $conn);
    }
}

if ($rs === TRUE) {

    if ($_POST['update'] == "update") {
        header('Location: types.php?s=1&st=Food Type Updated Succesfully');
    } else {
        header('Location: types.php?s=1&st=Food Type Added Succesfully');
    }
} else {
    header('Location: addType.php?s=0&st=Something Went Wrong while Adding Food Type');
}







