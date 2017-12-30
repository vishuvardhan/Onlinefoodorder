<!DOCTYPE html>
<?php
include_once 'mysql.php';

if (!isset($_COOKIE["guest_id"])) {
    
    $strSQL = "SELECT max(id) as val FROM cart";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    if (mysql_num_rows($rs) == 1) {
        $num = rand(12345, 12345678);
        setcookie('guest_id', $num, time() + (86400 * 30 ), false);
        $_COOKIE['guest_id'] = $num;
    } else {
        setcookie('guest_id', $row['val'], time() + (86400 * 30 ), false);
        $_COOKIE['guest_id'] = $row['val'];
    }
} else {
    $strSQL = "SELECT count(id) as count FROM cart where guest_cookie_id='" . $_COOKIE["guest_id"] . "' and order_placed=0";
    $rs = mysql_query($strSQL);
    if (mysql_num_rows($rs) == 0) {
        $strSQL = "SELECT max(id)+1 as val FROM cart";
        $rs = mysql_query($strSQL);
        $row = mysql_fetch_array($rs);
        $cookie_name = "guest_id";
        $cookie_value = $row['val'];
        setcookie('guest_id', $row['val'], time() + (86400 * 30 ), false);
        $_COOKIE['guest_id'] = $row['val'];
    }
}

?>


<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">    
        <title>Online Food Order System</title>

        <!-- Font awesome -->
        <link href="user/css/font-awesome.css" rel="stylesheet">
        <!-- Bootstrap -->
        <link href="user/css/bootstrap.css" rel="stylesheet">   
        <!-- SmartMenus jQuery Bootstrap Addon CSS -->
        <link href="user/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
        <!-- Product view slider -->
        <link rel="stylesheet" type="text/css" href="user/css/jquery.simpleLens.css">    
        <!-- slick slider -->
        <link rel="stylesheet" type="text/css" href="user/css/slick.css">
        <!-- price picker slider -->
        <link rel="stylesheet" type="text/css" href="user/css/nouislider.css">
        <!-- Theme color -->
        <link id="switcher" href="user/css/theme-color/red-theme.css" rel="stylesheet">
        <!-- <link id="switcher" href="user/css/theme-color/bridge-theme.css" rel="stylesheet"> -->
        <!-- Top Slider CSS -->
        <link href="user/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

        <!-- Main style sheet -->
        <link href="user/css/style.css" rel="stylesheet">    

        <!-- Google Font -->
        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>


        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->


    </head>
    <body> 