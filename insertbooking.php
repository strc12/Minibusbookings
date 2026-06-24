<?php


session_start();
include_once("connection.php");

try {
    $staffID = $_SESSION["StaffID"];

    if ($_POST["driverrequired"] == "No") {
        $driverID = $staffID;
        $status = "Accepted";
    } else {
        $driverID = NULL;
        $status = "Pending";
    }

    $stmt = $conn->prepare("
        INSERT INTO TblBookings
        (BookingID, StaffID, VehicleID, Bookingstartdate, Bookingenddate, StartTime, EndTime, DriverID, Capacityrequired, Status, Destination, CostcodeID)
        VALUES
        (NULL, :StaffID, NULL, :Bookingstartdate, :Bookingenddate, :StartTime, :EndTime, :DriverID, :Capacityrequired, :Status, :Destination, :CostcodeID)
    ");

    $stmt->bindParam(":StaffID", $staffID);
    $stmt->bindParam(":DriverID", $driverID);
    $stmt->bindParam(":Status", $status);
    $stmt->bindParam(":Bookingstartdate", $_POST["bookingstartdate"]);
    $stmt->bindParam(":Bookingenddate", $_POST["bookingenddate"]);
    $stmt->bindParam(":StartTime", $_POST["starttime"]);
    $stmt->bindParam(":EndTime", $_POST["endtime"]);
    $stmt->bindParam(":Capacityrequired", $_POST["capacityrequired"]);
    $stmt->bindParam(":Destination", $_POST["destination"]);
    $stmt->bindParam(":CostcodeID", $_POST["costcodeid"]);

    $stmt->execute();

    header("Location: mybookings.php");
    exit();
}
catch(PDOException $e) {
    echo("error: " . $e->getMessage());
}

?>