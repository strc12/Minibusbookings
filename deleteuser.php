<?php 
include_once('connection.php');
print_r($_POST);
try {
    $stmt = $conn->prepare("DELETE FROM tblstaff WHERE StaffID = :StaffID");
     $stmt->bindParam(":StaffID",$_POST["StaffID"]);
    $stmt->execute();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>