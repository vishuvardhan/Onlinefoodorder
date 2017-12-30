<?php
session_start();
include_once 'mysql.php';
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['login']) && ($_POST['login'] == "login")) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $strSQL = "SELECT * FROM administrator where username='" . $username . "'";

    $rs = mysql_query($strSQL);


    while ($row = mysql_fetch_array($rs)) {
        
        if ($row['username'] == $username && $row['password'] == $password) {

             $_SESSION['id'] = $row['id'];
             $_SESSION['username'] = $row['username'];
        }
    }

    if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {

        header("Location: adminHome.php");
        exit();
    } else {
        header('Location: adminLogin.php?s=0&st=Invalid Username/Password');
    }
}

  