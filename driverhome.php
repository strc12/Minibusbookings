<?php

session_start();
require_once("connection.php");

// For testing
$DriverID = 1;

// Later use:
// $DriverID = $_SESSION['StaffID'];

//echo "Driver ID = " . $DriverID . "<br>";

$stmt = $conn->prepare("
    SELECT
        b.BookingID,
        b.Bookingstartdate,
        b.Bookingenddate,
        b.StartTime,
        b.EndTime,
        b.Destination,
        b.Status,
        b.Capacityrequired
    FROM tbldriverjobs dj
    INNER JOIN TblBookings b
        ON dj.BookingID = b.BookingID
    WHERE dj.DriverID = :DriverID
    ORDER BY b.Bookingstartdate ASC, b.StartTime ASC
");

$stmt->bindParam(":DriverID", $DriverID);
$stmt->execute();

$jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Driver Jobs</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     <link href="css/site.css" rel="stylesheet">
    

</head>
<body>


<?php
include_once('includes/navbar.php');
?>

<div class="container-fluid px-4">

    <h1 class="section-title mb-4">My Jobs</h1>

    <?php if(count($jobs) > 0){ ?>

    <div class="card job-card shadow-sm">
        <div class="card-header card-header-custom">
            Upcoming Jobs
        </div>

        <div class="card-body p-0">

            <table class="table job-table mb-0">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Date</th>
                        <th>Destination</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Passengers</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                foreach($jobs as $job){
                ?>

                    <tr>
                        <td><?= $job['BookingID'] ?></td>

                        <td>
                            <?= date('d M Y', strtotime($job['Bookingstartdate'])) ?>
                        </td>

                        <td><?= htmlspecialchars($job['Destination']) ?></td>

                        <td><?= substr($job['StartTime'],0,5) ?></td>

                        <td><?= substr($job['EndTime'],0,5) ?></td>

                        <td><?= $job['Capacityrequired'] ?></td>

                        <td>
                            <span class="status-badge status-<?= $job['Status'] ?>">
                                <?= $job['Status'] ?>
                            </span>
                        </td>
                    </tr>

                <?php
                }
                ?>

                </tbody>
            </table>

        </div>
    </div>

    <?php
    }
    else{
        echo "<div class='alert alert-info'>No jobs allocated.</div>";
    }
    ?>

</div>
<?php
//print_r($_SESSION);

/*  $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($jobs);
echo "</pre>"; */
?> 

</body>
</html>