<?php
$c=0;
session_start();
$servername="localhost";
$username="root";
$password="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$password,$dbname);
$stmt="SELECT * FROM trans";
$result=mysqli_query($dbc,$stmt);
$product="";
$date="";
$seller="";
$stmt="SELECT * FROM review";
$result1=mysqli_query($dbc,$stmt);
$checked=0;
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="casc.css">
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
    <div style="width:100%;position:relative;top:10px;">
      <form>
        Type Your Product:
        <input type="text" size="30" onkeyup="showResult(this.value)">
        <div id="livesearch">
        </div>
      </form>
    </div>
    <table class="t2">
      <tr>
        <th>Product:
        </th>
        <th>Seller:
        </th>
        <th>Date:
        </th>
        <th>Review:
        </th>
      </tr>
      <?php
while($row=mysqli_fetch_assoc($result)){
if($row['name']==$_SESSION['uname']){
$product=$row['product'];
$seller=$row['seller'];
$date=$row['created'];
while($row1=mysqli_fetch_assoc($result1)){
if($row1['seller']==$seller&&$row1['product']==$product){
echo "<tr>
<td>$product</td>
<td>$seller</td>
<td>$date</td>
<td><a href=''><i class='fa fa-check'></i></a></td>
</tr>";
$checked=1;
}
}
mysqli_data_seek($result1,0);
if($checked==0){
echo "<tr>
<td>$product</td>
<td>$seller</td>
<td>$date</td>
<td><a href='review.php?name=$product&seller=$seller'><i class='fa fa-pencil'></i></a></td>
</tr>";
}
}
$checked=0;
}
?>
    </table>
  </body>
</html>
