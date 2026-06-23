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
    <link rel="stylesheet" href="css/site.css">
</head>
<body>
    <?php
        
        include_once('/includes/navbar.php');
        session_start();
        print_r($_SESSION);
    ?>
   <main class="container my-5">

    <!-- Summary Cards -->
    <div class="row mb-5">

        <div class="col-md-4">
            
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
</body>
</html>