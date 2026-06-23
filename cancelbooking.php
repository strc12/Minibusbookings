<?php

session_start();
include_once("connection.php");

if (isset($_GET['id']) && isset($_SESSION["StaffID"])) {

    $bookingID = $_GET['id'];
    $staffID = $_SESSION["StaffID"];

    $stmt = $conn->prepare("
        DELETE FROM TblBookings
        WHERE BookingID = :BookingID
        AND StaffID = :StaffID
    ");

    $stmt->bindParam(":BookingID", $bookingID);
    $stmt->bindParam(":StaffID", $staffID);

    $stmt->execute();
}

header("Location: mybookings.php");
exit();

?>