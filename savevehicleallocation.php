<?php
session_start();
if(!isset($_SESSION["Role"])){
    header("Location: login.php");
    exit();
}

include_once("connection.php");

if (
    isset($_POST['bookingid']) &&
    isset($_POST['vehicleid']) &&
    isset($_POST['keylocation'])
) {

    $bookingID = $_POST['bookingid'];
    $vehicleID = $_POST['vehicleid'];
    $keylocation = $_POST['keylocation'];

    $stmt = $conn->prepare("
        UPDATE TblBookings
        SET 
            VehicleID = :VehicleID,
            Keylocation = :Keylocation
        WHERE BookingID = :BookingID
    ");

    $stmt->bindParam(":VehicleID", $vehicleID);
    $stmt->bindParam(":Keylocation", $keylocation);
    $stmt->bindParam(":BookingID", $bookingID);

    $stmt->execute();
}

header("Location: jobs.php");
exit();
?>