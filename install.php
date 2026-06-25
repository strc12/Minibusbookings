<?php

// note this does not use connection.php as connection made at the time of creation

$servername = 'localhost';

$username = 'root';
$password = 'root';
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

    Role  Enum('Driver','Manager','Staff') NOT NULL DEFAULT 'Staff',

    Password VARCHAR(255) NOT NULL,

    Email VARCHAR(255) NOT NULL,

    Phone VARCHAR(20) NOT NULL,

    Initials VARCHAR(5) NOT NULL,

    Licencetodrive  Enum('Coach','17 minibus','9 seater','Car','None') NOT NULL DEFAULT 'None',

    LicenceExpires DATE NOT NULL
    LicenceExpires DATE NOT NULL

    )"

    );

    $stmt1->execute();
    $hashedpassword = password_hash("Password", PASSWORD_DEFAULT);
    $stmt1->closeCursor();

    $stmt5 = $conn->prepare("INSERT INTO TblStaff(FirstName,Surname,Role,Password,Email,Phone,Initials,Licencetodrive, LicenceExpires)VALUES
    ('John','Doe','Driver',:Password,'john.doe@example.com','1234567890','JD','Coach', '2030-12-31'),
    ('Kristian','Fewster','Manager',:Password,'jane.smith@example.com','0987654321','JS','9 seater','2030-12-31'),
    ('Emily','Johnson','Staff',:Password,'emily.johnson@example.com','5555555555','EJ','Car','2030-12-31'),
    ('David','Williams','Driver',:Password,'david.williams@example.com','1111111111','DW','Coach','2030-12-31'),
    ('Rob','Cunniffe','Staff',:Password,'ric@oundleschool.org.uk','1111111111','MB','17 minibus','2030-12-31')
    ");
    $stmt5->bindParam(":Password", $hashedpassword);
    $stmt5->execute();

    $stmt5->closeCursor();

    #not working bwelwo here

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblVehicles;

    CREATE TABLE TblVehicles(VehicleID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    Make VARCHAR(20) NOT NULL,

    Model VARCHAR(20) NOT NULL,

    Registration VARCHAR(10) NOT NULL,

    Capacity INT(2) NOT NULL,

    Status VARCHAR(20) NOT NULL DEFAULT 'Available',

    HireOrOwned Enum('Hired','School owned') NOT NULL DEFAULT 'Hired'

     )"

    );

    $stmt1->execute();

    $stmt1->closeCursor();

    $stmt5 = $conn->prepare("INSERT INTO TblVehicles(VehicleID,Make,Model,Registration,Capacity,Status,HireOrOwned)VALUES

    (NULL,'Toyota','Prius','ABC123',9,'Available','School owned'),

    (NULL,'Honda','Civic','DEF456',5,'Available','School owned'),

    (NULL,'Ford','Transit','GHI789',17,'Available','School owned'),

    (NULL,'Mercedes','Minicoach','JKL012',25,'Available','Hired'),

    (NULL,'Volkswagen','Coach','MNO345',52,'Available','Hired')

    ");

    $stmt5->execute();

    $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblCostcodes;

    CREATE TABLE TblCostcodes(CostcodeID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    Costcode VARCHAR(10) NOT NULL,

    Description VARCHAR(255) NOT NULL)"

    );

    //need to make sure costcode is unique as it is used in bookings table as foreign key

    $stmt1->execute();

    $stmt1->closeCursor();

    $stmt5 = $conn->prepare("INSERT INTO TblCostcodes(CostcodeID,Costcode,Description)VALUES

    (NULL,'S001','Admin'),

    (NULL,'S002','Badminton'),

    (NULL,'S003','DofE'),

    (NULL,'S004','Rugby'),

    (NULL,'X005','Silicon Valley trip'),

    (NULL,'TBD','Cost Code TBD')

    ");

    $stmt5->execute();

    $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS TblBookings;

    CREATE TABLE TblBookings(BookingID INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    StaffID INT(4) NOT NULL,

    VehicleID INT(4),

    Bookingstartdate DATE NOT NULL,

    Bookingenddate DATE NOT NULL,

    StartTime TIME NOT NULL,

    EndTime TIME NOT NULL,

    Capacityrequired INT(2) NOT NULL,

    Status Enum('Pending','Accepted','Completed','Cancelled') NOT NULL DEFAULT 'Pending',

    Destination VARCHAR(255) NOT NULL,

    MilesTravelled INT(5),

    CostcodeID VARCHAR(10) NOT NULL,

    Keylocation Enum('Staff Pigeon Hole','Porter Pigeon Hole','Armoury','TBD') NOT NULL DEFAULT 'TBD')


    ");

    $stmt1->execute();

    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblBookings(BookingID,StaffID,VehicleID,Bookingstartdate,Bookingenddate,StartTime,EndTime,Capacityrequired,Status,Destination,MilesTravelled,CostcodeID,Keylocation)VALUES 
    (NULL,3,NULL,'2024-10-01','2024-10-01','09:00:00','17:00:00',5,'Pending','Local sports event',0,'S002', 'TBD'),
    (NULL,3,NULL,'2024-10-15','2024-10-15','08:00:00','18:00:00',17,'Pending','DofE expedition',0,'S003', 'TBD'),
    (NULL,3,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',9,'Pending','Rugby match',0,'S004', 'TBD'),
    (NULL,2,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',9,'Pending','Football match',0,'S004', 'TBD'),
    (NULL,1,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',9,'Pending','Badminton match',0,'S004', 'TBD'),
    (NULL,3,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',9,'Pending','Netball match',0,'S004', 'TBD'),
    (NULL,3,NULL,'2024-12-01','2024-12-01','07:00:00','19:00:00',52,'Pending','Silicon Valley trip',0,'X005', 'TBD')
    ");

    $stmt5->execute();

    $stmt5->closeCursor();

    $stmt1 = $conn->prepare("DROP TABLE IF EXISTS tbldriverjobs;
    CREATE TABLE tbldriverjobs(BookingID INT(4) NOT NULL,
    DriverID INT(4) NOT NULL,
    AllocatedDriver INT(1) DEFAULT 0,
    PRIMARY KEY (DriverID, BookingID))");
    $stmt1->execute();
    $stmt1->closeCursor();

    $stmt5 = $conn->prepare("INSERT INTO Tbldriverjobs(BookingID,DriverID,AllocatedDriver)VALUES 
    (1,1,1),
    (2,4,1),
    (4,1,1)
    "); 
    $stmt5->execute();
    $stmt5->closeCursor();

/* } catch (PDOException $e) {

    echo $sql . "<br>" . $e->getMessage();

} */

$conn = Null;


}