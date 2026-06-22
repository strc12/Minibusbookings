<?php
    // This page connects the user to the database.
    $servername="localhost";
    $username="root";
    $password="root";
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
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Minibus";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully <br>"; //commented to remove annoying message no longer needed!
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage()."<br>";
    }
?>
