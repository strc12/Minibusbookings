<?php
    session_start();
    if($_SESSION["Role"] != "Manager"){
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Cost Codes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your site CSS -->
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php
    $currentPage = 'costcodes';
    include 'includes/navbar.php';
?>

<main class="container my-5">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card shadow-sm">

                <div class="card-header card-header-custom text-center">
                    Edit Cost Code
                </div>

                <div class="card-body">

                    <form action="processeditcostcode.php" method="POST">

                        <!-- Cost Code -->
                        <div class="mb-3">
                            <label for="costcode" class="form-label">
                                Cost Code
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="costcode"
                                   id="costcode"
                                   required>
                        </div>

                        <!-- Error message -->
                        <?php
                            if (isset($_SESSION["error"])) {
                                echo "<div class='alert alert-danger'>"
                                     . $_SESSION["error"] .
                                     "</div>";
                                unset($_SESSION["error"]);
                            }
                        ?>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                Description
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="description"
                                   id="description"
                                   required>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-success">
                                Update Cost Code
                            </button>

                            <a href="addcostcode.php" class="btn btn-outline-primary">
                                Back to Add Cost Codes
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>