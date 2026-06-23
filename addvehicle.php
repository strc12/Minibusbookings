<!DOCTYPE html>
<html lang="en">

<?php
    session_start();
    if($_SESSION["role"] != "Manager"){
        header("Location: index.php");
    }
?>

<head>
    <title>Add Vehicle</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">
    
</head>

<body>

<?php
include_once("includes/navbar.php");
include_once("connection.php");
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card vehicle-card shadow-sm">

                <div class="card-header card-header-custom">
                    Add New Vehicle
                </div>

                <div class="card-body">

                    <form action="insertvehicle.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Make</label>
                            <input type="text" name="make" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Model</label>
                            <input type="text" name="model" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Registration</label>
                            <input type="text" name="registration" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Capacity</label>
                            <input type="number" name="capacity" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Available" selected>Available</option>
                                <option value="Unavailable">Unavailable</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Hire Or Owned</label>
                            <select name="hireorowned" class="form-select" required>
                                <option value="">-- Select Type --</option>
                                <option value="Hired">Hired</option>
                                <option value="School owned">School Owned</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <a href="vehicle.php" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-success">
                                Add Vehicle
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