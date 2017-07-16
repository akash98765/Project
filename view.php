<?php
session_start();
$id="";
$id=$_GET['id'];
$servername="localhost";
$username="root";
$pass="Weiss-2sfj";
$dbname="users";
$dbc=@mysqli_connect($servername,$username,$pass,$dbname);
$stmt="SELECT name,price,id,source,description,author,edition,pages FROM products";
$stmt2="SELECT name,id,quote,rating FROM sellers";
$stmt3="SELECT * FROM review";
$stmt4="SELECT name,id FROM sellers";
$result=mysqli_query($dbc,$stmt);
$result2=mysqli_query($dbc,$stmt2);
$result3=mysqli_query($dbc,$stmt2);
$result4=mysqli_query($dbc,$stmt3);
$result5=mysqli_query($dbc,$stmt4);
$go=$_GET['name'];
$description="";
$author="";
$edition="";
$price=0;
$pages=0;
$seller='';
$priceq=0;
$rating=0;
$dis=$_GET['dis'];
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
    <div id="d2">
      <ul>
        <?php
if($_SESSION['uname']=="")
{echo '<li><a href="signin.php">Sign In</a>';
echo '<li><a href="signup.php">Sign Up</a>';
}
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
    <div align="center">
      <h3 style="font-family:courier;">
        <?php echo $_GET['name']; ?>
      </h3>
    </div>
    <?php
$source="";
while($row=mysqli_fetch_assoc($result)){
if($_GET['id']==$row['id']){
$source=$row['source'];
$description=$row['description'];
$author=$row['author'];
$edition=$row['edition'];
$pages=$row['pages'];
break;
}
}
while($row1=mysqli_fetch_assoc($result2)){
if($_GET['id']==$row1['id']&&$_GET['select']==$row1['name'])
{
$price=$row1['quote'];
break;
}
}
$price=round($price-$price*$_GET['dis']/100);
echo "<div class='d1'><img src=$source height='300' width='250'></img></div>";
?>
    <div>
      <h4 style="font-family:comic sans ms;">Product Description:
      </h4>
      <h5>
        <?php echo $description; ?>
      </h5>
      <br>
    </div>
    <table id="t1">
      <tr>
        <td>Author:
        </td>
        <td>
          <?php echo $author; ?>
        </td>
      </tr>
      <tr>
        <td>Edition:
        </td>
        <td>
          <?php echo $edition; ?>
        </td>
      </tr>
      <tr>
        <td>Price(-
          <?php echo $_GET['dis']."%";?>):
        </td>
        <td>
          <?php echo $price; ?>
        </td>
      </tr>
      <tr>
        <td>Pages:
        </td>
        <td>
          <?php echo $pages; ?>
        </td>
      </tr>
    </table>
    <div>
      <h3>Pick A Seller:(Same discounts)
      </h3>
    </div>
    <table class="t2">
      <tr>
        <th>Name
        </th>
        <th>Price
        </th>
        <th>Rating
        </th>
        <th>Check
        </th>
      </tr>
      <?php
while($row1=mysqli_fetch_assoc($result3)){
if($_GET['id']==$row1['id']){
$seller=$row1['name'];
$priceq=$row1['quote'];
$rating=$row1['rating'];
echo
"<tr>
<td>$seller</td>
<td>$priceq</td>
<td>$rating</td>
<td><a href='view.php?name=$go&dis=$dis&id=$id&select=$seller' class='button'>";
if($seller==$_GET['select'])
echo "<input type='button' value='choosen'>";
else
echo "<input type='button' value='choose'>";
echo"
</a>                        
</td>
</tr>";
}
}
?>
    </table>
    <br>
    <br>
    <br>
    <div style="width:100%">
      <?php
$seller=$_GET['select'];
echo "<div class='get'><a id='a2' href='add.php?name=$go&price=$price&id=$id&select=$seller&type=1'>Buy Now</a></div>";
echo "<div class='get'><a id='a3' href='add.php?name=$go&price=$price&id=$id&select=$seller&type=2'>Add to Cart</a></div>";
?>
    </div>
    <?php
$reviewname="";
$reviewrating=0.0;
$review="";
?>
    <!--<table class="t2">
<tr>
<th>Name:</th>
<th>Rating:</th>
<th>Review:</th>
</tr>
<?php
while($re=mysqli_fetch_assoc($result4)){
$reviewname=$re['name'];
$reviewrating=$re['rating'];
$review=$re['paste'];
if($re['product']==$_GET['name'])
{echo "<tr><td>$reviewname</td><td></td><td>$review</td></tr>";
}
}
?> 
</table>-->
    <br>
    <br>
    <h3>User Reviews:
    </h3>
    <div style="width:100%;position:relative;">
      <?php
mysqli_data_seek($result4,0);
while($re=mysqli_fetch_assoc($result4)){
$reviewname=$re['name'];
$reviewrating=$re['rating'];
$review=$re['paste'];
if($re['product']==$_GET['name']){
echo "<div style='border-bottom:2px solid lightgrey;'>";
echo "<h4 style='font-family:courier;'>$reviewname</h4>";
review($reviewrating);
echo "<br><h5 style='font-family:comic sans ms;'>$review</h5>";
echo "</div>";
}
}
function review($rating)
{if($rating==5.0)
for($c=1;$c<=5;$c++)
echo "<i class='fa fa-star'></i>";
else if($rating>4.0&&$rating<5.0){
for($c=1;$c<=4;$c++)
echo "<i class='fa fa-star'></i>";
echo "<i class='fa fa-star-half'></i>";
}
else if($rating==4.0)
for($c=1;$c<=4;$c++)
echo "<i class='fa fa-star'></i>";
else if($rating>3.0&&$rating<4.0)
{for($c=1;$c<=3;$c++)
echo "<i class='fa fa-star'></i>";
echo "<i class='fa fa-star-half'></i>";
}
else if($rating==3.0)
for($c=1;$c<=3;$c++)
echo "<i class='fa fa-star'></i>";
else if($rating>2.0&&$rating<3.0)
{for($c=1;$c<=2;$c++)
echo "<i class='fa fa-star'></i>";
echo "<i class='fa fa-star-half'></i>";
}
else if($rating==2.0)
for($c=1;$c<=2;$c++)
echo "<i class='fa fa-star'></i>";
else if($rating>1.0&&$rating<2.0)
{echo "<i class='fa fa-star'></i>";
echo "<i class='fa fa-star-half'></i>";
}
else
echo "<i class='fa fa-star'></i>";
}
?> 
    </div>
  </body>
</html>
