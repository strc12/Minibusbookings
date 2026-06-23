<?php
include_once('connection.php');

$staff = null;

try {
    if (isset($_POST['StaffID'])) {

        $stmt = $conn->prepare("SELECT * FROM tblstaff WHERE StaffID = :StaffID");
        $stmt->bindParam(':StaffID', $_POST['StaffID'], PDO::PARAM_INT);
        $stmt->execute();

        $staff = $stmt->fetch(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php
$currentPage = 'useradmin';
include 'includes/navbar.php';
?>

<main class="container my-5">

    <section class="mb-4">
        <h1 class="mb-3">View Users</h1>
    </section>

    <section>
        <div class="card shadow-sm">
            <div class="card-body">

                <?php if ($staff): ?>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">

                            <tbody>
                                <tr>
                                    <th style="width: 200px;">Staff ID</th>
                                    <td><?= htmlspecialchars($staff['StaffID']) ?></td>
                                </tr>

                                <tr>
                                    <th>First Name</th>
                                    <td><?= htmlspecialchars($staff['FirstName'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Surname</th>
                                    <td><?= htmlspecialchars($staff['Surname'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Email</th>
                                    <td><?= htmlspecialchars($staff['Email'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Role</th>
                                    <td><?= htmlspecialchars($staff['Role'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Phone Number</th>
                                    <td><?= htmlspecialchars($staff['Phone'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Password</th>
                                    <td><?= htmlspecialchars($staff['Password'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Initials</th>
                                    <td><?= htmlspecialchars($staff['Initials'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th>Licence to drive</th>
                                    <td><?= htmlspecialchars($staff['Licencetodrive'] ?? '') ?></td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                <?php else: ?>

                    <div class="alert alert-warning mb-0">
                        No staff member found.
                    </div>

                <?php endif; ?>

                <!-- Back Button -->
                <div class="text-end mt-4">
                    <a href="useradmin.php" class="btn btn-danger">
                        Back
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

<footer class="footer-custom text-center mt-5">
    <div class="container">
        <small>© 2026 Oundle School L6 Enrichment project.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>