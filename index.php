<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Voter Registration System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Welcome Page -->
    <div id="welcomePage">
        <header>
            <img src="logo.jpeg" alt="Organization Logo" id="logo">
            <h1>
                <?php
                    // Set the correct timezone
                    date_default_timezone_set("Asia/Kolkata"); // Replace with your timezone
                    $hour = date("H");
                    if ($hour < 12) {
                        echo "Good Morning! Welcome to the Voter Registration System";
                    } elseif ($hour < 18) {
                        echo "Good Afternoon! Welcome to the Voter Registration System";
                    } else {
                        echo "Good Evening! Welcome to the Voter Registration System";
                    }
                ?>
            </h1>
        </header>
        <div class="navigation">
            <a href="login.php" class="button">Login to Vote</a>
            <a href="register.php" class="button">Register for Voter ID Card</a>
        </div>
    </div>

</body>
</html>
