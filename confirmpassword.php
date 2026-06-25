<!DOCTYPE html>
<html lang="en">
<head>
    <title>Confirm Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php
session_start();
include 'includes/navbar.php';
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="mb-4">Confirm Password</h3>

                    <form action="checkpassword.php" method="POST">

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                Password
                            </label>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="password"
                                required
                            >
                        </div>

                        <?php
                        if (isset($_SESSION["error"])) {
                            echo "<div class='alert alert-danger'>";
                            echo $_SESSION["error"];
                            echo "</div>";
                            unset($_SESSION["error"]);
                        }
                        ?>

                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>