<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Cost Codes</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your site styles (optional but recommended for consistency) -->
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
                    Add Cost Code
                </div>

                <div class="card-body">

                    <form action="processcostcode.php" method="POST">

                        <!-- Cost Code -->
                        <div class="mb-3">
                            <label class="form-label" for="costcode">
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
                            <label class="form-label" for="description">
                                Description
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="description"
                                   id="description"
                                   required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid gap-2">

                            <button type="submit" class="btn btn-success">
                                Add Cost Code
                            </button>

                            <a href="editcostcode.php" class="btn btn-outline-primary">
                                Edit Cost Codes
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