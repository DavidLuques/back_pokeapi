<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DatabaseConfig();

    $db->deletePokemon($id);
    $db->close();

    header("Location: index.php");
    exit;
} else {
    echo "ID no especificado";
}
