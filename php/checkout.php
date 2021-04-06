<?php
    session_start();
    include('../db.php');
    $productCodeList = [];
    $productQuantityList = [];
    $email = $_POST['checkout__btn'];
    foreach ($_SESSION["shopping_cart"] as $product){
        array_push($productCodeList, $product["code"]);
        array_push($productQuantityList, $product["quantity"]);
    }
    $productCodeListString = implode("\", \"",$productCodeList);
    $productQuantityListString = implode("\", \"",$productQuantityList);

    if (isset($_POST['shipping'])) {
        pg_query($con, "insert into orders (productCodes, productQuantities, email, shipping) values ('{\"$productCodeListString\"}', '{\"$productQuantityListString\"}', '$email', true)");
    } else {
        pg_query($con, "insert into orders (productCodes, productQuantities, email, shipping) values ('{\"$productCodeListString\"}', '{\"$productQuantityListString\"}', '$email', false)");
    }
    pg_close($con);
    echo "<script>window.history.go(-1);</script>
    <script>alert('We're working on your order');</script>";
?>