<?php
    session_start();
    array_map ("htmlspecialchars",$_POST);
    include_once("connection.php");
    $stmt1= $conn->prepare("SELECT * FROM TblStaff WHERE Email=:Email" );
    $stmt1->bindParam(":Email",$_SESSION["Email"]);
    $stmt1->execute();
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        $hashed=$row["Password"];
        $attempt=$_POST["password"];
        if (password_verify($attempt, $hashed)) {
            $_SESSION["correctpassword"] = true;
            header("Location: changepassword.php");
        }
        else{
            $_SESSION["error"] = "Invalid password";
            header("Location: confirmpassword.php");
        }
    }
?>