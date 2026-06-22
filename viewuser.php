<?php 
include_once('connection.php');
//print_r($_POST);
try {
    $stmt = $conn->prepare("SELECT * FROM tblstaff WHERE StaffID = :StaffID");
     $stmt->bindParam(":StaffID",$_POST["StaffID"]);
    while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            //print_r($row);
            echo($row["StaffID"]);
            echo("<br>");
        }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>