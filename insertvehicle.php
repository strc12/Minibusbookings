<?php
session_start();
if ($_SESSION["Role"] != "Manager") {
    header("Location: index.php");
}

include_once("connection.php");

try {
    $stmt5 = $conn->prepare("
        INSERT INTO TblVehicles
        (VehicleID, Make, Model, Registration, Capacity, Status, HireOrOwned)
        VALUES
        (NULL, :Make, :Model, :Registration, :Capacity, :Status, :HireOrOwned)
    ");

    $stmt5->bindParam(":Make", $_POST["make"]);
    $stmt5->bindParam(":Model", $_POST["model"]);
    $stmt5->bindParam(":Registration", $_POST["registration"]);
    $stmt5->bindParam(":Capacity", $_POST["capacity"]);
    $stmt5->bindParam(":Status", $_POST["status"]);
    $stmt5->bindParam(":HireOrOwned", $_POST["hireorowned"]);

    $stmt5->execute();

    header("Location: vehicle.php");
    exit();
}
catch(PDOException $e) {
    echo("error: " . $e->getMessage());
}

?>