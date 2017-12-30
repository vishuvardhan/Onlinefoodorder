
<?php
include_once 'mysql.php';
if (isset($_SESSION['userId'])) {
    $strSQL = "SELECT count(id) as count FROM cart where user_id='" . $_SESSION['userId'] . "' and order_placed=0";
} else {
    $strSQL = "SELECT count(id) as count FROM cart where guest_cookie_id='" . $_COOKIE['guest_id'] . "' and order_placed=0";
}
$rs = mysql_query($strSQL);
$row = mysql_fetch_array($rs);
?>
<div class="header-v5 header-static" style="margin-bottom: 100px;">
    <!-- Topbar v3 -->
    <div class="topbar-v3">
        <div class="search-open">
            <div class="container">
                <form action="search.php" method="post">
                    <input type="text" class="form-control" placeholder="Search" name="searchtext" id="searchtext">
                    <div class="search-close"><i class="icon-close"></i></div>
                </form>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- Topbar Navigation -->
                    <ul class="left-topbar">
                       <li>
                            <a></a>
                            <ul class="currency">
                                <li class="active">
                                    <a href="#">USD <i class="fa fa-check"></i></a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a><span class="fa fa-phone"></span> +1 816-726-6442</a>
                            <ul class="language">
                                <li class="active">
                                    <a href="#">Call Us <i class="fa fa-check"></i></a>
                                </li>

                            </ul>
                        </li> 
                    </ul><!--/end left-topbar-->
                </div>
                <div class="col-sm-6">
                    <ul class="list-inline right-topbar pull-right">
                        <?php if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) { ?>
                            <li><a href="userDashboard.php">My Account</a></li>
                        <?php } else { ?>
                            <li><a href="userLogin.php">My Account</a></li>
                        <?php } ?> 

                        <li><a href="mycart.php">My Cart(<?php echo $row['count']; ?>)</a></li>
                        <li><a href="checkout1.php">Checkout</a></li>
                        <?php if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) { ?>
                            <li><a href="logout.php">Logout</a></li>

                        <?php } else { ?>
                            <li><a href="userLogin.php">Login |Register</a></li>

                        <?php } ?> 

                        <li><i class="search fa fa-search search-button"></i></li>
                    </ul>
                </div>
            </div>
        </div><!--/container-->
    </div>
    <!-- End Topbar v3 -->

    <!-- Navbar -->
    <div class="navbar navbar-default mega-menu" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="padding-top: 10px;">
                    <img id="logo-header" src="ECommerce/assets/img/logogyro.jpg" alt="Logo">
                </a>
            </div>

            <!-- Shopping Cart -->
            <div class="shop-badge badge-icons pull-right">
                <a href="mycart.php"><i class="fa fa-shopping-cart"></i></a>
                <span class="badge badge-sea rounded-x"><?php echo $row['count']; ?></span>

            </div>
            <!-- End Shopping Cart -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-responsive-collapse">
                <!-- Nav Menu -->
                <ul class="nav navbar-nav">

                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                   
                    <?php if (!isset($_SESSION['userId'])) { ?>
                        <li class="pull-right" ><a href="adminLogin.php">login as admin</a></li> 
                        <?php } ?>
                    <li class="pull-right"><a href="contactus.php">Contact Us</a></li>
                    <li class="pull-right"><a href="trackStatus.php">Track Status</a></li>
                    


                </ul>
                <!-- End Nav Menu -->
            </div>
        </div>
    </div>
    <!-- End Navbar -->
</div>