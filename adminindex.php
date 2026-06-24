<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle booking system</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    
    <link href="css/site.css" rel="stylesheet">
</head>
<body>
    <?php
        include_once('includes/navbar.php');
        
        include_once('/includes/navbar.php');
        session_start();
    ?>

    <a href="vehicle.php" class="btn btn-primary">Vehicle Admin</a>
    <a href="bookingrequest.php" class="btn btn-primary">Make Booking</a>
    <a href="mybookings.php" class="btn btn-primary">Personal Bookings</a>
    <a href="jobs.php" class="btn btn-primary">Booking Statuses</a>
    <a href="useradmin.php" class="btn btn-primary">User Admin</a>
    <a href="???.php" class="btn btn-primary">Jobs History</a>

</body>
</html>