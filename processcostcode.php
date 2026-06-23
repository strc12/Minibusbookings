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
    }
    $stmt3 = $conn->prepare("INSERT INTO TblCostcodes
    (CostcodeID,Costcode, Description)
    VALUES 
    (NULL,:Costcode, :Description)");
    $stmt3->bindParam(":Costcode",$_POST["costcode"]);
    $stmt3->bindParam(":Description",$_POST["description"]);
    $stmt3->execute();
    $_SESSION["message"] = "Costcode added successfully";
    header('location: add_or_find_costcode.php');
?>