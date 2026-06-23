<?php
session_start();
?>
<!-- landing page for the minibus booking system. This will have links to the login page and a description of the system. -->

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
        print_r($_SESSION);
    ?>
    <a href="login.php" class="btn btn-primary">Login</a>
    <a href="vehicle.php" class="btn btn-primary">Vehicle system</a>
    <a href="bookingrequest.php" class="btn btn-primary">Booking system</a>
    
</body>
</html>