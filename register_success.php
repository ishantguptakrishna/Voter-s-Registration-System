<?php
    session_start();
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : "Voter"; // Retrieve the voter's name from the session
    $voterID = isset($_SESSION['voterID']) ? $_SESSION['voterID'] : "N/A"; // Retrieve the voter's ID from the session
    session_destroy(); // End the session after displaying the message
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Success</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Registration Successful!</h2>
        <p>Congratulations, <?php echo htmlspecialchars($name); ?>! You have been successfully registered.</p>
        <p>Your Voter ID: <strong><?php echo htmlspecialchars($voterID); ?></strong></p>
        <p>Further details will be sent to your registered email.</p>
        <a href="index.php" class="button">Go to Home</a>
    </div>

</body>
</html>