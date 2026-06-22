<?php
include_once("connection.php");
try{
    $stmt5 = $conn->prepare("INSERT INTO TblVehicles
    (VehicleID, Make, Model, Registration, Capacity, Status, HireOrOwned)
    VALUES
    (NULL, :Make, :Model, :Registration, :Capacity, :Status, :HireOrOwned)
    ");
    $stmt->bindParam(":Make", $_POST["make"]);
    $stmt->bindParam(":Model", $_POST["model"]);
    $stmt->bindParam(":Registration", $_POST["registration"]);
    $stmt->bindParam(":Capacity", $_POST["capacity"]);
    $stmt->bindParam(":Status", $_POST["status"]);
    $stmt->bindParam(":HireOrOwned", $_POST["hireorowned"]);
    $stmt->execute();
}
catch(PDOException $e)
{
    echo("error: " . $e->getMessage());

}
?>
