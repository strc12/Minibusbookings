<?php
    // This page connects the user to the database.
    $servername="localhost";
    $username="root";
    $password="root  ";
    $dbname = "minibus";
    try{
        $conn=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //echo("success");
    }
    catch (PDOException $e)
    {
        echo("connection failed" .$e->getMessage()."<br>");
    }
?>

