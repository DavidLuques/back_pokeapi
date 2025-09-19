<?php
require_once 'config.php';

class DatabaseConfig
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }

        $this->conexion->set_charset("utf8mb4");
    }

    public function query($sql)
    {
        $resultado = $this->conexion->query($sql);

        if ($resultado === false) {
            throw new Exception("Error en la consulta: " . $this->conexion->error);
        }

        if ($resultado instanceof mysqli_result) {
            return $resultado->fetch_all(MYSQLI_ASSOC);
        }

        return true;
    }

    public function close(): void
    {
        $this->conexion->close();
    }

    public function deletePokemon($id)
    {
        $id = (int) $id; // aseguramos que sea entero
        $sql = "DELETE FROM POKEMONES WHERE id = $id";
        return $this->conexion->query($sql);
    }
}
