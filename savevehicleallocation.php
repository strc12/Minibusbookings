<?php
session_start();
if(!isset($_SESSION["Role"])){
    header("Location: login.php");
}

include_once("connection.php");

if (isset($_POST['bookingid']) && isset($_POST['vehicleid'])) {

    $bookingID = $_POST['bookingid'];
    $vehicleID = $_POST['vehicleid'];

    $stmt = $conn->prepare("
        UPDATE TblBookings
        SET VehicleID = :VehicleID
        WHERE BookingID = :BookingID
    ");

    $stmt->bindParam(":VehicleID", $vehicleID);
    $stmt->bindParam(":BookingID", $bookingID);

    $stmt->execute();
}

header("Location: jobs.php");
exit();

?>