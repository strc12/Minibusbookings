<?php 
    // note this does not use connection.php as connection made at the time of creation
   $servername = 'localhost';
   $username = 'root';
   $password= 'password';
//note no Database mentioned here!!

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS Minibus";
    $conn->exec($sql);
    //next 3 lines optional only needed really if you want to go on an do more SQL here!
    $sql = "USE Minibus";
    $conn->exec($sql);
    echo "DB created successfully";
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblStaff;
    CREATE TABLE TblStaff(StaffID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    FirstName VARCHAR(20) NOT NULL,
    Surname VARCHAR(20) NOT NULL,
    Role VARCHAR(20) Enum('Driver','Manager','Staff') NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(20) NOT NULL,
    Initials VARCHAR(5) NOT NULL,
    Licencetodrive Enum('Coach','17 minubus','9 seater','Car','None') NOT NULL DEFAULT 'None'
     )"
    $stmt1->execute();
    $stmt1->closeCursor();
    
    $stmt5 = $conn->prepare("INSERT INTO TblStaff(FirstName,Surname,Role,Password,Email,Phone,Initials,Licencetodrive)VALUES 
    ('John','Doe','Driver','password','john.doe@example.com','1234567890','JD','Coach'),
    ('Jane','Smith','Manager','password','jane.smith@example.com','0987654321','JS','9 seater'),
    ('Emily','Johnson','Staff','password','emily.johnson@example.com','5555555555','EJ','Car'),
    ('David','Williams','Driver','password','david.williams@example.com','1111111111','DW','Coach'),
    ('Michael','Brown','Staff','password','michael.brown@example.com','1111111111','MB','17 minubus')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblVehicles;
    CREATE TABLE TblVehicles(VehicleID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Make VARCHAR(20) NOT NULL,
    Model VARCHAR(20) NOT NULL,
    Registration VARCHAR(10) NOT NULL,
    Capacity INT(2) NOT NULL,
    Status VARCHAR(20) NOT NULL DEFAULT 'Available'
     )"
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblVehicles(Make,Model,Registration,Capacity,Status)VALUES 
    ('Toyota','Prius','ABC123',9,'Available'),
    ('Honda','Civic','DEF456',5,'Available'),
    ('Ford','Transit','GHI789',17,'Available'),
    ('Mercedes','Minicoach','JKL012',25,'Available'),
    ('Volkswagen','Coach','MNO345',52,'Available')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblCostcodes;
    CREATE TABLE TblCostcodes(CostcodeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Costcode VARCHAR(10) NOT NULL PRIMARY KEY,
    Description VARCHAR(255) NOT NULL
     )"
     );
    //need to make sure costcode is unique as it is used in bookings table as foreign key
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblCostcodes(Costcode,Description)VALUES 
    ('S001','Admin'),
    ('S002','Badminton'),
    ('S003','DofE'),
    ('S004','Rugby'),
    ('X005','Silicon valley trip')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
    
    $stmt5->execute();
    $stmt5->closeCursor();
    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblBookings;
    CREATE TABLE TblBookings(BookingID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    StaffID INT(4) NOT NULL,
    VehicleID INT(4) NOT NULL,
    Bookingstartdate DATE NOT NULL,
    Bookingenddate DATE NOT NULL,
    StartTime TIME NOT NULL,
    EndTime TIME NOT NULL,
    DriverID INT(4),
    Destination VARCHAR(255) NOT NULL,
    Costcode VARCHAR(10) NOT NULL
     )"
    $stmt1->execute();
    $stmt1->closeCursor();
    
} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    Status VARCHAR(20) NOT NULL DEFAULT 'Available'
     )"
    $stmt1->execute();
    $stmt1->closeCursor();
} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    Status VARCHAR(20) NOT NULL DEFAULT 'Available'
     )"
    $stmt1->execute();
    $stmt1->closeCursor();
} 
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn=Null;
?>