<!DOCTYPE html>
<html lang="en">

<head>
    <title>Booking Request</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="css/site.css" rel="stylesheet">

</head>

<body>

    <?php
    session_start();
    #fdg
    include_once("includes/navbar.php");
    include_once("connection.php");
    try {
        $stmt = $conn->prepare("SELECT * FROM tblcostcodes");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">

                <div class="card booking-card shadow-sm">

                    <div class="card-header card-header-custom">
                        New Booking Request
                    </div>

                    <div class="card-body">

                        <form action="insertbooking.php" method="POST">

                            <div class="mb-3">
                                <label class="form-label">Booking Start Date</label>
                                <input type="date" name="bookingstartdate" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Booking End Date</label>
                                <input type="date" name="bookingenddate" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Start Time</label>
                                <input type="time" name="starttime" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">End Time</label>
                                <input type="time" name="endtime" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Capacity Required</label>
                                <input type="number" name="capacityrequired" class="form-control" min="1" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Destination</label>
                                <input type="text" name="destination" class="form-control" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Cost Code</label>
                                <select name="costcodeid" id="costcodeid" required class="form-select">

                                    <?php foreach ($rows as $row): ?>
                                        <option value="<?php echo $row['Costcode']; ?>">
                                            <?php echo $row['Description'] . " - " . $row['Costcode']; ?>
                                        </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Driver Required?</label>

                                <select name="driverrequired" class="form-select" required>
                                    <option value="">-- Select Option --</option>
                                    <option value="Yes">Yes - Driver Required</option>
                                    <option value="No">No - I will drive myself</option>
                                </select>
                            </div>

                            <div class="text-end">
                                <a href="index.php" class="btn btn-secondary">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-success">
                                    Submit Booking Request
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