#form to add in users - admin access only
<DOCTYPE html>
<html>
<head>
    <title>Add user<title>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<head>

<body>
    <form action="adduser.php" method="post">
        First Name: <input type="text" name="FirstName"><br>
        Surname: <input type="number" name="Surname"><br>
        Role:<br>
        Staff: <input type="radio" name="Role" value="0"><br>
        Driver: <input type="radio" name="Role" value="1"><br>
        Manager: <input type="radio" name="Role" value="2"><br>
        Password: <input type="text" name="Password"><br>
        Email: <input type="text" name="Email"><br>
        Phone: <input type="text" name="Phone"><br>
        Initials: <input type="text" name="Initials"><br>
        Licence to drive: <input type="text" name="Licencetodrive"><br>
    <input type="submit" value="Add User"><br><br>

    </form>
    <?php
        include_once("connection.php");    
        $stmt=$conn->prepare("SELECT* FROM TblStaff");
        $stmt->execute();
        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo($row["name"]);
            echo("<br>");
        }
    ?>

</body>

<head>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include_once('nav.php');
    ?>
</body>
</html>