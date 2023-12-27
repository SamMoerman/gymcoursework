<?php
try{
    array_map("htmlspecialchars", $_POST);

    include_once("connection.php");
    switch($_POST["role"]){
        case "Pupil":
            $role=0;
            break;
        case "Teacher":
            $role=1;
            break;
    }
    
    if(isset($_POST["forename"]) and isset($_POST["surname"]) and isset($_POST["emailaddress"]) and isset($_POST["passwd"]))
    {
        $hashed_password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usertbl (UserID,Surname,Forename,EmailAddress,Password ,Role)VALUES (null,:surname,:forename,:emailaddress,:password, :role)");

        $stmt->bindParam(':forename', $_POST["forename"]);
        $stmt->bindParam(':surname', $_POST["surname"]);
        $stmt->bindParam(':emailaddress', $_POST["emailaddress"]);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':role', $role);
        $stmt->execute();
    }

    else{
        echo("please enter information for all fields");
    }
}
    catch(PDOException $e)
    {
        echo "error".$e->getMessage();
    }
    $conn=null;

    header('Location: pupils.php')
    
?>