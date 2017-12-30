<?php

session_start();
include_once 'mysql.php';
if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['register']) && ($_POST['register'] == "register")) {

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query
    $strSQL = "SELECT * FROM user where username='" . $username . "'";
    $rs = mysql_query($strSQL);
    if (mysql_num_rows($rs) > 0) {
        header('Location: userLogin.php?s=1&st=Email is Already Registerd with Us..');
    } else {

        $sql = "INSERT INTO user (username,password)
                                    VALUES ('" . $_POST["username"] . "','" . md5($_POST["password"]) . "')";
        $rs2 = mysql_query($sql, $conn);

        if ($rs2 === TRUE) {
            $strSQL1 = "SELECT * FROM user where username='" . $username . "'";
            $rs1 = mysql_query($strSQL1);
            while ($row1 = mysql_fetch_array($rs1)) {
                if ($row1['username'] == $username && $row1['password'] == $password) {
                    $_SESSION['userId'] = $row1['id'];
                    $_SESSION['username'] = $row1['username'];
                }
            }

            header("Location: index.php");
            exit();
        } else {
            header('Location: userLogin.php?s=1&st=Something Went wrong.Please Try Later.');
        }
    }
}
?>

<?php

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['login']) && ($_POST['login'] == "login")) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query
    $strSQL = "SELECT * FROM user where username='" . $username . "'";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysql_query($strSQL);

    // Loop the recordset $rs
    // Each row will be made into an array ($row) using mysql_fetch_array
    while ($row = mysql_fetch_array($rs)) {
        if ($row['username'] == $username && $row['password'] == $password) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['username'] = $row['username'];
        }
    }

    if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
//        echo $_SESSION['userId'];exit;
        header("Location: index.php");
        exit();
    } else {
        header('Location: userLogin.php?s=0&st=Invalid Username/Password');
    }
}

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['checkout']) && ($_POST['checkout'] == "checkout")) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // SQL query
    $strSQL = "SELECT * FROM user where username='" . $username . "'";

    // Execute the query (the recordset $rs contains the result)
    $rs = mysql_query($strSQL);

    // Loop the recordset $rs
    // Each row will be made into an array ($row) using mysql_fetch_array
    while ($row = mysql_fetch_array($rs)) {
        if ($row['username'] == $username && $row['password'] == $password) {
            $_SESSION['userId'] = $row['id'];
            $_SESSION['username'] = $row['username'];
        }
    }

    if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
        
        $sql = "update cart  set user_id='" . $_SESSION['userId'] . "' where guest_cookie_id='" . $_COOKIE['guest_id'] . "'";
        $rs = mysql_query($sql, $conn);
        
//        echo $_SESSION['userId'];exit;
        header('Location: checkout2.php');
        exit();
    } else {
        header('Location: userLogin.php?s=0&st=Invalid Username/Password');
    }
}
?>
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
?>