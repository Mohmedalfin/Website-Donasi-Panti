<?php
// config.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Deteksi environment
$env = $_SERVER['HTTP_HOST'] === 'localhost' ? 'local' : 'production';

if ($env === 'local') {
    // Load dari file .env
    function loadEnv($path)
    {
        if (!file_exists($path)) {
            die(".env file not found.");
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0)
                continue;
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
    loadEnv(__DIR__ . '/.env');
} else {
    // Langsung hardcode untuk production
    $_ENV['DB_HOST'] = '127.0.0.1';    // IP atau host database (update sesuai)
    $_ENV['DB_PORT'] = 3306;              // Port MySQL
    $_ENV['DB_DATABASE'] = 'WebDonasi';   // Nama database yang baru (WebDonasi)
    $_ENV['DB_USERNAME'] = 'root'; // Username untuk database (update sesuai)
    $_ENV['DB_PASSWORD'] = ''; // Password untuk database (update sesuai)
}