<?php
session_start();
include_once 'mysql.php';
if(isset($_POST) && !empty($_POST)){
    $_SESSION['conversionId']=$_POST['country'];
    $_SESSION['state']=$_POST['state'];
    $_SESSION['address']=$_POST['address'];
    $_SESSION['mobile']=$_POST['mobile'];
    $_SESSION['city']=$_POST['city'];
     header('Location: checkout2.php');
}

