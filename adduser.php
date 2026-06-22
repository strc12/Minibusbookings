<?php
    header("Location: users.php");
    print_r($_POST);
    include_once("connection.php");
    $Username=$_POST["Surname"].".".$_POST["FirstName"][0];
    //$username="bob";
    if($_POST["role"]=="Staff"){
        $role=0;
    }elseif($_POST["role"]=="Driver"){
        $role=1;
    }elseif($_POST["role"]=="Manager"){
        $role=2;
    }
   
/*     if($_POST["Licencetodrive"]=="Coach"){
        $Licencetodrive=0;
    }elseif($_POST["Licencetodrive"]=="17 minibus"){
        $Licencetodrive=1;
    }elseif($_POST["Licencetodrive"]=="9 seater"){
        $Licencetodrive=2;
    }elseif($_POST["Licencetodrive"]=="Car"){
        $Licencetodrive=3;
    }else{
        $Licensetodrive=4;
    } */

    $stmt1= $conn->prepare("INSERT INTO tblusers
    (StaffID, FirstName, Surname, Role, Password, Email, Phone, Initials, Licencetodrive)
    VALUES
    (NULL,:FirstName, :Surname, :Role, :Password, :Email, :Phone, :Initials, :Licencetodrive)
    ");
    $stmt1->bindParam(":FirstName",$_POST["FirstName"]);
    $stmt1->bindParam(":Surname",$_POST["Surname"]);
    $stmt1->bindParam(":Role",$_POST["Role"]);
    $stmt1->bindParam(":Password",$_POST["Password"]);
    $stmt1->bindParam(":Email",$_POST["Email"]);
    $stmt1->bindParam(":Phone",$_POST["Phone"]);
    $stmt1->bindParam(":Initials",$_POST["Initials"]);
    $stmt1->bindParam(":Licencetodrive",$_POST["Licencetodrive"]);
    $stmt1->execute();
?>
