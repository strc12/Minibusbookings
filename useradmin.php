<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generic Page Design</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/site.css" rel="stylesheet">
</head>
<body>

<?php
    $currentPage = 'users';
    include 'includes/navbar.php';
    include_once("connection.php");
    try {
    $stmt = $conn->prepare("SELECT * FROM tblstaff");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!-- Hero Section -->
<section class="hero-section text-center">
    <div class="container">
        <h1>Generic page design</h1>
        <form method="POST">
    <label for="users">Choose a user:</label>
    <select name="StaffID" id="StaffID" required>
        <?php foreach ($rows as $row): ?>
            <option value="<?php echo $row["StaffID"]; ?>">
                <?php echo $row["FirstName"]." ".$row["Surname"]; ?>
        </option>
        <?php endforeach; ?>
    </select>
    <button type="submit" formaction="deleteuser.php">Delete</button>
    <button type="submit" formaction="viewuser.php">View</button>
    <button type="submit" formaction="edituser.php">Edit</button>


</form>

</select> 
</select>

</script>

    </div>
</section>


</body>
</html>

