<?php
 $servername="localhost";
 $username="root";
 $password="Weiss-2sfj";
 $dbname="users";
 $cumulative=0.0;
 $times=0;
 $seller=$_GET['seller'];
 $dbc=@mysqli_connect($servername,$username,$password,$dbname);
 $stmt="SELECT * FROM review";
 $query="UPDATE sellers SET rating=? WHERE name=?";
 $query1="UPDATE sellerg SET rating=? WHERE name=?";
 $result=mysqli_query($dbc,$stmt);
 $stmt2=mysqli_prepare($dbc,$query);
 $stmt3=mysqli_prepare($dbc,$query1);
 while($row=mysqli_fetch_assoc($result)){
if($row['seller']==$seller)
{$cumulative+=$row['rating'];
 
 ++$times;
}
}
if($times!=0){
$cumulative/=$times;
mysqli_stmt_bind_param($stmt2,"ds",$cumulative,$_GET['seller']);
mysqli_execute($stmt2);
mysqli_stmt_bind_param($stmt3,"ds",$cumulative,$_GET['seller']);
mysqli_execute($stmt3);
header("Refresh:0;special.php");
}
?> 