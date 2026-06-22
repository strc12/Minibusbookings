<?php
    session_start();
    //Might need to do password hashing later.
    //array_map ("htmlspecialchars",$_POST);
    include_once("connection.php");
    $stmt1= $conn->prepare("SELECT * FROM TblStaff WHERE Email=:Email" );
    $stmt1->bindParam(":Email",$_POST["email"]);
    $stmt1->execute();
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        if ($_POST["email"] == $row["Email"]){
             echo("valid email");
            if ($_POST["password"] == $row["Password"]){
                echo("valid password");
                $_SESSION["Role"]=$row["Role"];
                $_SESSION["Licensetodrive"]=$row["Licencetodrive"];
                $_SESSION["firstname"]=$row["FirstName"];
                $_SESSION["StaffID"]=$row["StaffID"];
                
                //echo $_SESSION["password"];
                //echo ("\n");
                //echo $_SESSION["Licensetodrive"];
                //echo("\n");
                //echo $_SESSION["firstname"];
                //echo("\n");
                //echo $_SESISON["StaffID"];
                //redirect to the index page, might change later.
                header('location: index.php');
            }
            else{
                echo("Invalid password");
            }
        }
         else{
             echo("Invalid email");
         }
    }
?>