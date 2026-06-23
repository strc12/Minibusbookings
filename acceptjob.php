<?php

include_once("connection.php");

if (isset($_GET['id'])) {

    $bookingID = $_GET['id'];

    // Temporary driver ID until login system is fully connected
    $driverID = 1;

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

header("Location: jobs.php");
exit();

?>