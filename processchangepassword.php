<?php
    session_start();
    #array_map ("htmlspecialchars",$_POST);
    include_once("connection.php");
    $stmt1= $conn->prepare("SELECT * FROM TblStaff WHERE Email=:Email" );
    $stmt1->bindParam(":Email",$_SESSION["Email"]);
    $stmt1->execute();
    $hashedpassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt3 = $conn->prepare("
        UPDATE TblStaff
        SET Password = :Password
        WHERE Email = :Email
    ");
    $stmt3->bindParam(":Password", $hashedpassword);
    $stmt3->bindParam(":Email", $_SESSION["Email"]);
    $stmt3->execute();
?>
<script type="text/javascript">
    alert("Password changed successfully");
    <?php
    session_start();
    session_destroy();
    header("Location: index.php");  
    exit();
    ?>
    location="login.php";
</script>
