<?php
 session_start();
 $_SESSION['seller']=$_GET['seller'];
 $_SESSION['product']=$_GET['name'];
 
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="awesome.css">
</head>
<body>
<div class="form-style-2">
<div class="form-style-2-heading">Provide Your Rating</div>
<form action="addr.php" method="post">
<label for="field1"><span>Rating <span class="required">*</span></span><input type="number" class="input-field" name="rating" value="" step=0.1 min=0 max=5.0 required/></label>
<label for="field2"><span>Message:<span class="required">*</span></span><textarea name="field5" class="textarea-field" required></textarea></label>
<label><span>&nbsp;</span><input type="submit" value="Submit" /></label>
</form>
</div>
</body>
</html>

