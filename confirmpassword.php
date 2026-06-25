<!DOCTYPE html>
<html>
<head>
    <title>Confirm password</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <form action="checkpassword.php" method="POST">
        Confirm password: <input type="text" name="password"><br>
        <?php
        session_start();
        if ($_SESSION["error"] == "Invalid password"){
            echo "<p style='color:red'>" . $_SESSION["error"] . "</p>";
            unset($_SESSION["error"]);
        }
        ?>
        <input type="submit" value="submit">
    </form>

</head>
</html>