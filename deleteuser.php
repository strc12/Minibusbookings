<?php 
include_once('connection.php');

try {
    $stmt = $conn->prepare("DELETE FROM tblstaff WHERE StaffID = ");
    $stmt->execute();
    $stmt->closeCursor();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>