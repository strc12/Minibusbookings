<?php
session_start();
if(!isset($_SESSION["Role"])){
    header("Location: login.php");
}

include_once("connection.php");

$bookingID = $_GET['id'];

?>

<!DOCTYPE html>
<html>

<head>
    <title>Enter Mileage</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<?php include_once("includes/navbar.php"); ?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    Enter Journey Mileage
                </div>

                <div class="card-body">

                    <form action="savemileage.php" method="POST"
                        onsubmit="return confirm('Are you sure you want to end this job?');">

                        <input type="hidden"
                               name="bookingid"
                               value="<?php echo $bookingID; ?>">

                        <div class="mb-3">
                            <label class="form-label">
                                Miles Travelled
                            </label>

                            <input type="number"
                                   name="milestravelled"
                                   min="0"
                                   required
                                   class="form-control">
                        </div>

                        <button type="submit"
                                class="btn btn-success">
                            Save Mileage
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>