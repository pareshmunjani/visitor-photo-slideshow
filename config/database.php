
<?php

require_once __DIR__ . '/env.php';

// Read database configuration.
$host = $_ENV['DB_HOST'] ?? 'localhost';
$port = $_ENV['DB_PORT'] ?? '3306';
$dbname = $_ENV['DB_NAME'] ?? '';
$username = $_ENV['DB_USER'] ?? '';
$password = $_ENV['DB_PASS'] ?? '';

// PDO connection settings.
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
];

// Create database connection.
try {

    $pdo = new PDO($dsn, $username, $password, $options);

} catch (PDOException $e) {

    error_log('Database connection failed: ' . $e->getMessage());

    throw new RuntimeException(
        'Unable to connect to the database. Check your configuration.'
    );
}
