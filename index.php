<?php
session_start();
        echo($_SESSION["Role"]);
        echo($_SESSION["Licensetodrive"]);  
?>
<!-- landing page for the minibus booking system. This will have links to the login page and a description of the system. -->
<br>
<!DOCTYPE html>
<html>
<head>
    <title>Vehicle booking system/title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php
        
        include_once('nav.php');
    ?>
</body>
</html>