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
    PRIMARY KEY(WrktID,UserID,Datev))");
    $stmt2->execute();
    $stmt2->closeCursor(); 

    //creates the workout table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS WrktTbl;
    CREATE TABLE WrktTbl
    (WrktID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    WrktName VARCHAR(30) NOT NULL,
    UserID INT(6) NOT NULL)");
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
    ExerciseName VARCHAR(30) NOT NULL,
    ExerciseImage VARCHAR(255) NOT NULL,
    ExerciseTarget VARCHAR(30) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //creates the pupil does exercise table
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS PupilExerciseTbl;
    CREATE TABLE PupilExerciseTbl
    (PDEID INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    UserID INT(6) NOT NULL,
    ExerciseID INT(6) NOT NULL,
    Datev DATE NOT NULL,
    Weightv DECIMAL(4,1) NOT NULL,
    Reps INT(2) NOT NULL)");
    $stmt1->execute();
    $stmt1->closeCursor();
    
    //sets up default users test data
    $hashed_password = password_hash("password", PASSWORD_DEFAULT);
    $stmt1 = $conn->prepare("INSERT INTO UserTbl(UserID,Forename,Surname,emailaddress,Password,Role)VALUES 
    (NULL,'Sam','Moerman','sm@google.com',:hp,1),
    (NULL,'Joe','Ren','jr@google.com',:hp,1),
    (NULL,'William','Ma','wm@google.com',:hp,0),
    (NULL,'Egor','Drygin','ed@google.com',:hp,0),
    (NULL,'George','Gurney','gg@google.com',:hp,0)
    ");
    $stmt1->bindParam(':hp', $hashed_password);
    $stmt1->execute();
    $stmt1->closeCursor(); 

    //sets up pupil does workout table test data
    $stmt1 = $conn->prepare("INSERT INTO PplWrktTbl(UserID,WrktID,Datev)VALUES
    (1,1,now()),
    (1,2,now()),
    (2,1,now()),
    (2,2,now()),
    (1,1,'2000-01-01'),
    (1,1,'2001-01-01')"); 
    $stmt1->execute();
    $stmt1->closeCursor();

    //sets up workout table test data
    $stmt1 = $conn->prepare("INSERT INTO WrktTbl(WrktID,WrktName,UserID)VALUES
    (1,'legs',1),
    (2,'chest',1),
    (3,'back',2)");
    $stmt1->execute();
    $stmt1->closeCursor();

    //sets up workout has exercise table test data
    $stmt1 = $conn->prepare("INSERT INTO WrktExerciseTbl(WrktID,ExerciseID)VALUES
    (1,6),
    (2,6),
    (1,1),
    (2,4),
    (3,5),
    (3,8),
    (3,3),
    (3,2),
    (3,7)");
    $stmt1->execute();
    $stmt1->closeCursor();

    //sets up exercise table test data
    $stmt1 = $conn->prepare("INSERT INTO ExerciseTbl(ExerciseID,ExerciseName,ExerciseImage,ExerciseTarget)VALUES
    (1,'bench press (barbell)','benchpress.png','chest'),
    (2,'bicep curls (cable)','cablecurl.png','arms'),
    (3,'incline curls (dumbell)','incdbcurl.png','arms'),
    (4,'incline press (dumbell)','incdbpress.png','chest'),
    (5,'lat pulldown','latpulldown.png','back'),
    (6,'leg extension','legextension.jfif','legs'),
    (7,'rear delt flies (cable)','cablereardeltflies.png','shoulders'),
    (8,'rows (cable)','cablerow.png','back')");
    $stmt1->execute();
    $stmt1->closeCursor();

    //sets up the pupil does exercise table test data
    $stmt1 = $conn->prepare("INSERT INTO PupilExerciseTbl(PDEID,UserID,ExerciseID,Datev,Weightv,Reps)VALUES
    (NULL,1,1,now(),30,12),
    (NULL,1,1,'2001-01-01',35,12),
    (NULL,1,2,now(),25,8),
    (NULL,2,1,now(),5,3),
    (NULL,2,2,now(),15,30)");
    $stmt1->execute();
    $stmt1->closeCursor();

    session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    ?>