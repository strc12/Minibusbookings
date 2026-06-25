<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    if ($_SESSION["correctpassword"] != true){
        header("Location: confirmpassword.php");
    }
?>

<head>
    <title>Password change</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="offset-md-3 col-md-6">
                <span id="check_password_match"></span>
                <form action="processchangepassword.php" method="POST">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="text" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input name="confirm_password" type="text" class="form-control" id="confirm_password">
                    </div>
                    <button type="submit" id="submitBtn" class="btn btn-primary" disabled>
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(document).on('keyup', '#confirm_password', function () {
            let password = $("#password").val();
            let confirm_password = $("#confirm_password").val();
            if (password != confirm_password) {
                $("#check_password_match").html("Password does not match.").css("color", "red");
            } else {
                $("#check_password_match").html("")
            }
        });
        $(document).on('keyup', '#password, #confirm_password', function () {

            let password = $("#password").val();
            let confirm_password = $("#confirm_password").val();

            if (password === "" || confirm_password === "") {
                $("#check_password_match").html("");
                $("#submitBtn").prop("disabled", true);
            }
            else if (password != confirm_password) {
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
