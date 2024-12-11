<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $host = 'localhost';
    $db = 'websitedb';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email is "admin" and password is "admin"
        if ($email === 'admin' && $password === 'admin') {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $email;
            header("Location: admin.php");
            exit();
        }

        // Check if the email is in a valid format, except for "admin"
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) && $email !== 'admin') {
            echo "<script>alert('Please enter a valid email address.');</script>";
        } else {
            // Check if the user exists in the user table
            $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // If user exists and the password matches
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $email;
                header("Location: user.php"); // Redirect to the user page
                exit();
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
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
        <title>Login</title>
        <link rel="stylesheet" href="blog.css">
    </head>
    <body>
        <header class="login-header">
            <h1>Login</h1>
        </header>
        <div class="login-container">
            <div class="login-card">
                <button class="close-button" id="closeButton" onclick="location.href='index.php';">&times;</button>

                <h2>Welcome</h2>
                <form class="login-form" method="POST" action="">
                    <div class="input-group">
                        <input type="text" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="input-group">
                        <div class="password-field">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <button type="submit" class="login-button">LOGIN</button>
                </form>
                <p class="signup-text">Don’t have an account? <a href="register.php">Sign Up</a></p>
            </div>
        </div>
    </body>
</html>
