<?php
session_start();
array_push($_SESSION['cartname'],$_GET['name']);
array_push($_SESSION['cartid'],$_GET['id']);
array_push($_SESSION['cartseller'],$_GET['select']);
array_push($_SESSION['cartprice'],$_GET['price']);
echo $_SESSION['cartseller'][0];
if($_GET['type']==2&&$_SESSION['uname']!="")
header("Refresh:0;url=special.php");
else if($_GET['type']==2&&$_SESSION['uname']=="")
header("Refresh:0;url=welcome.php");
else
header("Refresh:0;url=buy.php");
?>
