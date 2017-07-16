<?php
session_start();
$c=0;
$name="";
$price=0;
$seller="";
$sum=0;
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="check.css">
  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
  <body>
    <div id="d2">
      <ul>
        <li>
          <a href="signup.php">Sign Up
          </a>
        <li>
          <a href="query.php">Query
          </a>
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
    <table id="t2">
      <tr>
        <th>Name
        </th>
        <th>Price
        </th>
        <th>Seller
        </th>
        <th>Remove
        </th>
      </tr>
      <?php
while($c<sizeof($_SESSION['cartname'])){
$name=$_SESSION['cartname'][$c];
$price=$_SESSION['cartprice'][$c];
$sum+=$price;
$seller=$_SESSION['cartseller'][$c]; 
echo
"<tr>
<td>$name</td>
<td>$price</td>
<td>$seller</td>
<td><a href='remove.php?no=$c'><i class='fa fa-close'></i></a>                        
</td>
</tr>";
++$c;
}
?>
    </table>
    <?php
echo "Total:".$sum;
if($sum!=0)
echo '<br>
<a id="buy" href="buy.php">Buy Now</a>';
?>
  </body>
</html>
