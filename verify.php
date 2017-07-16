<?php

session_start();

$uname=$pass=$cap="";

$username="root";

$servername="localhost";

$password="Weiss-2sfj";

$dbname="users";

$dbc=@mysqli_connect($servername,$username,$password,$dbname);

$sql="SELECT username,password FROM userlog";

$result=mysqli_query($dbc,$sql);

if(isset($_POST['submit'])&& !empty($_POST['submit']))
{
$uname=!empty($_POST['uname'])?$_POST['uname']:'';

$pass=!empty($_POST['pass'])?$_POST['pass']:'';



}


while($row=mysqli_fetch_assoc($result))
{

if($uname==$row['username'] && $pass==$row['password'])

{$_SESSION['uname']=$uname;

$_SESSION['pass']=$pass;

$_SESSION['error']=1;

break;

}

}

if($_SESSION['error']==1)

header("Refresh:0;url=special.php?user=$uname");

else

header("Refresh:0;url=signin.php");

?>
