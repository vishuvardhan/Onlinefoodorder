<!DOCTYPE html>
<?php
include_once 'mysql.php';

if (!isset($_COOKIE["guest_id"])) {
    
    $strSQL = "SELECT max(id) as val FROM cart";
    $rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    if (mysql_num_rows($rs) == 1) {
        $num = rand(12345, 12345678);
        setcookie('guest_id', $num, time() + (86400 * 30 * 30), false);
        $_COOKIE['guest_id'] = $num;
    } else {
        setcookie('guest_id', $row['val'], time() + (86400 * 30 * 30), false);
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
        setcookie('guest_id', $row['val'], time() + (86400 * 30 * 30), false);
        $_COOKIE['guest_id'] = $row['val'];
    }
}

?>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<title>Online Food Order System</title>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Favicon -->
	<link rel="shortcut icon" href="favicon.ico">

	<!-- Web Fonts -->
	<link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,800&amp;subset=cyrillic,latin'>

	<!-- CSS Global Compulsory -->
        <link rel="stylesheet" href="ECommerce/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="ECommerce/assets/css/shop.style.css">

	<!-- CSS Header and Footer -->
	<link rel="stylesheet" href="ECommerce/assets/css/headers/header-v5.css">
	<link rel="stylesheet" href="ECommerce/assets/css/footers/footer-v4.css">

	<!-- CSS Implementing Plugins -->
	<link rel="stylesheet" href="ECommerce/assets/plugins/animate.css">
	<link rel="stylesheet" href="ECommerce/assets/plugins/line-icons/line-icons.css">
	<link rel="stylesheet" href="ECommerce/assets/plugins/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="ECommerce/assets/plugins/scrollbar/css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="ECommerce/assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="ECommerce/assets/plugins/revolution-slider/rs-plugin/css/settings.css">
<link href="user/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

        <!-- Main style sheet -->
        <link href="user/css/style.css" rel="stylesheet">   
	<!-- CSS Theme -->
	<link rel="stylesheet" href="ECommerce/assets/css/theme-colors/default.css" id="style_color">

	<!-- CSS Customization -->
	<link rel="stylesheet" href="ECommerce/assets/css/custom.css">
</head>
<body class="header-fixed">