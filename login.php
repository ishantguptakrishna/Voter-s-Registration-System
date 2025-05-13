<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to Vote</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Login to Vote</h2>
        <?php
            session_start();
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'db.php';

                $voterID = $_POST['voterID'];
                $password = $_POST['password'];
                $dob = $_POST['dob'];

                // Validate credentials against the database
                $sql = "SELECT * FROM voters WHERE voterID = '$voterID' AND dob = '$dob'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['voterID'] = $voterID;
                        echo "<p style='color: green;'>Login successful! Redirecting to voting page...</p>";
                        header("refresh:2;url=voting.php");
                    } else {
                        echo "<p style='color: red;'>Invalid password. Please try again.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Invalid Voter ID or Date of Birth. Please try again.</p>";
                }

                $conn->close();
            }
        ?>
        <form action="login.php" method="post">
            <label for="voterID">Voter ID:</label>
            <input type="text" id="voterID" name="voterID" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html>
