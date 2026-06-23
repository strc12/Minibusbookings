<?php

session_start();
include_once("connection.php");

if (isset($_GET['id']) && isset($_SESSION["StaffID"])) {

    $bookingID = $_GET['id'];
    $driverID = $_SESSION["StaffID"];

    $stmt = $conn->prepare("
        UPDATE TblBookings
        SET DriverID = :DriverID,
            Status = 'Accepted'
        WHERE BookingID = :BookingID
    ");

    $stmt->bindParam(":DriverID", $driverID);
    $stmt->bindParam(":BookingID", $bookingID);

    $stmt->execute();
}

header("Location: myjobs.php");
exit();

?>