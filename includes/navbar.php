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
                    <a class="nav-link <?= ($currentPage == 'dashboard') ? 'active' : ''; ?>"
                       href="dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'reports') ? 'active' : ''; ?>"
                       href="reports.php">
                        Reports
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= ($currentPage == 'users') ? 'active' : ''; ?>"
                       href="users.php">
                        Users
                    </a>
                </li>

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