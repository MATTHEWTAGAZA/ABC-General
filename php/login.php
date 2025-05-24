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
            if ($user['abc'] === 'ABC-1') {
                echo "<script>window.location.href='PatientRecord1.php';</script>";
            } elseif ($user['abc'] === 'ABC-2') {
                echo "<script>window.location.href='PatientRecord2.php';</script>";
            } elseif ($user['abc'] === 'ABC-3') {
                echo "<script>window.location.href='PatientRecord3.php';</script>";
            } else {
                echo "<script>alert('Invalid branch value!');</script>";
            }
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
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #d4efdb; /* Updated background color */
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #237854;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #237854; /* Updated button color */
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #1e6a48; /* Slightly darker shade for hover effect */
        }
        .or-divider {
            text-align: center;
            margin: 15px 0;
            color: #888;
        }
        p {
            text-align: center;
            margin-top: 10px;
        }
        p a {
            color: #237854;
            text-decoration: none;
            font-weight: bold;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
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
        <button onclick="window.open('Homepage.php', '_self');" style="display: block; text-align: center; margin-top: 10px; background-color: darkblue; color: white; padding: 10px; border-radius: 5px; text-decoration: none;">Home</button>
        <div class="or-divider">Or</div>
        <p>Don't have an account? <a href="register.php">Sign up</a>.</p>
    </div>
    <script src="script.js"></script>
</body>
</html>