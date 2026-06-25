<?php
$stmt = $conn->query("SELECT * FROM tbldriverjobs");

while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    print_r($row);
    echo "<br>";
}

$stmt = $conn->query("SELECT BookingID, Destination FROM TblBookings");

while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    print_r($row);
    echo "<br>";
}

?>
