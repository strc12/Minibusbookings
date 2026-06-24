<?php
session_start();
if($_SESSION["Role"] !== "Manager"){
    header("Location: index.php");
}

require_once 'connection.php';

if (isset($_GET['id'])) {

    $vehicleID = $_GET['id'];

    $stmt = $conn->prepare("
        SELECT Status
        FROM TblVehicles
        WHERE VehicleID = ?
    ");

    $stmt->execute([$vehicleID]);

    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vehicle) {

        $newStatus =
            ($vehicle['Status'] == 'Available')
            ? 'Unavailable'
            : 'Available';

        $update = $conn->prepare("
            UPDATE TblVehicles
            SET Status = ?
            WHERE VehicleID = ?
        ");

        $update->execute([$newStatus, $vehicleID]);
    }
}

header("Location: vehicle.php");
exit;