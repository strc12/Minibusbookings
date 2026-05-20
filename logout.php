Clear all session variables and return to homepage (index.html)
<?php
session_destroy();
header("Location: index.php");  
exit();
?>