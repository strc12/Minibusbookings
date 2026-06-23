<?php

session_start();
include_once("connection.php");

if (isset($_GET['id']) && isset($_SESSION["StaffID"])) {

    $bookingID = $_GET['id'];
    $driverID = $_SESSION["StaffID"];

    $stmt = $conn->prepare("
        UPDATE TblBookings
        SET DriverID = NULL,
            Status = 'Pending'
        WHERE BookingID = :BookingID
        AND DriverID = :DriverID
    ");

    $stmt->bindParam(":BookingID", $bookingID);
    $stmt->bindParam(":DriverID", $driverID);

    $stmt->execute();
}

header("Location: myjobs.php");
exit();

?>