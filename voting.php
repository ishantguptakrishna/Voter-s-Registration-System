<!-- filepath: c:\Users\gupta\Desktop\NSP Project\voting.php -->
<?php
    // Start the session to track the user
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['voterID'])) {
        echo "<p style='color: red;'>You must log in to vote.</p>";
        header("refresh:2;url=login.php");
        exit();
    }

    // Include database connection
    include 'db.php';

    // Handle vote submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $voterID = $_SESSION['voterID']; // Get the voter ID from the session
        $selectedParty = $_POST['party']; // Get the selected party

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO votes (voterID, party) VALUES (?, ?)");
        $stmt->bind_param("ss", $voterID, $selectedParty);

        if ($stmt->execute()) {
            header("Location: voting_success.php");
            exit();
        } else {
            echo "<p style='color: red;'>Error recording your vote: " . $conn->error . "</p>";
        }

        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Now</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Vote for Your Preferred Party</h2>
        <form action="voting.php" method="post">
            <ul>
                <li>
                    <label>
                        <input type="radio" name="party" value="Party 1" required> Party 1
                    </label>
                </li>
                <li>
                    <label>
                        <input type="radio" name="party" value="Party 2" required> Party 2
                    </label>
                </li>
                <li>
                    <label>
                        <input type="radio" name="party" value="Party 3" required> Party 3
                    </label>
                </li>
                <li>
                    <label>
                        <input type="radio" name="party" value="NOTA" required> NOTA
                    </label>
                </li>
            </ul>
            <button type="submit">Submit Vote</button>
        </form>
    </div>

</body>
</html>
