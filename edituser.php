<?php
session_start();
include_once("connection.php");
#need to change to session variable later
$staffid=2;
$stmt = $conn->prepare(
"SELECT * FROM tblstaff WHERE StaffID = :StaffID"
);

$stmt->bindParam(":StaffID", $staffid);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<form action="updateuser.php" method="post">

<input type="hidden"
       name="StaffID"
       value="<?php echo $user['StaffID']; ?>">

First Name:
<input type="text"
       name="FirstName"
       value="<?php echo $user['FirstName']; ?>"><br>

Surname:
<input type="text"
       name="Surname"
       value="<?php echo $user['Surname']; ?>"><br>

Password:
<input type="password"
       name="Password"
       value="<?php echo $user['Password']; ?>"><br>

Email:
<input type="text"
       name="Email"
       value="<?php echo $user['Email']; ?>"><br>


Phone:
<input type="text"
       name="Phone"
       value="<?php echo $user['Phone']; ?>"><br>

Initials:
<input type="text"
       name="Initials"
       value="<?php echo $user['Initials']; ?>"><br>


Licence to drive:
<input type="text"
       name="Licencetodrive"
       value="<?php echo $user['Licencetodrive']; ?>"><br>


<input type="submit" value="Update User">

</form>