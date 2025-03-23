<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $hashedPassword = hashPassword($password);

    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Sign Up</h2>
        <form id="registerForm" action="register.php" method="POST" onsubmit="return validateRegisterForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit">Sign Up</button>
        </form>

        <div class="or-divider">Or</div>

        <!-- Removed social login buttons -->

        <p>Already have an account? <a href="login.php">Login</a>.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>