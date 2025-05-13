<!-- filepath: c:\Users\gupta\Desktop\NSP Project\success.php -->
<?php
    session_start();
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "Voter"; // Retrieve the voter's name from the session
    session_destroy(); // End the session after displaying the name
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Success</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Voting Successful!</h2>
        <p>Thank you, <?php echo htmlspecialchars($name); ?>, for casting your vote!</p>
    </div>

</body>
</html>
