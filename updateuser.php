<?php

    header("Location: useradmin.php");
    print_r($_POST);
    include_once("connection.php");
    

    $stmt1= $conn->prepare("UPDATE TblStaff 
     SET FirstName=:FirstName, Surname=:Surname,  Password=:Password, 
     Email=:Email, Phone=:Phone, Initials=:Initials, Licencetodrive=:Licencetodrive
     WHERE StaffID = :StaffID");
    $stmt1->bindParam(":StaffID",$_POST["StaffID"]);
    $stmt1->bindParam(":FirstName",$_POST["FirstName"]);
    $stmt1->bindParam(":Surname",$_POST["Surname"]);
    #$stmt1->bindParam(":Role",$_POST["Role"]);
    $stmt1->bindParam(":Password",$_POST["Password"]);
    $stmt1->bindParam(":Email",$_POST["Email"]);
    $stmt1->bindParam(":Phone",$_POST["Phone"]);
    $stmt1->bindParam(":Initials",$_POST["Initials"]);
    $stmt1->bindParam(":Licencetodrive",$_POST["Licencetodrive"]);
    $stmt1->execute();  
?>

