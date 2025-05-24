<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);
    $abc = sanitizeInput($_POST['abc']); // New input for abc
    $hashedPassword = hashPassword($password);

    $sql = "INSERT INTO users (username, password, email, abc) VALUES ('$username', '$hashedPassword', '$email', '$abc')";
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
    <style>
        body {
            background-color: #d4efdb; /* Updated background color */
        }
        button {
            background-color: #237854; /* Updated button color */
            color: white;
        }
        button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover */
        }
    </style>
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
            
            <label for="abc">Select ABC:</label>
            <select id="abc" name="abc" required>
                <option value="ABC-1">ABC-1</option>
                <option value="ABC-2">ABC-2</option>
                <option value="ABC-3">ABC-3</option>
            </select>
            
            <button type="submit">Sign Up</button>
        </form>

        <div class="or-divider">Or</div>

        <!-- Removed social login buttons -->

        <p>Already have an account? <a href="login.php">Login</a>.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>