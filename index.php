<?php
session_start();
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM courses ORDER BY id ASC");
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

$selected_slug = isset($_GET['course']) ? $_GET['course'] : (count($courses) > 0 ? $courses[0]['slug'] : '');

$selected_course_id = null;
$selected_course_name = '';

foreach ($courses as $course) {
    if ($course['slug'] === $selected_slug) {
        $selected_course_id = $course['id'];
        $selected_course_name = $course['name'];
        break;
    }
}

if (!$selected_course_id && count($courses) > 0) {
    $selected_course_id = $courses[0]['id'];
    $selected_course_name = $courses[0]['name'];
    $selected_slug = $courses[0]['slug'];
}

$videos = [];
if ($selected_course_id) {
    $vStmt = $pdo->prepare("SELECT * FROM videos WHERE course_id = ? ORDER BY id ASC");
    $vStmt->execute([$selected_course_id]);
    $videos = $vStmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Volonte E-Learning Platform</div>
        
        <ul class="nav-links">
            <?php foreach ($courses as $c): ?>
                <li>
                    <a href="?course=<?php echo htmlspecialchars($c['slug']); ?>" 
                       class="<?php echo $c['slug'] === $selected_slug ? 'active' : ''; ?>">
                        <?php echo htmlspecialchars($c['name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="auth-buttons">
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="display:flex; align-items:center; margin-right: 15px; color: var(--text-secondary); font-weight:600;">
                    Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-secondary">Login</a>
                <a href="signup.php" class="btn btn-primary">Sign Up</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="container">
        <h1 class="page-title">Top <?php echo htmlspecialchars($selected_course_name); ?> Tutorials</h1>
        <p class="page-subtitle">Carefully selected high-quality videos to master <?php echo htmlspecialchars($selected_course_name); ?>.</p>

        <?php if (count($videos) > 0): ?>
            <div class="video-grid">
                <?php foreach ($videos as $video): ?>
                    <div class="video-card">
                        <a href="<?php echo htmlspecialchars($video['video_url']); ?>" target="_blank" class="video-card-link">
                            <div class="thumbnail">
                                <img src="<?php echo htmlspecialchars($video['thumbnail_url']); ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                                <div class="play-icon">
                                    <svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="video-title"><?php echo htmlspecialchars($video['title']); ?></div>
                                <div class="video-stats">
                                    <span class="stat" title="Views">
                                        <svg viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                                        <?php echo htmlspecialchars($video['views']); ?>
                                    </span>
                                    <span class="stat" title="Likes">
                                        <svg viewBox="0 0 24 24"><path d="M14 9h6.36c.64 0 1.15.58 1.05 1.21-.49 3.01-1.61 6.82-5.46 9.49-.3.21-.68.3-.95.3H6.5a1.5 1.5 0 01-1.5-1.5v-10A1.5 1.5 0 016.5 7h4.88l1.41-3.53a1.5 1.5 0 012.82 0L14 9zm-10 1v8H2v-8h2z"/></svg>
                                        <?php echo htmlspecialchars($video['likes']); ?>
                                    </span>
                                    <span class="stat" title="Comments">
                                        <svg viewBox="0 0 24 24"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2v10z"/></svg>
                                        <?php echo htmlspecialchars($video['comments']); ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; color: var(--text-secondary); padding: 3rem;">
                <h2>No videos found for this course.</h2>
            </div>
        <?php endif; ?>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> Volonte Portfolio. Designed for Excellence.</p>
    </footer>
</body>
</html>
