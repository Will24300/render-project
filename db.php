<?php
// db.php - PostgreSQL version for Render.com

// Get database URL from environment variable (Render sets this automatically)
$database_url = getenv('DATABASE_URL');

if ($database_url) {
    // Parse Render's DATABASE_URL
    $db = parse_url($database_url);
    
    $host = $db['host'];
    $port = $db['port'];
    $dbname = ltrim($db['path'], '/');
    $username = $db['user'];
    $password = $db['pass'];
} else {
    // Fallback for local development
    $host = getenv('PGHOST') ?: 'localhost';
    $port = getenv('PGPORT') ?: '5432';
    $dbname = getenv('PGDATABASE') ?: 'coding_courses';
    $username = getenv('PGUSER') ?: 'postgres';
    $password = getenv('PGPASSWORD') ?: '';
}

try {
    // PostgreSQL connection string
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]);
    
    // Set schema if needed
    // $pdo->exec("SET search_path TO public");
    
} catch(PDOException $e) {
    // Log error and display user-friendly message
    error_log("Database connection failed: " . $e->getMessage());
    die("Sorry, we're experiencing technical difficulties. Please try again later.");
}
?>