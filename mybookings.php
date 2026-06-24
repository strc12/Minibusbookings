<?php
session_start();

if (!isset($_SESSION["Role"])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION["Role"] == "Driver") {
    header("Location: index.php");
    exit();
}

if ($_SESSION["Role"] != "Staff" && $_SESSION["Role"] != "Manager") {
    header("Location: login.php");
    exit();
}

include_once("connection.php");

if (!isset($_SESSION["StaffID"])) {
    header("Location: login.php");
    exit();
}

$staffID = $_SESSION["StaffID"];

$stmt = $conn->prepare("
    SELECT b.*, v.Make, v.Model, v.Registration
    FROM TblBookings b
    LEFT JOIN TblVehicles v
    ON b.VehicleID = v.VehicleID
    WHERE b.StaffID = :StaffID
    AND b.Status IN ('Pending','Accepted')
    ORDER BY b.Bookingstartdate, b.StartTime
");

$stmt->bindParam(":StaffID", $staffID);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Bookings</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php include_once("includes/navbar.php"); ?>

<div class="container mt-5">

    <h2 class="section-title mb-4">My Bookings</h2>

    <div class="row">

        <?php foreach ($bookings as $booking): ?>

            <div class="col-md-6 col-lg-4 mb-4">

                <div class="card booking-card shadow-sm h-100">

                    <div class="card-header card-header-custom">
                        <?php echo htmlspecialchars($booking['Destination']); ?>
                    </div>

                    <div class="card-body">

                        <p><strong>Start Date:</strong> <?php echo htmlspecialchars($booking['Bookingstartdate']); ?></p>
                        <p><strong>End Date:</strong> <?php echo htmlspecialchars($booking['Bookingenddate']); ?></p>
                        <p><strong>Time:</strong> <?php echo htmlspecialchars($booking['StartTime']); ?> - <?php echo htmlspecialchars($booking['EndTime']); ?></p>
                        <p><strong>Capacity Required:</strong> <?php echo htmlspecialchars($booking['Capacityrequired']); ?></p>
                        <p><strong>Cost Code:</strong> <?php echo htmlspecialchars($booking['CostcodeID']); ?></p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge bg-warning text-dark">
                                <?php echo htmlspecialchars($booking['Status']); ?>
                            </span>
                        </p>

                        <p>
                            <strong>Vehicle:</strong>
                            <?php
                            if ($booking['VehicleID'] == NULL) {
                                echo "Not allocated";
                            } else {
                                echo htmlspecialchars($booking['Make'] . " " . $booking['Model'] . " - " . $booking['Registration']);
                            }
                            ?>
                        </p>

                    </div>

                    <div class="card-footer text-end">
                        <a href="cancelbooking.php?id=<?php echo $booking['BookingID']; ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Are you sure you want to cancel this booking?');">
                            Cancel Booking
                        </a>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>

    </div>

</div>

</body>
</html>