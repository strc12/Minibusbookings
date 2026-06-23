<?php
#might need to add booked option for status as it is different to unavailable 
require_once 'connection.php';
session_start();
$currentPage = 'vehicles';

$stmt = $conn->prepare("SELECT * FROM TblVehicles");
$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$schoolOwnedVehicles = [];
$hiredVehicles = [];

foreach ($vehicles as $vehicle) {
    if ($vehicle['HireOrOwned'] == 'School owned') {
        $schoolOwnedVehicles[] = $vehicle;
    } else {
        $hiredVehicles[] = $vehicle;
    }
}

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

        <a href="addvehicle.php" class="btn btn-success me-2">
            Add Vehicle
        </a>
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
        <section class="mb-5">

    <h2 class="section-title mb-4">School Owned Vehicles</h2>

    <div class="row">

        <?php foreach ($schoolOwnedVehicles as $vehicle): ?>

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
                            <?php echo htmlspecialchars($vehicle['Capacity']); ?> seats
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge <?php echo ($vehicle['Status'] == 'Available') ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo htmlspecialchars($vehicle['Status']); ?>
                            </span>
                        </p>

                    </div>

                    <div class="card-footer text-end">

                        <a href="toggleVehicleStatus.php?id=<?php echo $vehicle['VehicleID']; ?>"
                        class="btn btn-sm btn-success">
                            Toggle Availability
                        </a>

                        <a href="deletevehicle.php?id=<?php echo $vehicle['VehicleID']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this vehicle?');">
                                Delete
                        </a>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</section>


<section class="mb-5">

    <h2 class="section-title mb-4">Hired Vehicles</h2>

    <div class="row">

        <?php foreach ($hiredVehicles as $vehicle): ?>

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
                            <?php echo htmlspecialchars($vehicle['Capacity']); ?> seats
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <span class="badge <?php echo ($vehicle['Status'] == 'Available') ? 'bg-success' : 'bg-danger'; ?>">
                                <?php echo htmlspecialchars($vehicle['Status']); ?>
                            </span>
                        </p>

                    </div>

                   <div class="card-footer text-end">

                        <a href="toggleVehicleStatus.php?id=<?php echo $vehicle['VehicleID']; ?>"
                        class="btn btn-sm btn-success">
                            Toggle Availability
                        </a>

                        <a href="deletevehicle.php?id=<?php echo $vehicle['VehicleID']; ?>"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this vehicle?');">
                                Delete
                        </a>

                    </div>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</section>
    </section>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>