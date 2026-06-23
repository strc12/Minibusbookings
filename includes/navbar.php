<nav class="navbar navbar-expand-lg navbar-custom fixed-top shadow-sm">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="dashboard.php">
            <img src="images/logo.png"
            alt="Logo"
            class="navbar-logo me-2">
            Oundle Minibus Bookings
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler bg-light"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- Left / Center Nav -->
            <ul class="navbar-nav ms-auto me-3">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <?php if ($_SESSION["Role"] == "Staff") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="bookingrequest.php">
                            Booking Request
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="mybookings.php">
                            My Bookings
                        </a>
                    </li>

                <?php } ?>

                <?php if ($_SESSION["Role"] == "Driver") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">
                            Jobs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="myjobs.php">
                            My Jobs
                        </a>
                    </li>

                <?php } ?>

                <?php if ($_SESSION["Role"] == "Manager") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="vehicle.php">
                            Vehicles
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">
                            Jobs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="myjobs.php">
                            My Jobs
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="useradmin.php">
                            Admin
                        </a>
                    </li>

                <?php } ?>

            </ul>

            <!-- Login / User Area -->
            <div class="d-flex align-items-center">

                <?php

                if (empty($_SESSION["loggedin"])) {

                    echo '<a href="login.php" class="btn btn-success btn-sm">Login</a>';

                } else {

                ?>
                    <div class="dropdown">
                        <a class="btn btn-outline-light btn-sm dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                            <?php echo htmlspecialchars($_SESSION["firstname"]); ?>

                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                <?php
                }

                ?>
                

            </div>

        </div>

    </div>
</nav>