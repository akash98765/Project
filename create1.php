<?php
 $arr[0]='game1.jpg';
 $arr[1]='game2.jpg';
 $arr[2]='game3.jpg';
 $arr[3]='game4.jpg';
 $brr[0]='Digifo';
 $brr[1]='Dodgyfo';
 $brr[2]='Always there';
 $name[0]='GTA V-CD';
 $name[1]='Witcher 3-CD';
 $name[2]='Titanfall 2-CD';
 $name[3]='Battlefield 1-CD';
 $servername="localhost";
 $username="root";
 $pass="Weiss-2sfj";
 $dbname="users";
 $copies=20;
 $platform=20;
 $rating=5.0;
 $dbc=@mysqli_connect($servername,$username,$pass,$dbname);
 $query="INSERT INTO games (name,price,id,source,category,platform,copies) VALUES (?,?,?,?,?,?,?)";
 $query1="INSERT INTO sellerg (name,quote,id,copies,rating) VALUES (?,?,?,?,?)";
 $d=100;
 $stmt=mysqli_prepare($dbc,$query);
 $stmt1=mysqli_prepare($dbc,$query1);
 $c=-1;
 $price=0;
 $price1=0;
 $d=0;
 $id='';
 $cat="games,game,pcgames,gaming,pc";
 while(++$c<4){
 $price=rand(1600,2500);
 $id=uniqid();
 mysqli_stmt_bind_param($stmt,"sisssss",$name[$c],$price,$id,$arr[$c],$cat,$platform,$copies);
 mysqli_execute($stmt);
 if($c<4){
while($d<3){
$price1=rand(1600,2500);
if($d==2){
mysqli_stmt_bind_param($stmt1,"sisss",$brr[$d],$price,$id,$copies,$rating);
mysqli_execute($stmt1);
}else{
mysqli_stmt_bind_param($stmt1,"sisss",$brr[$d],$price1,$id,$copies,$rating);
mysqli_execute($stmt1);
}
++$d;
}

}
$d=0;
}
 ?>