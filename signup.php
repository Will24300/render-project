<?php
// Add this line before session_start()
ini_set('session.save_path', '/tmp');

session_start();
require_once 'db.php';
// ... rest of your code

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error = "Please fill in all fields.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            $error = "Username or Email already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($insert->execute([$username, $email, $hashedPassword])) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volonte E-Learning Platform</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">CodeMastery</div>
        <div class="auth-buttons">
            <a href="login.php" class="btn btn-secondary">Login</a>
        </div>
    </header>

    <div class="auth-container">
        <form class="auth-form" method="POST" action="">
            <h2>Create Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required placeholder="johndoe">
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="you@example.com">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required placeholder="••••••••">
            </div>
            
            <button type="submit" class="btn btn-primary">Sign Up</button>
            
            <div class="auth-links">
                Already have an account? <a href="login.php">Login here</a>.
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> CodeMastery Portal. All rights reserved.</p>
    </footer>
</body>
</html>
