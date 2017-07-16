<?php
session_start();
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="unifi.css">
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
  <body style="background-color:white;">
    <p style="color:red;">Welcome 
      <span style="color:blue;">
        <?php echo $_SESSION['uname']; ?>
      </span>!
    </p>
    <div id="d2">
      <ul>
        <li>
          <a href="signout.php">Sign Out
          </a>
        <li>
          <a href="trans.php">Order History
          </a>
        </li>
        <li>
          <a href="query.php">Query
          </a>
        <li>
          <a href="checkout.php">Your Cart-
            <?php
echo sizeof($_SESSION['cartname']);?>
          </a>
        </li>
      </ul>
    </div>
    <div style="width:100%;position:relative;top:60px;">
      <form>
        Type Your Product:
        <input type="text" size="30" onkeyup="showResult(this.value)">
        <div id="livesearch">
        </div>
      </form>
    </div>
    <div style="position:relative;top:80px;width:100%;">
      <h2 style="color:blue;">Deals Of The Day!
      </h2>
      <div style="margin:1%;float:left;">
        <a href="product.php">
          <img src="book1.jpg" height="200" width="150">
          </img>
        <h3>Upto 70% off on Books
        </h3>
        </a>
    </div>
    <div style="margin:1%;float:left;">
      <a href="">
        <img src="game2.jpg" height="200" width="150">
        </img>
      <h3>Upto 40% off on Games
      </h3>
      </a>
    </div>
  </div>
</body>
</html>
