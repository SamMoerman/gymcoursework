<?php 
//creates and connects to the database
   $servername = 'localhost';
   $username = 'root';
   $password= '';

    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS gymtracker";
    $conn->exec($sql);
    $sql = "USE gymtracker";
    $conn->exec($sql);

    //creates the User table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS UserTbl;
    CREATE TABLE UserTbl 
    (UserID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Forename VARCHAR(20) NOT NULL,
    Surname VARCHAR(20) NOT NULL,
    EmailAddress VARCHAR(50) NOT NULL,
    Password VARCHAR(72) NOT NULL,
    Role TINYINT(1))");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //creates the Pupil does workout table
    $stmt2 = $conn->prepare("DROP TABLE IF EXISTS PplWrktTbl;
    CREATE TABLE PplWrktTbl 
    (WrktID INT(6) NOT NULL,
    UserID INT(6) NOT NULL,
    Datev DATE NOT NULL,
    PRIMARY KEY(WrktID,UserID))");
    $stmt2->execute();
    $stmt2->closeCursor(); 

    //creates the workout table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS WrktTbl;
    CREATE TABLE WrktTbl
    (WrktID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    WorkoutName VARCHAR(30) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //creates the workout has exercise table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS WrktExerciseTbl;
    CREATE TABLE WrktExerciseTbl
    (WrktID INT(6) NOT NULL,
    ExerciseID INT(6) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //creates the exercise table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS ExerciseTbl;
    CREATE TABLE ExerciseTbl
    (ExerciseID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ExerciseName VARCHAR(30) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //creates the pupil does exercise table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS PupilExerciseTbl;
    CREATE TABLE PupilExerciseTbl
    (PDEID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(6) NOT NULL,
    ExerciseID INT(6) NOT NULL,
    Datev DATE NOT NULL,
    Weight DECIMAL(4,1) NOT NULL,
    Reps INT(2) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor();
    
    //creates the classes table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS ClassesTbl;
    CREATE TABLE ClassesTbl
    (ClassID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(6) NOT NULL,
    InstructorID INT(6) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor(); 
    ?>