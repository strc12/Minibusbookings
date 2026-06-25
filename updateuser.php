<?php
session_start();

if($_SESSION["Role"] != "Manager"){
    header("Location: index.php");
    exit();
}

include_once("connection.php");


$stmt1 = $conn->prepare("
UPDATE TblStaff 
SET 
FirstName=:FirstName, 
Surname=:Surname,   
Email=:Email, 
Phone=:Phone, 
Initials=:Initials, 
Licencetodrive=:Licencetodrive,
LicenceExpires=:LicenceExpires
WHERE StaffID = :StaffID
");


$stmt1->bindParam(":StaffID", $_POST["StaffID"]);
$stmt1->bindParam(":FirstName", $_POST["FirstName"]);
$stmt1->bindParam(":Surname", $_POST["Surname"]);
$stmt1->bindParam(":Email", $_POST["Email"]);
$stmt1->bindParam(":Phone", $_POST["Phone"]);
$stmt1->bindParam(":Initials", $_POST["Initials"]);
$stmt1->bindParam(":Licencetodrive", $_POST["Licencetodrive"]);
$stmt1->bindParam(":LicenceExpires", $_POST["LicenceExpires"]);


$stmt1->execute();


header("Location: useradmin.php");
exit();

?>
