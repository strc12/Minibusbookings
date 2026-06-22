<?php
    header("Location: users.php");
    print_r($_POST);
    $username=$_POST["surname"].".".$_POST["forename"][0];
    //$username="bob";
    if($_POST["role"]=="pupil"){
        $role=0;
    }else{
        $role=1;
    }
   
     while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        echo "<tblstaff>"
            echo "Firstname";
            echo "Surname";
            echo "Role";
            echo "Email";
            echo "Password";
            echo "Phone";
            echo "Initials";
            echo "Licencetodrive"
        }
        echo "</tblstaff>";
     else {
        echo "No users found.";
    }
?>