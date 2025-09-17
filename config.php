<?php
// Cargar variables de entorno desde .env (método súper simple)
if (file_exists('.env')) {
    $env = parse_ini_file('.env');
    foreach ($env as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Configuración de Base de Datos
define('DB_HOST', $_ENV['DB_HOST'] ?? 'srv715.hstgr.io');
define('DB_USER', $_ENV['DB_USER'] ?? 'u625329211_prograweb');
define('DB_PASS', $_ENV['DB_PASS'] ?? 'Prograweb2');
define('DB_NAME', $_ENV['DB_NAME'] ?? 'u625329211_pokedex');
define('DB_PORT', $_ENV['DB_PORT'] ?? 3306);
?>