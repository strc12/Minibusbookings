<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link href="css/site.css" rel="stylesheet">
</head>
<body>

<?php
    $currentPage = 'dashboard';
    include 'includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1>Generic page design</h1>
        <p class="lead">
            Use this template as a starting point for creating new pages. It includes a header, summary cards, data entry form, and a table to display existing records. Customize the content and layout as needed for your specific use case.
            
        </p>

        <button class="btn btn-success me-2">
            New Record
        </button>

        <button class="btn btn-danger">
            Cancel
        </button>
    </div>
</section>

<main class="container my-5">

    <!-- Summary Cards -->
    <div class="row mb-5">

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Total Records
                </div>
                <div class="card-body">
                    <h2>125</h2>
                    <p class="mb-0">Records currently stored.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Active Records
                </div>
                <div class="card-body">
                    <h2>102</h2>
                    <p class="mb-0">Records marked as active.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-header card-header-custom">
                    Pending Review
                </div>
                <div class="card-body">
                    <h2>23</h2>
                    <p class="mb-0">Records awaiting approval.</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Data Entry Section -->
    <section class="mb-5">

        <h2 class="section-title">
            Data Entry Form
        </h2>

        <div class="card shadow-sm">
            <div class="card-body">

                <form method="post" action="save-record.php">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="recordName"
                                   class="form-label">
                                Record Name
                            </label>

                            <input type="text"
                                   class="form-control"
                                   id="recordName"
                                   name="recordName"
                                   required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="category"
                                   class="form-label">
                                Category
                            </label>

                            <select class="form-select"
                                    id="category"
                                    name="category">
                                <option>Select Category</option>
                                <option>Category A</option>
                                <option>Category B</option>
                                <option>Category C</option>
                            </select>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="status"
                                   class="form-label">
                                Status
                            </label>

                            <select class="form-select"
                                    id="status"
                                    name="status">
                                <option>Active</option>
                                <option>Inactive</option>
                                <option>Pending</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="date"
                                   class="form-label">
                                Effective Date
                            </label>

                            <input type="date"
                                   class="form-control"
                                   id="date"
                                   name="date">
                        </div>

                    </div>

                    <div class="mb-3">
                        <label for="description"
                               class="form-label">
                            Description
                        </label>

                        <textarea class="form-control"
                                  id="description"
                                  name="description"
                                  rows="4"></textarea>
                    </div>

                    <div class="text-end">

                        <button type="reset"
                                class="btn btn-danger me-2">
                            Clear Form
                        </button>

                        <button type="submit"
                                class="btn btn-success">
                            Save Record
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </section>

    <!-- Display Data Section -->
    <section>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="section-title mb-0">
                Existing Records
            </h2>

            <input type="text"
                   class="form-control w-auto"
                   placeholder="Search...">
        </div>

        <div class="card shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped table-hover align-middle">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>001</td>
                                <td>Example Record 1</td>
                                <td>Category A</td>
                                <td>
                                    <span class="badge bg-success">
                                        Active
                                    </span>
                                </td>
                                <td>01/07/2026</td>
                                <td class="text-end">

                                    <button class="btn btn-sm btn-success">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </td>
                            </tr>

                            <tr>
                                <td>002</td>
                                <td>Example Record 2</td>
                                <td>Category B</td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        Pending
                                    </span>
                                </td>
                                <td>03/07/2026</td>
                                <td class="text-end">

                                    <button class="btn btn-sm btn-success">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </td>
                            </tr>

                            <tr>
                                <td>003</td>
                                <td>Example Record 3</td>
                                <td>Category C</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        Inactive
                                    </span>
                                </td>
                                <td>05/07/2026</td>
                                <td class="text-end">

                                    <button class="btn btn-sm btn-success">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>

                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <!-- Pagination -->
                <nav class="mt-3">
                    <ul class="pagination justify-content-end">

                        <li class="page-item disabled">
                            <a class="page-link" href="#">
                                Previous
                            </a>
                        </li>

                        <li class="page-item active">
                            <a class="page-link" href="#">
                                1
                            </a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">
                                2
                            </a>
                        </li>

                        <li class="page-item">
                            <a class="page-link" href="#">
                                Next
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </div>

    </section>

</main>

<footer class="footer-custom text-center">
    <div class="container">
        <small>
            © 2026 Company Name. All rights reserved.
        </small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
