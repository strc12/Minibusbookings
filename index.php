<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main page</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/site.css" rel="stylesheet">
</head>
<body>

<?php
    $currentPage = 'home';
    include 'includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">

        <h1>Oundle School minibus</h1>

        <p class="lead">
            Placeholder
        </p>

    </div>
</section>

<main class="container my-5">

<!-- Images -->
<section class="text-center mb-5">


    <div id="minibusCarousel"
        class="carousel slide carousel-fade"
        data-bs-ride="carousel"
        data-bs-interval="10000">


        <!-- Indicators -->
        <div class="carousel-indicators">
            <button type="button"
                    data-bs-target="#minibusCarousel"
                    data-bs-slide-to="0"
                    class="active"></button>

            <button type="button"
                    data-bs-target="#minibusCarousel"
                    data-bs-slide-to="1"></button>
        </div>

        <div class="carousel-inner rounded-4 shadow-lg overflow-hidden">

            <div class="carousel-item active">
                <img src="images/AIMinibus.png"
                     class="d-block w-100"
                     alt="AI Minibus"
                     style="max-height: 550px; object-fit: cover;">

                <div class="carousel-caption d-none d-md-block">
                    <div class="bg-dark bg-opacity-50 rounded p-2">
                        <p>Placeholder</p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="images/AIMinibus2.png"
                     class="d-block w-100"
                     alt="AI Minibus 2"
                     style="max-height: 550px; object-fit: cover;">

                <div class="carousel-caption d-none d-md-block">
                    <div class="bg-dark bg-opacity-50 rounded p-2">
                        <p>Placeholder</p>
                    </div>
                </div>
            </div>


        </div>

        <button class="carousel-control-prev"
                type="button"
                data-bs-target="#minibusCarousel"
                data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
                type="button"
                data-bs-target="#minibusCarousel"
                data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

</section>


    <!-- Project Description -->
    <section class="mb-5">

        <div class="card shadow-sm">
            <div class="card-header card-header-custom">
                About this website
            </div>

            <div class="card-body">
                <p class="mb-0">
                    Placeholder
                </p>
            </div>
        </div>

    </section>

    <!-- Contributors -->
    <section>

        <h2 class="section-title mb-4">
            Website Contributors
        </h2>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <h5 class="card-title">Name</h5>
                        <p class="text-muted mb-0">
                            Role
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </section>

</main>

<footer class="footer-custom text-center">
    <div class="container">
        <small>
            © 2026 Oundle School L6 Enrichment Project.
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
