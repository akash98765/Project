<?php
 session_start();
 $c = $_GET['no'];
 array_splice($_SESSION['cartname'],$c,1);
 array_splice($_SESSION['cartprice'],$c,1);
 array_splice($_SESSION['cartseller'],$c,1);
 array_splice($_SESSION['cartid'],$c,1);
 header("Refresh:0;url=checkout.php");
?>