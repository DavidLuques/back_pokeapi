<?php
require_once 'config.php';

class DatabaseConfig {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8mb4");
    }

    public function query($sql) {
        $resultado = $this->conexion->query($sql);
        if (!$resultado) {
            throw new Exception("Error en la consulta: " . $this->conexion->error);
        }
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function close(): void {
        $this->conexion->close();
    }
}
?>