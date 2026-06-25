<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generic Page Design</title>

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">

    
    
</head>
<body>

<?php
    session_start();
    $currentPage = 'dashboard';
    include 'includes/navbar.php';
    include_once("connection.php");

    if(!isset($_SESSION["Role"])){
            header("Location: loggedoutindex.php");
    }

?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1>Generic page design</h1>
        <p class="lead">
            Use this template as a starting point for creating new pages. It includes a header, summary cards, data entry form, and a table to display existing records. Customize the content and layout as needed for your specific use case.

        </p>

        <button class="btn btn-success me-2">
            New Record
        </button>

        <button class="btn btn-danger">
            Cancel
        </button>
    </div>
</section>

<main class="container my-5">

    <!-- Summary Cards -->
    <div class="row mb-5">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Total Records
                </div>
                <div class="card-body">
                    <h2>125</h2>
                    <p class="mb-0">Records currently stored.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Active Records
                </div>
                <div class="card-body">
                    <h2>102</h2>
                    <p class="mb-0">Records marked as active.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Pending Review
                </div>
                <div class="card-body">
                    <h2>23</h2>
                    <p class="mb-0">Records awaiting approval.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Data Entry Section -->
    <section class="mb-5">

        <h2 class="section-title">
            Data Entry Form
        </h2>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="save-record.php">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="recordName"
                                   class="form-label">
                                Record Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="recordName"
                                   name="recordName"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category"
                                   class="form-label">
                                Category
                            </label>

                            <select class="form-select"
                                    id="category"
                                    name="category">
                                <option>Select Category</option>
                                <option>Category A</option>
                                <option>Category B</option>
                                <option>Category C</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="status"
                                   class="form-label">
                                Status
                            </label>

                            <select class="form-select"
                                    id="status"
                                    name="status">
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Pending</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date"
                                   class="form-label">
                                Effective Date
                            </label>

                            <input type="date"
                                   class="form-control"
                                   id="date"
                                   name="date">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="description"
                               class="form-label">
                            Description
                        </label>

                        <textarea class="form-control"
                                  id="description"
                                  name="description"
                                  rows="4"></textarea>
                    </div>

                    <div class="text-end">

                        <button type="reset"
                                class="btn btn-danger me-2">
                            Clear Form
                        </button>

                        <button type="submit"
                                class="btn btn-success">
                            Save Record
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </section>

    <!-- Display Data Section -->
            <?php
        $stmt = $conn->prepare("
            SELECT b.*, 
                s.Firstname AS DriverFirstname,
                s.Surname AS DriverSurname,
                v.Make,
                v.Model,
                v.Registration
            FROM TblBookings b
            LEFT JOIN TblStaff s
                ON b.DriverID = s.StaffID
            LEFT JOIN TblVehicles v
                ON b.VehicleID = v.VehicleID
            WHERE b.Bookingstartdate = CURDATE()
            AND b.Status IN ('Accepted', 'Pending')
            ORDER BY b.StartTime
        ");

        $stmt->execute();
        $todaysJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <section>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="section-title mb-0">
                    Jobs Happening Today
                </h2>
            </div>

            <div class="card shadow-sm">

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-striped table-hover align-middle">

                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Destination</th>
                                    <th>Time</th>
                                    <th>Driver</th>
                                    <th>Vehicle</th>
                                    <th>Capacity</th>
                                    <th>Status</th>
                                    <th>Cost Code</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php foreach ($todaysJobs as $job): ?>

                                    <tr>
                                        <td><?php echo htmlspecialchars($job["BookingID"]); ?></td>

                                        <td><?php echo htmlspecialchars($job["Destination"]); ?></td>

                                        <td>
                                            <?php echo htmlspecialchars($job["StartTime"]); ?>
                                            -
                                            <?php echo htmlspecialchars($job["EndTime"]); ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($job["DriverID"] == NULL) {
                                                echo "No driver allocated";
                                            } else {
                                                echo htmlspecialchars($job["DriverFirstname"] . " " . $job["DriverSurname"]);
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($job["VehicleID"] == NULL) {
                                                echo "No vehicle allocated";
                                            } else {
                                                echo htmlspecialchars($job["Make"] . " " . $job["Model"] . " - " . $job["Registration"]);
                                            }
                                            ?>
                                        </td>

                                        <td><?php echo htmlspecialchars($job["Capacityrequired"]); ?></td>

                                        <td>
                                            <?php if ($job["Status"] == "Accepted"): ?>
                                                <span class="badge bg-success">Accepted</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo htmlspecialchars($job["CostcodeID"]); ?></td>
                                    </tr>

                                <?php endforeach; ?>

                                <?php if (count($todaysJobs) == 0): ?>

                                    <tr>
                                        <td colspan="8" class="text-center">
                                            No jobs are happening today.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </section>

</main>

<footer class="footer-custom text-center">
    <div class="container">
        <small>
            © 2026 Oundle School L6 Enrichement project.
        </small>
    </div>
</footer>



</body>
</html>

