<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = sanitizeInput($_POST["token"]);
    $newPassword = hashPassword($_POST["password"]);

    // Verify token
    $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password and clear reset token
        $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE reset_token = ?");
        $stmt->bind_param("ss", $newPassword, $token);
        $stmt->execute();
        echo "Password successfully reset!";
    } else {
        echo "Invalid or expired reset token.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST">
        <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? $_GET['token'] : ''; ?>">
        <input type="password" name="password" required placeholder="Enter new password">
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
