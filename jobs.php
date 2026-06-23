<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pending Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">

</head>

<body>

<?php
session_start();
include_once("includes/navbar.php");
include_once("connection.php");

$stmt = $conn->prepare("
    SELECT b.*, v.Make, v.Model
    FROM TblBookings b
    LEFT JOIN TblVehicles v
    ON b.VehicleID = v.VehicleID
    WHERE b.Status = 'Pending'
    ORDER BY b.Bookingstartdate, b.StartTime
");

$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container mt-5">

    <h2 class="section-title mb-4">Pending Booking Jobs</h2>

    <div class="row">

        <?php foreach ($bookings as $booking): ?>

            <div class="col-md-6 col-lg-4 mb-4">

                <div class="card job-card shadow-sm h-100">

                    <div class="card-header card-header-custom">
                        <?php echo htmlspecialchars($booking['Destination']); ?>
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Start Date:</strong>
                            <?php echo htmlspecialchars($booking['Bookingstartdate']); ?>
                        </p>

                        <p>
                            <strong>End Date:</strong>
                            <?php echo htmlspecialchars($booking['Bookingenddate']); ?>
                        </p>

                        <p>
                            <strong>Time:</strong>
                            <?php echo htmlspecialchars($booking['StartTime']); ?>
                            -
                            <?php echo htmlspecialchars($booking['EndTime']); ?>
                        </p>

                        <p>
                            <strong>Capacity Required:</strong>
                            <?php echo htmlspecialchars($booking['Capacityrequired']); ?>
                        </p>

                        <p>
                            <strong>Current Vehicle Allocated:</strong>

                            <?php
                            if ($booking['VehicleID'] == NULL) {
                                echo "None";
                            } else {
                                echo htmlspecialchars($booking['Make'] . " " . $booking['Model']);
                            }
                            ?>
                        </p>

                        <p>
                            <strong>Cost Code:</strong>
                            <?php echo htmlspecialchars($booking['CostcodeID']); ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge bg-warning text-dark">
                                <?php echo htmlspecialchars($booking['Status']); ?>
                            </span>
                        </p>

                    </div>

                    <div class="card-footer text-end">

                        <a href="acceptjob.php?id=<?php echo $booking['BookingID']; ?>"
                        class="btn btn-sm btn-success">
                            Accept Job
                        </a>

                        <?php if ($_SESSION["role"] == "Manager") { ?>

                            <a href="allocatevehicle.php?id=<?php echo $booking['BookingID']; ?>"
                            class="btn btn-sm btn-primary">
                                Allocate Vehicle
                            </a>

                        <?php } ?>

                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>