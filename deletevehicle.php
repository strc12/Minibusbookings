<?php

require_once 'connection.php';

if (isset($_GET['id'])) {

    $vehicleID = $_GET['id'];

    $stmt = $conn->prepare("
        DELETE FROM TblVehicles
        WHERE VehicleID = ?
    ");

    $stmt->execute([$vehicleID]);
}

header("Location: vehicle.php");
exit;

?>