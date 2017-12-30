<?php

include_once 'mysql.php';

//echo "<pre>";
//print_r($_POST);exit;
if (isset($_POST['update']) && $_POST['update'] == "update") {    
        $sql = "update priceconversion  set country='" . $_POST["country"] . "',currency_rate_dollar= '" . $_POST["currencyrate"] . "',weight_to_lbs='" . $_POST["weight"] . "',currency_symbol= '" . $_POST["currencysymbol"] . "',weight_symbol='" . $_POST["weightsymbol"] . "',updated_on='".date('Y-m-d H:i:s',  time())."' where id='" . $_POST["id"] . "'";
        $rs = mysql_query($sql, $conn);
   
} else {
    if (isset($_POST) && !empty($_POST)) {        

        $sql = "INSERT INTO priceconversion (country,currency_rate_dollar, weight_to_lbs,currency_symbol,weight_symbol)
VALUES ('" . $_POST["country"] . "','" . $_POST["currencyrate"] . "','" . $_POST["weight"] . "','" . $_POST["currencysymbol"] . "','" . $_POST["weightsymbol"] . "')";
        $rs = mysql_query($sql, $conn);
    
        
    }
}

if ($rs === TRUE) {
    
        if ($_POST['update'] == "update") {
            header('Location: prices.php?s=1&st=Stock Updated Succesfully');
        } else {
            header('Location: prices.php?s=1&st=Stock Added Succesfully');
        }
    
} else {
    header('Location: addPrices.php?s=0&st=Something Went Wrong while Adding Category');
}








