<!DOCTYPE html>
<html>
<head>  
   <title>Login</title>
</head>
<body>
<!-- creates login form -->
<form action="loginprocess.php" method= "POST">
 User name (email address):<input type="text" name="Username"><br>
 Password:<input type="password" name="Pword"><br>
<input type="submit" value="Login">
</form>

</body>
</html>
<?php
echo("<br><a href='menu.php'><button type='button'>Back</button></a>");
?>