<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Voter ID Card</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <div class="container">
        <h2>Register for Voter ID Card</h2>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                include 'db.php';

                $name = $_POST['name'];
                $fatherName = $_POST['fatherName'];
                $motherName = $_POST['motherName'];
                $gender = $_POST['gender'];
                $mobile = $_POST['mobile'];
                $email = $_POST['email'];
                $aadhar = $_POST['aadhar'];
                $address = $_POST['address'];
                $pincode = $_POST['pincode'];
                $dob = $_POST['dob'];
                $password = $_POST['password'];

                // Hash the password for security
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Handle file upload
                $aadharFile = $_FILES['aadharFile'];
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $uploadFilePath = $uploadDir . basename($aadharFile['name']);
                if (!move_uploaded_file($aadharFile['tmp_name'], $uploadFilePath)) {
                    echo "<p style='color: red;'>Error uploading Aadhar file. Please try again.</p>";
                    exit();
                }

                // Generate a unique Voter ID
                $voterID = "VOTER" . rand(10000, 99999);

                // Use prepared statements to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO voters (name, fatherName, motherName, gender, mobile, email, aadhar, address, pincode, aadharFile, password, dob, voterID) 
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssssss", $name, $fatherName, $motherName, $gender, $mobile, $email, $aadhar, $address, $pincode, $uploadFilePath, $hashedPassword, $dob, $voterID);

                if ($stmt->execute()) {
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['voterID'] = $voterID;
                    header("Location: register_success.php");
                    exit();
                } else {
                    echo "<p style='color: red;'>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
            }
        ?>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="fatherName">Father's Name:</label>
            <input type="text" id="fatherName" name="fatherName" required><br>

            <label for="motherName">Mother's Name:</label>
            <input type="text" id="motherName" name="motherName" required><br>

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select><br>

            <label for="mobile">Mobile Number:</label>
            <input type="tel" id="mobile" name="mobile" required><br>

            <label for="email">Email ID:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="aadhar">Aadhar Number:</label>
            <input type="text" id="aadhar" name="aadhar" required><br>

            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required><br>

            <label for="pincode">Pincode:</label>
            <input type="text" id="pincode" name="pincode" required><br>
            
            <label for="aadharFile">Upload Aadhar Card (PDF/PNG)</label>
            <input type="file" id="aadharFile" name="aadharFile" accept=".pdf, .png" required><br>

            <label for="dob">Date of Birth:</label>
            <input type="date" id="dob" name="dob" required><br>

            <label for="password">Create Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html>
