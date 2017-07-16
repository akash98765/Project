<?php
session_start();
$err='';
$_SESSION['taken']=1;
$_SESSION['error2']=1;
$_SESSION['error1']=0;
?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="dev.css">
  </head>
  <body style="background-color:white;">
    <script src='https://www.google.com/recaptcha/api.js'>
    </script>
    <script>
      function showuser(str){
        if(str.length==0)
        {
          document.getElementById("show").innerHTML="";
          return;
        }
        else{
          var xmlhttp=new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
              document.getElementById("show").innerHTML=this.responseText;
            }
          };
          xmlhttp.open("GET","aj.php?u="+str,true);
          xmlhttp.send();
        }
      }
    </script>
    <?php 
if($_SESSION['error1']==0)
{$err="Invalid credentials";
}
else if($_SESSION['error2']==0)
$err="Invalid Captcha";
if($_SESSION['taken']==0)
$err="Username was already taken";
?>
   
    <br>
    <p>
      <span class="s1">
        <?php echo $err; ?>
      </span>
    </p>
    <br>
    <form method="post" action="verify1.php">
      <fieldset>
        <legend> Personal Info. 
        </legend>
        <p>
          <label for="a">
            UserName:
          </label>
          <input type="text" name="uname"  placeholder="name in letters only" onkeyup="showuser(this.value)" autocomplete="off" required>
          <br>
          <span id="show" style="color:red;">
          </span>
        </p>
        <p>
          <label for="b">
            Email-Address:
          </label>
          <input type="text" name="email"  placeholder="your email..." autocomplete="off" required>
          <br>
        </p>
        <p>
          <label for="c">
            Password:
          </label>
          <input type="password" name="pass"  placeholder="password...." required>
          <br>
        </p>
        <div class="g-recaptcha" data-sitekey="6Lf2RScUAAAAAByxxZtKM2I16VUCwg8jvc-XNDhL">
        </div>
        <input type="submit" value="submit" name="submit">
      </fieldset>
    </form>
  </body>
</html>
