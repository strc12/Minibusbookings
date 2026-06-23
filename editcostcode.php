<?php
    session_start();
?>
<DOCTYPE html>
<html>
<head>
    <title>Add costcodes</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <form action="processeditcostcode.php" method="POST">
        costcode: <input type="text" name="costcode"><br>
        <?php
        if (isset($_SESSION["error"])){
            echo "<p style='color:red'>" . $_SESSION["error"] . "</p>";
            unset($_SESSION["error"]);
        }
        ?>
        description: <input type="text" name="description"><br>
        submit: <input type="submit" value="Submit"><br>
    </form>

</body>
</html>