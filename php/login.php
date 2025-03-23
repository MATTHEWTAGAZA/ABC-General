<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = sanitizeInput($_POST['login']);
    $password = sanitizeInput($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$login' OR email = '$login'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (verifyPassword($password, $user['password'])) {
            echo "<script>alert('Login successful!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form id="loginForm" action="login.php" method="POST" onsubmit="return validateLoginForm()">
            <label for="login">Username or Email:</label>
            <input type="text" id="login" name="login" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
           
            
            <button type="submit">Login</button>
        </form>
            <!-- Forgot Password Link -->
            <p><a href="forgot_password.php">Forgot Password?</a></p>
        
            <div class="or-divider">Or</div>

        <!-- Removed social login buttons -->

        <p>Don't have an account? <a href="register.php">Sign up</a>.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>