<?php
    include('../db.php');
    $date = date('Y.m.d');
    $email = $_POST['subscribe_btn'];
    pg_query($con, "insert into subscribers (email, date) values ('$email', '$date')");
    pg_close($con);
    echo "<script>window.history.go(-1);</script>
    <script>alert('Thank you for subscribing');</script>";
?>