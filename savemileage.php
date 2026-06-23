<?php

session_start();
include_once("connection.php");

$stmt = $conn->prepare("
    UPDATE TblBookings
    SET MilesTravelled = :MilesTravelled
    WHERE BookingID = :BookingID
");

$stmt->bindParam(":MilesTravelled", $_POST['milestravelled']);
$stmt->bindParam(":BookingID", $_POST['bookingid']);

$stmt->execute();

header("Location: myjobs.php");
exit();

?>