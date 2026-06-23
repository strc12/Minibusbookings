<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/site.css" rel="stylesheet">
</head>

<body>

    <?php
    $currentPage = 'users';
    include 'includes/navbar.php';
    include_once("connection.php");
    try {
        $stmt = $conn->prepare("SELECT * FROM tblstaff");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $stmt = $conn->query("SELECT COUNT(*) FROM tblstaff");
    $totalUsers = $stmt->fetchColumn();
    ?>

    <!-- Hero Section -->

    <section class="hero-section text-center">
        <div class="container">
            <h1>User Administration</h1>

            <p class="lead">
                Manage system users. Select a user below to view, edit, or remove their account, or create a new user.
            </p>

            <button type="button" onclick="location.href='adduser.php'" class="btn btn-success me-2">
                Add User
            </button>
        </div>
    </section>

    <main class="container my-5">

        <!-- Optional Summary Cards -->
        <div class="row mb-5">

            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header card-header-custom">
                        Total Users
                    </div>
                    <div class="card-body">
                        <h2><?php echo $totalUsers; ?></h2>
                        <p class="mb-0">Users currently registered.</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- User Management Section -->
        <section>

            <h2 class="section-title">
                Manage Existing Users
            </h2>

            <div class="card shadow-sm">
                <div class="card-body">

                    <form method="POST">

                        <div class="mb-4">
                            <label for="StaffID" class="form-label">
                                Select User
                            </label>

                            <select name="StaffID" id="StaffID" required class="form-select">

                                <?php foreach ($rows as $row): ?>
                                    <option value="<?php echo $row['StaffID']; ?>">
                                        <?php echo $row['FirstName'] . " " . $row['Surname']; ?>
                                    </option>
                                <?php endforeach; ?>

                            </select>
                        </div>

                        <div class="text-end">

                            <button type="submit" formaction="viewuser.php" class="btn btn-primary me-2">
                                View
                            </button>

                            <button type="submit" formaction="edituser.php" class="btn btn-success me-2">
                                Edit
                            </button>

                            <button type="submit" formaction="deleteuser.php" class="btn btn-danger">
                                Delete
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </section>

    </main>
