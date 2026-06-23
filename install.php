<?php
    // note this does not use connection.php as connection made at the time of creation
   $servername = 'localhost';
   $username = 'root';
   $password= 'root';
//note no Database mentioned here!!
#test

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
    Licencetodrive  Enum('Coach','17 minibus','9 seater','Car','None') NOT NULL DEFAULT 'None'
    )"
    );
    $stmt1->execute();
    $hashedpassword = password_hash("Password",PASSWORD_DEFAULT);
    $stmt1->closeCursor();
   
    $stmt5 = $conn->prepare("INSERT INTO TblStaff(FirstName,Surname,Role,Password,Email,Phone,Initials,Licencetodrive)VALUES
    ('John','Doe','Driver',:Password,'john.doe@example.com','1234567890','JD','Coach'),
    ('Kristian','Fewster','Manager',:Password,'jane.smith@example.com','0987654321','JS','9 seater'),
    ('Emily','Johnson','Staff',:Password,'emily.johnson@example.com','5555555555','EJ','Car'),
    ('David','Williams','Driver',:Password,'david.williams@example.com','1111111111','DW','Coach'),
    ('Rob','Cunniffe','Staff',:Password,'ric@oundleschool.org.uk','1111111111','MB','17 minibus')
    ");
    $stmt5->bindParam(":Password",$hashedpassword);
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
    (NULL,'X005','Silicon Valley trip')
    ");
    $stmt5->execute();
    $stmt5->closeCursor();
   
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
    DriverID INT(4),
    Capacityrequired INT(2) NOT NULL,
    Status Enum('Pending','Accepted','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
    Destination VARCHAR(255) NOT NULL,
    CostcodeID VARCHAR(10) NOT NULL)"
    );
    $stmt1->execute();
    $stmt1->closeCursor();
    $stmt5 = $conn->prepare("INSERT INTO TblBookings(BookingID,StaffID,VehicleID,Bookingstartdate,Bookingenddate,StartTime,EndTime,DriverID,Capacityrequired,Status,Destination,CostcodeID)VALUES
    (NULL,3,NULL,'2024-10-01','2024-10-01','09:00:00','17:00:00',NULL,5,'Pending','Local sports event','S002'),
    (NULL,3,NULL,'2024-10-15','2024-10-15','08:00:00','18:00:00',NULL,17,'Pending','DofE expedition','S003'),
    (NULL,3,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',NULL,9,'Pending','Rugby match','S004'),
    (NULL,2,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',NULL,9,'Pending','Football match','S004'),
    (NULL,1,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',NULL,9,'Pending','Badminton match','S004'),
    (NULL,3,NULL,'2024-11-01','2024-11-01','10:00:00','16:00:00',NULL,9,'Pending','Netball match','S004'),
    (NULL,3,NULL,'2024-12-01','2024-12-01','07:00:00','19:00:00',NULL,52,'Pending','Silicon Valley trip','X005')
     
    ");
    $stmt5->execute();
    $stmt5->closeCursor();

}
    catch(PDOException $e)

    {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn=Null;
?>


