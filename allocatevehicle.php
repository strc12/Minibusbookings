<?php

include_once("connection.php");

if (!isset($_GET['id'])) {
    header("Location: jobs.php");
    exit();
}

$bookingID = $_GET['id'];

$stmt = $conn->prepare("
    SELECT *
    FROM TblBookings
    WHERE BookingID = :BookingID
");

$stmt->bindParam(":BookingID", $bookingID);
$stmt->execute();
$booking = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt2 = $conn->prepare("
    SELECT *
    FROM TblVehicles
    WHERE Status = 'Available'
    AND Capacity >= :Capacityrequired
");

$stmt2->bindParam(":Capacityrequired", $booking['Capacityrequired']);
$stmt2->execute();
$vehicles = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Allocate Vehicle</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
        }

        .card-header-custom {
            background-color: #0b1f3a;
            color: white;
            font-weight: 600;
        }

        .booking-card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>

<body>

<?php include_once("includes/navbar.php"); ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card booking-card shadow-sm">

                <div class="card-header card-header-custom">
                    Allocate Vehicle
                </div>

                <div class="card-body">

                    <p><strong>Destination:</strong> <?php echo htmlspecialchars($booking['Destination']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($booking['Bookingstartdate']); ?></p>
                    <p><strong>Capacity Required:</strong> <?php echo htmlspecialchars($booking['Capacityrequired']); ?></p>

                    <form action="savevehicleallocation.php" method="POST">

                        <input type="hidden" name="bookingid" value="<?php echo $booking['BookingID']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Choose Vehicle</label>

                            <select name="vehicleid" class="form-select" required>
                                <option value="">-- Select Vehicle --</option>

                                <?php foreach ($vehicles as $vehicle): ?>

                                    <option value="<?php echo $vehicle['VehicleID']; ?>">
                                        <?php echo htmlspecialchars($vehicle['Make']); ?>
                                        <?php echo htmlspecialchars($vehicle['Model']); ?>
                                        -
                                        <?php echo htmlspecialchars($vehicle['Registration']); ?>
                                        -
                                        <?php echo htmlspecialchars($vehicle['Capacity']); ?> seats
                                    </option>

                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="text-end">
                            <a href="jobs.php" class="btn btn-secondary">Cancel</a>

                            <button type="submit" class="btn btn-success">
                                Allocate Vehicle
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>