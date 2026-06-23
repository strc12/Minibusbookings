<?php
session_start();
print_r($_SESSION);

?>


<!DOCTYPE html>
<html>
<head>
    <title>Add user</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     <link href="css/site.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once('includes/navbar.php');
    ?>
    <div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card vehicle-card shadow-sm">

                <div class="card-header card-header-custom">
                    Add New User
                </div>

                <div class="card-body">

                    <form action="adduserprocess.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="FirstName" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="Surname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">User Role</label>
                            <select name="Role" class="form-control">
                                <option>Staff</option>
                                <option>Driver</option>
                                <option>Manager</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="Password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="Email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="Phone" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Initials</label>
                            <input type="text" name="Initials" class="form-control">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Licence to Drive</label>
                            <select name="Licencetodrive" class="form-control">
                                <option selected>None</option>
                                <option>Car</option>
                                <option>9 seater</option>
                                <option>17 minibus</option>
                                <option>Coach</option>
                            </select>
                        </div>


                        <div class="text-end">
                            <a href="useradmin.php" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-success">
                                Add User
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
<!-- 
    <form action="adduserprocess.php" method="post">
        First Name: <input type="text" name="FirstName"><br>
        Surname: <input type="text" name="Surname"><br>
        Role:<br>
            Staff <input type="radio" name="Role" value="Staff" checked><br>
            Driver <input type="radio" name="Role" value="Driver"><br>
            Manager <input type="radio" name="Role" value="Manager"><br>
        Password: <input type="password" name="Password"><br>
        Email: <input type="email" name="Email"><br>
        Phone: <input type="tel" name="Phone"><br>
        Initials: <input type="text" name="Initials"><br>
        Licence to drive: <select name="Licencetodrive"><br>
            <option>Coach</option>
            <option>17 minibus</option>
            <option>9 seater</option>
            <option>Car</option>
            <option selected>None</option>
        </select> <br>
        <input type="submit" value="Add User"><br>
    </form>
</body>
</html>
 -->