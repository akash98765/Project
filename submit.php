<?php
session_start();
$user="root";
$text="";
$pass="Weiss-2sfj";
$dbname="users";
$uname=$_POST['name'];
$servername="localhost";
$dbc=@mysqli_connect($servername,$user,$pass,$dbname);
$query="INSERT into query (query,user) VALUES (?,?)";
$stmt=mysqli_prepare($dbc,$query);
if($_POST['text']=="")
{echo "Empty query, you are being redirected.....";
header("Refresh:2;url=query.php");
}
else
{echo "Query submitted.Redirecting...";
$text=$_POST['text'];
mysqli_stmt_bind_param($stmt,"ss",$text,$uname);
mysqli_execute($stmt);
if($_SESSION['uname']=="") 
header("Refresh:2;url=welcome.php");
else
header("Refresh:2;url=special.php");
}
?>
