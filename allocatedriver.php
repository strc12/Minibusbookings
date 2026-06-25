<?php
session_start();
include_once("connection.php");

$stmt = $conn->prepare("
SELECT 
    b.*,
    v.Make,
    v.Model,

    GROUP_CONCAT(
        CONCAT(s.StaffID, ': ', s.FirstName, ' ', s.Surname)
        SEPARATOR ' | '
    ) AS AppliedDrivers,

    GROUP_CONCAT(dj.DriverID) AS AppliedDriverIDs,

    CASE 
        WHEN GROUP_CONCAT(dj.DriverID) IS NOT NULL THEN 1 
        ELSE 0 
    END AS HasApplicants

FROM TblBookings b

LEFT JOIN TblVehicles v
    ON b.VehicleID = v.VehicleID

LEFT JOIN tbldriverjobs dj
    ON b.BookingID = dj.BookingID

LEFT JOIN TblStaff s
    ON dj.DriverID = s.StaffID

WHERE b.Status = 'Pending'

GROUP BY b.BookingID

ORDER BY b.Bookingstartdate, b.StartTime
");

$stmt->execute();
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pending Jobs</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php include_once("includes/navbar.php"); ?>

<div class="container mt-5">

    <h2 class="section-title mb-4">
        Allocate Drivers to Jobs
    </h2>

    <div class="table-responsive">

        <table class="table table-striped table-bordered align-middle">

            <thead class="table-dark">
                <tr>
                    <th>Destination</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Time</th>
                    <th>Capacity</th>
                    <th>Vehicle</th>
                    <th>Key Location</th>
                    <th>Status</th>
                    <th>Drivers Applied</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php foreach ($bookings as $booking): ?>

                <tr>

                    <td><?= htmlspecialchars($booking['Destination']) ?></td>

                    <td><?= htmlspecialchars($booking['Bookingstartdate']) ?></td>

                    <td><?= htmlspecialchars($booking['Bookingenddate']) ?></td>

                    <td>
                        <?= htmlspecialchars($booking['StartTime']) ?>
                        -
                        <?= htmlspecialchars($booking['EndTime']) ?>
                    </td>

                    <td><?= htmlspecialchars($booking['Capacityrequired']) ?></td>

                    <td>
                        <?php
                        if ($booking['VehicleID'] == NULL) {
                            echo "Not allocated";
                        } else {
                            echo htmlspecialchars($booking['Make'] . " " . $booking['Model']);
                        }
                        ?>
                    </td>

                    <td><?= htmlspecialchars($booking['Keylocation']) ?></td>

                    <td>
                        <span class="badge bg-warning text-dark">
                            <?= htmlspecialchars($booking['Status']) ?>
                        </span>
                    </td>

                    <!-- DROPDOWN OF APPLIED DRIVERS -->
                    <td>

                        <?php if (!empty($booking['AppliedDrivers'])): ?>

                        <form method="POST" action="allocateDrivertojob.php">

                            <input type="hidden" name="bookingID" value="<?= $booking['BookingID'] ?>">

                            <select name="driverID" class="form-select form-select-sm mb-1" required>

                                <option value="" disabled selected>
                                    Select Driver
                                </option>

                                <?php
                                $drivers = explode(' | ', $booking['AppliedDrivers']);

                                foreach ($drivers as $driver) {

                                    // format: "1: John Smith"
                                    [$id, $name] = explode(': ', $driver);

                                    echo '<option value="' . htmlspecialchars($id) . '">'
                                        . htmlspecialchars($name)
                                        . '</option>';
                                }
                                ?>

                            </select>

        <button type="submit" class="btn btn-primary btn-sm">
            Allocate
        </button>

    </form>

<?php else: ?>

    <span class="text-muted">No applicants</span>

<?php endif; ?>

                    </td>

                    <!-- ACTIONS -->
                    <td class="text-nowrap">

                        <?php if ($_SESSION["Role"] == "Manager") { ?>
                            <a href="allocatevehicle.php?id=<?= $booking['BookingID'] ?>"
                               class="btn btn-primary btn-sm mb-1">
                                Allocate Vehicle
                            </a>
                        <?php } ?>

                        <?php if ($booking['VehicleID'] != NULL): ?>

                            <a href="acceptjob.php?id=<?= $booking['BookingID'] ?>"
                               class="btn btn-success btn-sm mb-1">
                                Apply Now
                            </a>

                        <?php else: ?>

                            <button class="btn btn-secondary btn-sm mb-1" disabled>
                                Vehicle Required
                            </button>

                        <?php endif; ?>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>
</div>

</body>
</html>