<!DOCTYPE html>
<html>
<head>
    <title>Add user</title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    #include_once('/includes/navbar.php');
    ?>
    <form action="adduser.php" method="post">
        First Name: <input type="text" name="FirstName"><br>
        Surname: <input type="text" name="Surname"><br>
        Role:<br>
        Staff: <input type="radio" name="Role" value="0"><br>
        Driver: <input type="radio" name="Role" value="1"><br>
        Manager: <input type="radio" name="Role" value="2"><br>
        Password: <input type="password" name="Password"><br>
        Email: <input type="text" name="Email"><br>
        Phone: <input type="text" name="Phone"><br>
        Initials: <input type="text" name="Initials"><br>
        Licence to drive: <input type="text" name="Licencetodrive"><br>
       <input type="submit" value="Add User"><br><br>

    </form>
</body>
</html>