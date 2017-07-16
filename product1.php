<?php
session_start();
$servername="localhost";
$user="root";
$pass="Weiss-2sfj";
$dbname="users";
$dbc=mysqli_connect($servername,$user,$pass,$dbname);
$stmt="SELECT name,price,id,source FROM games";
$result=mysqli_query($dbc,$stmt);
$id='';
$source='';
$price=0;
$discount=0;
$value=0;
$seller="Always there";
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script>
      function showResult(str) {
        if (str.length==0) {
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
          return;
        }
        if (window.XMLHttpRequest) {
          xmlhttp=new XMLHttpRequest();
        }
        xmlhttp.onreadystatechange=function() {
          if (this.readyState==4 && this.status==200) {
            document.getElementById("livesearch").innerHTML=this.responseText;
            document.getElementById("livesearch").style.border="1px solid #A5ACB2";
          }
        }
        xmlhttp.open("GET","livesearch.php?q="+str,true);
        xmlhttp.send();
      }
    </script>
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <body>
    <div id="d2">
      <ul>
        <?php
if($_SESSION['uname']==''){echo '
<li><a href="signin.php">Sign In</a>
<li><a href="signup.php">Sign Up</a>
';
}
else
echo '<li><a href="signout.php">Sign Out</a></li>';
?>
        <li>
          <a href="query.php">Query
          </a>
        <li>
          <a href="checkout.php">Your Cart-
            <?php
echo sizeof($_SESSION['cartname']);
?>
          </a>
        </li>
        <?php
if($_SESSION['uname']!='')
echo
"
<li><a href='trans.php'>Order History</a></li>
";
?>
      </ul>
    </div>
    <div style="width:100%;position:relative;top:10px;">
      <form>
        Type Your Product:
        <input type="text" size="30" onkeyup="showResult(this.value)">
        <div id="livesearch">
        </div>
      </form>
    </div>
    <div style="width:100%;">
      <?php
while($row=mysqli_fetch_assoc($result)){
$discount=rand(30,40);
$id=$row["id"];
$name=$row["name"];
$source=$row["source"];
$price=$row["price"];
$value=$price-$price*$discount/100;
$value=round($value);
echo "<div class='d1'>
<a href='view1.php?name=$name&dis=$discount&id=$id&select=$seller'>
<img src=$source></img></a><p>$name</p>
<p>Rs:<del>$price</del><span style='color:red'>-$discount%</span></p>
<p>Rs:<mark>$value</mark></p>
</div>";
}
?>
    </div>
  </body>
</html>
