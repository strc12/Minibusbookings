<?php

session_start();

if (!isset($_SESSION["Role"]) || $_SESSION["Role"] != "Manager") {
    header("Location: login.php");
    exit();
}

include_once("connection.php");

$stmt = $conn->prepare("
    SELECT StaffID, Firstname, Surname
    FROM TblStaff
    WHERE Role = 'Driver' OR Role = 'Manager'
    ORDER BY Surname, Firstname
");

$stmt->execute();
$drivers = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selectedDriverID = $_GET["driverid"] ?? "";

$jobs = [];
$totalJobs = 0;
$completedJobs = 0;
$totalMiles = 0;

if ($selectedDriverID != "") {

    $stmt2 = $conn->prepare("
        SELECT b.*, v.Make, v.Model, v.Registration
        FROM TblBookings b
        LEFT JOIN TblVehicles v
            ON b.VehicleID = v.VehicleID
        WHERE b.DriverID = :DriverID
        ORDER BY b.Bookingstartdate DESC, b.StartTime DESC
    ");

    $stmt2->bindParam(":DriverID", $selectedDriverID);
    $stmt2->execute();
    $jobs = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    foreach ($jobs as $job) {
        $totalJobs++;

        if ($job["Status"] == "Completed") {
            $completedJobs++;
        }

        if ($job["MilesTravelled"] != NULL) {
            $totalMiles += $job["MilesTravelled"];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Driver Report</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php include_once("includes/navbar.php"); ?>

<div class="container mt-5">

    <h2 class="section-title mb-4">Driver Report</h2>

    <div class="card shadow-sm mb-4">
        <div class="card-header card-header-custom">
            Select Driver
        </div>

        <div class="card-body">

            <form method="GET" action="driverreport.php">

                <div class="row">

                    <div class="col-md-9 mb-3">
                        <select name="driverid" class="form-select" required>
                            <option value="">-- Select Driver --</option>

                            <?php foreach ($drivers as $driver): ?>

                                <option value="<?php echo $driver["StaffID"]; ?>"
                                    <?php if ($selectedDriverID == $driver["StaffID"]) echo "selected"; ?>>

                                    <?php echo htmlspecialchars($driver["Firstname"] . " " . $driver["Surname"]); ?>

                                </option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-success w-100">
                            View Report
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <?php if ($selectedDriverID != ""): ?>

        <div class="row mb-4">

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header card-header-custom">
                        Total Jobs
                    </div>
                    <div class="card-body">
                        <h2><?php echo $totalJobs; ?></h2>
                        <p class="mb-0">Jobs assigned to this driver.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header card-header-custom">
                        Completed Jobs
                    </div>
                    <div class="card-body">
                        <h2><?php echo $completedJobs; ?></h2>
                        <p class="mb-0">Jobs completed by this driver.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header card-header-custom">
                        Total Miles
                    </div>
                    <div class="card-body">
                        <h2><?php echo $totalMiles; ?></h2>
                        <p class="mb-0">Total miles recorded.</p>
                    </div>
                </div>
            </div>

        </div>

        <section>
            <h2 class="section-title mb-4">Job Details</h2>

            <div class="card shadow-sm">
                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover align-middle">

                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Destination</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Miles</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($jobs as $job): ?>

                                    <tr>
                                        <td><?php echo htmlspecialchars($job["BookingID"]); ?></td>

                                        <td>
                                            <?php echo htmlspecialchars($job["Bookingstartdate"]); ?>
                                            -
                                            <?php echo htmlspecialchars($job["Bookingenddate"]); ?>
                                        </td>

                                        <td>
                                            <?php echo htmlspecialchars($job["StartTime"]); ?>
                                            -
                                            <?php echo htmlspecialchars($job["EndTime"]); ?>
                                        </td>

                                        <td><?php echo htmlspecialchars($job["Destination"]); ?></td>

                                        <td>
                                            <?php
                                            if ($job["VehicleID"] == NULL) {
                                                echo "Not allocated";
                                            } else {
                                                echo htmlspecialchars($job["Make"] . " " . $job["Model"] . " - " . $job["Registration"]);
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php if ($job["Status"] == "Completed"): ?>
                                                <span class="badge bg-secondary">Completed</span>
                                            <?php elseif ($job["Status"] == "Accepted"): ?>
                                                <span class="badge bg-success">Accepted</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">
                                                    <?php echo htmlspecialchars($job["Status"]); ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($job["MilesTravelled"] == NULL) {
                                                echo "Not entered";
                                            } else {
                                                echo htmlspecialchars($job["MilesTravelled"]);
                                            }
                                            ?>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>

                                <?php if (count($jobs) == 0): ?>

                                    <tr>
                                        <td colspan="7" class="text-center">
                                            No jobs found for this driver.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </section>

    <?php endif; ?>

</div>

</body>
</html>