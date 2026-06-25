<?php

session_start();
if (!isset($_SESSION["Role"])) {
    header("Location: login.php");
}

include_once("connection.php");

$driverID = $_SESSION["StaffID"];

$stmt = $conn->prepare("
    SELECT 
        b.*, 
        v.Make, 
        v.Model, 
        v.Registration
    FROM TblDriverJobs dj

    INNER JOIN TblBookings b
        ON dj.BookingID = b.BookingID

    LEFT JOIN TblVehicles v
        ON b.VehicleID = v.VehicleID

    WHERE dj.DriverID = :DriverID

    ORDER BY b.Bookingstartdate, b.StartTime
");

$stmt->bindParam(":DriverID", $driverID);
$stmt->execute();

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt->bindParam(":DriverID", $driverID);
$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

    <?php include_once("includes/navbar.php"); ?>

    <div class="container mt-5">

        <h2 class="section-title mb-4">My Driver Jobs</h2>

        <div class="row">

            <?php foreach ($bookings as $job): ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card job-card shadow-sm h-100">

                        <div class="card-header card-header-custom">
                            <?php echo htmlspecialchars($job["Destination"]); ?>
                        </div>

                        <div class="card-body">

                            <p><strong>Start Date:</strong> <?php echo htmlspecialchars($job["Bookingstartdate"]); ?></p>

                            <p><strong>End Date:</strong> <?php echo htmlspecialchars($job["Bookingenddate"]); ?></p>

                            <p>
                                <strong>Time:</strong>
                                <?php echo htmlspecialchars($job["StartTime"]); ?>
                                -
                                <?php echo htmlspecialchars($job["EndTime"]); ?>
                            </p>

                            <p><strong>Capacity Required:</strong> <?php echo htmlspecialchars($job["Capacityrequired"]); ?>
                            </p>

                            <p><strong>Cost Code:</strong> <?php echo htmlspecialchars($job["CostcodeID"]); ?></p>

                            <p>
                                <strong>Vehicle:</strong>
                                <?php
                                if ($job["VehicleID"] == NULL) {
                                    echo "Not allocated";
                                } else {
                                    echo htmlspecialchars($job["Make"] . " " . $job["Model"] . " - " . $job["Registration"]);
                                }
                                ?>
                            </p>

                            <p>
                                <strong>Miles Travelled:</strong>

                                <?php
                                echo ($job["MilesTravelled"] == NULL)
                                    ? "Not entered"
                                    : htmlspecialchars($job["MilesTravelled"]);
                                ?>
                            </p>

                            <p>
                                <strong>Status:</strong>
                                <span class="badge bg-success">
                                    <?php echo htmlspecialchars($job["Status"]); ?>
                                </span>
                            </p>



                        </div>

                        <div class="card-footer text-end">

                            <a href="mileage.php?id=<?php echo $job['BookingID']; ?>" class="btn btn-sm btn-success">
                                Enter Mileage
                            </a>

                            <a href="canceljob.php?id=<?php echo $job['BookingID']; ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure you want to release this job?');">
                                Release Job
                            </a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>