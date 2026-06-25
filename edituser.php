<?php
    session_start();
    if(!isset($_SESSION["Role"])){
        header("Location: login.php");
}

    if($_SESSION["Role"] != "Manager" ){
        header("Location: index.php");
    }

  /*   if(!isset($_SESSION["role"])){
        header("Location: login.php"); */
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generic Page Design</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/site.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
session_start();
 include 'includes/navbar.php';
include_once("connection.php");
#need to change to session variable later

#print_r($_POST);
$stmt = $conn->prepare(
"SELECT * FROM tblstaff WHERE StaffID = :StaffID"
);

$stmt->bindParam(":StaffID", $_POST["StaffID"]);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);
#print_r($user);
?>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8 col-lg-6">

            <div class="card vehicle-card shadow-sm">

                <div class="card-header card-header-custom">
                    Edit user details
                </div>

                <div class="card-body">

                    <form action="updateuser.php" method="POST">
                        <input type="hidden"
                        name="StaffID"
                        value="<?php echo $user['StaffID']; ?>">

                        <div class="mb-3">
                            <label class="form-label">First Name</label>
                            <input type="text" name="FirstName" value="<?php echo $user['FirstName']; ?>" class="form-control" required>
                         
                        </div>


                        <div class="mb-3">
                            <label class="form-label">Surname</label>
                            <input type="text" name="Surname" value="<?php echo $user['Surname']; ?>" class="form-control" required>
                        </div>

                        <!-- <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="Password" value="<?php echo $user['Password']; ?>" class="form-control" required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div> -->
                       <!--  <div class="mb-4">
                                <label for="password" class="form-label">
                                    Password
                                </label>

                                <div class="password-wrapper">

                                    <input
                                    type="password"
                                    class="form-control pe-5"
                                    id="Password"
                                    name = "Password"
                                    value="<?php echo $user['Password']; ?>"
                                    placeholder="Enter password"
                                    >

                                    <i
                                    class="bi bi-eye password-toggle"
                                    id="togglePassword"
                                    ></i>

                                </div>
                                </div> -->

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" name="Email" value="<?php echo $user['Email']; ?>" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="Phone" value="<?php echo $user['Phone']; ?>" class="form-control" required>

                        </div>

                        <div class="mb-4">
                            <label class="form-label">Initials</label>
                            <input type="text" name="Initials" value="<?php echo $user['Initials']; ?>" class="form-control" required>

                        </div>


                        <div class="mb-4">
                            <label class="form-label">Licence to drive</label>
                            <select id="Licencetodrive" name="Licencetodrive">
                                <option value="Coach">Coach</option>
                                <option value="17 minibus">17 minibus</option>
                                <option value="9 seater">9 seater</option>
                                <option value="Car">Car</option>
                                <option value="None">None</option>
                            </select>                        </div>

                        <div class="mb-4">
                            <label class="form-label">Licence Expiry Date</label>
                            <input type="date" name="LicenceExpires" value="<?php echo $user['LicenceExpires']; ?>" class="form-control" required>

                        </div>

                        <div class="text-end">
                            <a href="useradmin.php" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-success">
                                Update user
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>





<input type="hidden"
       name="StaffID"
       value="<?php echo $user['StaffID']; ?>">


<script>
/* const password = document.getElementById('Password');
const toggle = document.getElementById('togglePassword');
//const icon = toggle.querySelector('i');

toggle.addEventListener('click', () => {
if (password.type === "password"){
    password.type = "text";
}else{
    password.type = "password";
}
toggle.classList.toggle("bi-eye-slash");

toggle.classList.toggle("bi-eye"); */
//const isPassword = password.type === 'password';

//password.type = isPassword ? 'text' : 'password';

//icon.classList.toggle('bi-eye');
//icon.classList.toggle('bi-eye-slash');
//});
</script>







</form>
</body>
</html>