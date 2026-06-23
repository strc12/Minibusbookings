<?php
    session_start();
    include_once("connection.php");
    $stmt1= $conn->prepare("SELECT * FROM TblCostcodes WHERE Costcode=:Costcode" );
    $stmt1->bindParam(":Costcode",$_POST["costcode"]);
    $stmt1->execute();
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC))
    {
        if ($_POST["costcode"] == $row["Costcode"]){
            $_SESSION["error"] = "Costcode already exists.";
            header('location: add_or_find_costcode.php');
        }
        else{
            $stmt2 = $conn->prepare("UPDATE TblCostcodes SET Costcode=:Costcode, Description=:Description WHERE Costcode=:Costcode");
            $stmt2->bindParam(":Description",$_POST["description"]);
            $stmt2->execute();
            $_SESSION["message"] = "Costcode updated successfully";
            header('location: add_or_find_costcode.php');
        }
    }
?>