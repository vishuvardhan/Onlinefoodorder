<?php
session_start();
include_once 'mysql.php';
include_once 'headeradmin.php';
?>

    <div class="main-content">
        <div id="page-wrapper">
            <div class="main-page login-page " style="width: 30%;">
                <h3 class="title1">SignIn Page</h3>
                <div class="widget-shadow">
                    <div class="login-top">
                        <h4>Welcome to AdminPanel !</h4>
                    </div>
                    <div class="login-body">
                        <form method="POST">
                            <input type="text" class="user" name="username" placeholder="Enter your Username" required="">
                            <input type="password" name="password" class="lock" placeholder="password">
                            <input type="submit" name="Sign In" value="Sign In">
                            <div class="forgot-grid">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Remember me</label>

                                <div class="clearfix"> </div>
                            </div>
                            <?php
                            if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                                $username = $_POST['username'];
                                $password = md5($_POST['password']);
                                
                                // SQL query
                                $strSQL = "SELECT * FROM administrator where username='" . $username . "'";

                                // Execute the query (the recordset $rs contains the result)
                                $rs = mysql_query($strSQL);

                                // Loop the recordset $rs
                                // Each row will be made into an array ($row) using mysql_fetch_array
                                while ($row = mysql_fetch_array($rs)) {
                                    if ($row['username'] == $username && $row['password'] == $password) {
                                        $_SESSION['id'] = $row['id'];
                                        $_SESSION['username'] = $row['username'];
                                    }
                                }
                                mysql_close();
                                if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                                    header("Location: adminHome.php");
                                    exit();
                                } else {
                                    echo '<label for="fname" style="color:red;" class="error">Invalid Username/Password.</label>';
                                }
                            }else {
                                    echo '<label for="fname" style="color:red;" class="error">Please Enter login details.</label>';
                                }
                            ?>
                        </form>
                    </div>
                </div>                
            </div>
        </div>

    </div>

    <?php include_once 'footeradmin.php'; ?>