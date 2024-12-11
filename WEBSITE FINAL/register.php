<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database credentials
    $host = 'localhost'; // Database host
    $db = 'websitedb';   // Database name
    $user = 'root';      // Database username
    $pass = '';          // Database password (leave empty if not set)

    try {
        // Establish database connection
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Retrieve form data
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        // Check if passwords match
        if ($password !== $confirmPassword) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // Check if the email or username already exists
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email OR username = :username");
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // If email or username already exists, show an error message
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Email or username is already registered. Please use a different one.');</script>";
            } else {
                // Hash the password
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Insert data into the 'user' table
                $stmt = $pdo->prepare("INSERT INTO user (fullname, username, email, password) VALUES (:fullname, :username, :email, :password)");
                $stmt->bindParam(':fullname', $fullname);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashedPassword);

                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful!'); window.location.href = 'login.php';</script>";
                } else {
                    echo "<script>alert('Error registering user.');</script>";
                }
            }
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="blog.css">
</head>
<body>
    <header class="login-header">
        <h1>Register</h1>
    </header>
    <div class="login-container">
        <div class="login-card">
            <button class="close-button" id="closeButton" onclick="location.href='index.php';">&times;</button>
            
            <h2 class="welcome-text">Sign Up</h2>
            <form class="register-form" method="POST" action="">
                <div class="input-group">
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-group">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="register-button">REGISTER</button>
            </form>
            <p class="login-text">Already have an account? <a href="login.php">Log In</a></p>
        </div>
    </div>
</body>
</html>
