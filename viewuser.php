<?php
    //print_r($_POST);
    $tempuser='john.doe@example.com';
    include_once("connection.php");
   
    $stmt1= $conn->prepare("SELECT * from tblstaff where email=:email");

    
    $stmt1->bindParam(":email",$tempuser);
    $stmt1->execute();
     while($row=$stmt1->fetch(PDO::FETCH_ASSOC)){
        print_r($row);
        #make a pretty form to show date
        
    }
?>