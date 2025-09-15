<?php
require_once 'config.php';

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

if ($conexion) {
    echo "✅ Conectado con MySQLi\n";
    echo "📊 Base: " . DB_NAME . "\n";
    mysqli_close($conexion);
} else {
    echo "❌ Error: " . mysqli_connect_error() . "\n";
}
?>
