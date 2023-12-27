<?php
session_start(); 

include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
$stmt = $conn->prepare("SELECT * FROM usertbl WHERE surname =:username ;" );  // selects the user who is trying to log in from the database
$stmt->bindParam(':username', $_POST['Username']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    // checks that the inputted password is the same as the hashed password in the database
    $hashed= $row['Password'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt,$hashed)){
        echo("eefdbhjbch");
        $_SESSION['loggedinuser']=$row["UserID"];
        $_SESSION['userrole']=$row["Role"];
  
        if (!isset($_SESSION['backURL'])){
            $backURL= "menu.php";  //Sets a default destination if no BackURL set (parent dir)
        }else{
            $backURL=$_SESSION['backURL'];
        }
        unset($_SESSION['backURL']);  //if the password is correct send them back to the menu
        header('Location: ' . $backURL);
    }else{
        //header('Location: login.php');  //if the password is not correct send them back to the login page to try again

    }

}
$conn=null;
?>