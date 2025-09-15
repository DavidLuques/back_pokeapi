<?php
// Cargar variables de entorno desde .env (método súper simple)
if (file_exists('.env')) {
    $env = parse_ini_file('.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Configuración de Base de Datos
define('DB_HOST', $_ENV['DB_HOST'] ?? 'localhost');
define('DB_USER', $_ENV['DB_USER'] ?? 'root');
define('DB_PASS', $_ENV['DB_PASS'] ?? '');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'db_name');
define('DB_PORT', $_ENV['DB_PORT'] ?? 3306);
?>