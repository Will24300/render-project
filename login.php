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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Invalid email or password.";
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
            <a href="signup.php" class="btn btn-secondary">Sign Up</a>
        </div>
    </header>

    <div class="auth-container">
        <form class="auth-form" method="POST" action="">
            <h2>Welcome Back</h2>
            
            <?php if (!empty($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="you@example.com">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
            
            <div class="auth-links">
                Don't have an account? <a href="signup.php">Create one here</a>.
            </div>
        </form>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> CodeMastery Portal. All rights reserved.</p>
    </footer>
</body>
</html>
