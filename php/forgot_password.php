<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitizeInput($_POST["email"]);

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
        $stmt->bind_param("ss", $token, $email);
        $stmt->execute();

        // Create reset link
        $resetLink = "http://yourwebsite.com/reset_password.php?token=" . $token;

        // Send email (Replace with actual mail sending logic)
        $subject = "Password Reset Request";
        $message = "Click the link below to reset your password:\n$resetLink";
        $headers = "From: no-reply@yourwebsite.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset link sent! Check your email.";
        } else {
            echo "Failed to send email. Please try again.";
        }
    } else {
        echo "No account found with this email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
</head>
<body>
    <h2>Forgot Password</h2>
    <form method="POST">
        <input type="email" name="email" required placeholder="Enter your email">
        <button type="submit">Submit</button>
    </form>
</body>
</html>
