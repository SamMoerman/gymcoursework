<?php
session_start(); 
?>
<!DOCTYPE html>
<html>
<head>

    <title>Page title</title>

</head>
<body>
       
<form action="createaccount.php" method = "post">
  First name:<input type="text" name="forename"><br>
  Last name:<input type="text" name="surname"><br>
  Email Address:<input type="text" name="emailaddress"><br>
  Password:<input type="password" name="passwd"><br>
  <!--Next 2 lines create a radio button which we can use to select the user role-->
  <input type="radio" name="role" value="Pupil" checked> Pupil<br>
  <input type="radio" name="role" value="Teacher"> Teacher<br>
  <input type="submit" value="Add User">
</form>

<?php
include_once('connection.php');
$stmt = $conn->prepare("SELECT * FROM usertbl");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
echo($row["Forename"].' '.$row["Surname"]."<br>");
}
echo("<br><a href='menu.php'><button type='button'>Back</button></a>");
?>
</body>
</html>