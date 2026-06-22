<?php
require_once 'connection.php';

$currentPage = 'vehicles';

$stmt = $conn->prepare("SELECT * FROM TblVehicles");
$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalVehicles = count($vehicles);
$availableVehicles = 0;
$schoolOwned = 0;

foreach ($vehicles as $vehicle) {
    if ($vehicle['Status'] == 'Available') {
        $availableVehicles++;
    }

    if ($vehicle['HireOrOwned'] == 'School owned') {
        $schoolOwned++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Vehicles</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
    <style>
        .vehicle-card .card-header-custom {
            background-color: #002855;
            color: #fff;
        }
    </style>
</head>

<body>

<?php include 'includes/navbar.php'; ?>

<section class="hero-section text-center">
    <div class="container">
        <h1>Manage Vehicles</h1>
        <p class="lead">
            View the school minibus fleet, including registrations, capacity, availability and ownership status.
        </p>

        <button class="btn btn-success me-2">Add Vehicle</button>
        <button class="btn btn-danger">Cancel</button>
    </div>
</section>

<main class="container my-5">

    <div class="row mb-5">

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Total Vehicles
                </div>
                <div class="card-body">
                    <h2><?php echo $totalVehicles; ?></h2>
                    <p class="mb-0">Vehicles currently stored.</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Available Vehicles
                </div>
                <div class="card-body">
                    <h2><?php echo $availableVehicles; ?></h2>
                    <p class="mb-0">Vehicles available for bookings.</p>
                </div>
            </div>
        </div>

        

    </div>

    <section>
        <h2 class="section-title mb-4">Vehicles</h2>

        <div class="row">

            <?php foreach ($vehicles as $vehicle): ?>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card vehicle-card shadow-sm h-100">

                        <div class="card-header card-header-custom">
                            <?php echo htmlspecialchars($vehicle['Make']); ?>
                            <?php echo htmlspecialchars($vehicle['Model']); ?>
                        </div>

                        <div class="card-body">

                            <p>
                                <strong>Registration:</strong>
                                <?php echo htmlspecialchars($vehicle['Registration']); ?>
                            </p>

                            <p>
                                <strong>Capacity:</strong>
                                <?php echo htmlspecialchars($vehicle['Capacity']); ?>
                                seats
                            </p>

                            <p>
                                <strong>Status:</strong>
                                <span class="badge bg-success">
                                    <?php echo htmlspecialchars($vehicle['Status']); ?>
                                </span>
                            </p>

                            <p>
                                <strong>Hire / Owned:</strong>
                                <?php echo htmlspecialchars($vehicle['HireOrOwned']); ?>
                            </p>

                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-sm btn-success">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>