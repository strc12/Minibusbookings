<?php
    session_start();
    //Might need to do password hashing later
    //array_map ("htmlspecialchars",$_POST);
    include_once("connection.php");
    $stmt1= $conn->prepare("SELECT * FROM TblStaff WHERE Email=:Email" );
    $stmt1->bindParam(":Email",$_POST["email"]);
    $stmt1->execute();
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $hashed = $row["Password"];
        $attempt = $_POST["password"];
        if ($_POST["email"] == $row["Email"]){
             echo("valid email");
            if (password_verify($attempt, $hashed)) {
                echo("valid password");
                $_SESSION["Role"]=$row["Role"];
                $_SESSION["Licensetodrive"]=$row["Licencetodrive"];
                $_SESSION["firstname"]=$row["FirstName"];
                $_SESSION["StaffID"]=$row["StaffID"];
                $_SESSION["loggedin"] = True;
                header('location: index.php');
                print_r($_SESSION);
            }
            else{
                $_SESSION["error"] = "Invalid password";
                header('location: login.php');
                print_r($_SESSION);

            }
        }
         else{
             $_SESSION["error"] = "Invalid email";
             header('location: login.php');
            print_r($_SESSION);

         }
    }
?>