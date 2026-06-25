<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION["correctpassword"]) || $_SESSION["correctpassword"] != true) {
    header("Location: confirmpassword.php");
    exit();
}
?>

<head>
    <title>Change Password</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/site.css" rel="stylesheet">
</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Change Password</h3>

                    <span id="check_password_match" class="d-block mb-3"></span>

                    <form action="processchangepassword.php" method="POST">

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                New Password
                            </label>
                            <input
                                name="password"
                                type="password"
                                class="form-control"
                                id="password"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="confirm_password" class="form-label">
                                Confirm Password
                            </label>
                            <input
                                name="confirm_password"
                                type="password"
                                class="form-control"
                                id="confirm_password"
                                required
                            >
                        </div>

                        <button
                            type="submit"
                            id="submitBtn"
                            class="btn btn-primary w-100"
                            disabled>
                            Change Password
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

<script>
$(document).on('keyup', '#password, #confirm_password', function () {

    let password = $("#password").val();
    let confirm_password = $("#confirm_password").val();

    if (password === "" || confirm_password === "") {
        $("#check_password_match").html("");
        $("#submitBtn").prop("disabled", true);
    }
    else if (password !== confirm_password) {
        $("#check_password_match")
            .html("Passwords do not match.")
            .css("color", "red");

        $("#submitBtn").prop("disabled", true);
    }
    else {
        $("#check_password_match")
            .html("Passwords match.")
            .css("color", "green");

        $("#submitBtn").prop("disabled", false);
    }
});
</script>

</body>
</html>