<?php

include_once 'mysql.php';
if (isset($_POST) && !empty($_POST)) {

    $sql = "INSERT INTO contactus (name,email,mobile,subject,message)
VALUES ('" . $_POST["name"] . "','" . $_POST["email"] . "','" . $_POST["mobile"] . "','" . $_POST["subject"] . "','" . $_POST["message"] . "')";
    $rs = mysql_query($sql, $conn);

    if ($rs === TRUE) {
        header('Location: contactus.php?s=1&st=Query Posted Succesfully');
    } else {
        header('Location: contactus.php?s=0&st=Something Went Wrong while Posting Query');
    }
} else {
    header('Location: contactus.php?s=0&st=Something Went Wrong while Posting Query');
}

