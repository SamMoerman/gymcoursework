<?php
/* try{
    array_map("htmlspecialchars", $_POST);

    include_once("connection.php");
    switch($_POST["role"]){
        case "Pupil":
            $role=0;
            break;
        case "Teacher":
            $role=1;
            break;
        case "Admin":
            $role=2;
            break;
    }
    $hashed_password = password_hash($_POST["passwd"], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO pupilstbl (UserID,Surname,Forename,Password,Year, Balance ,Role)VALUES (null,:surname,:forename,:password,:year, :balance, :role)");

    $stmt->bindParam(':forename', $_POST["forename"]);
    $stmt->bindParam(':surname', $_POST["surname"]);
    $stmt->bindParam(':year', $_POST["year"]);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':balance', $_POST["Balance"]);
    $stmt->bindParam(':role', $role);
    $stmt->execute();
    }
catch(PDOException $e)
{
    echo "error".$e->getMessage();
}
$conn=null;

header('Location: pupils.php')
 */

?>