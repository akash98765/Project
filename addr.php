<?php
session_start();
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$seller=$_SESSION['seller'];
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$query="INSERT INTO review(name,paste,seller,product,rating) VALUES (?,?,?,?,?)";
$stmt=mysqli_prepare($dbc,$query);
mysqli_stmt_bind_param($stmt,"ssssd",$_SESSION['uname'],$_POST['field5'],$_SESSION['seller'],$_SESSION['product'],$_POST['rating']);
mysqli_execute($stmt);
header("Refresh:0;url=change.php?seller=$seller");
?>
