<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DatabaseConfig();

    $sql = "DELETE FROM POKEMONES WHERE id = $id";
    $db->query($sql);
    $db->close();

    header("Location: index.php");
    exit;
} else {
    echo "ID no especificado";
}