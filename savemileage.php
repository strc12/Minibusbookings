<?php
session_start();
if(!isset($_SESSION["Role"])){
    header("Location: login.php");
}

include_once("connection.php");

try {
    $stmt = $conn->prepare("
        UPDATE TblBookings
        SET MilesTravelled = :MilesTravelled,
            Status = 'Completed'
        WHERE BookingID = :BookingID
    ");

    $stmt->bindParam(":MilesTravelled", $_POST["milestravelled"]);
    $stmt->bindParam(":BookingID", $_POST["bookingid"]);

    $stmt->execute();

    header("Location: myjobs.php");
    exit();
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>