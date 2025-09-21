<?php
require_once 'conexion.php';
require_once 'procesar_pokemon.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $identificador = $_POST['identificador'];
    $nombre = $_POST['nombre'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];

    $imagen_sql = '';
    if (!empty($_FILES['imagen']['name'])) {
        $ruta = procesarImagen($_FILES['imagen'], $identificador);
        $imagen_sql = ", imagen_ruta = '$ruta'";
    }

    $db = new DatabaseConfig();
    $sql = "UPDATE POKEMONES 
            SET identificador = '$identificador',
                nombre = '$nombre',
                tipo = '$tipo',
                descripcion = '$descripcion'
                $imagen_sql
            WHERE id = $id";

    $db->query($sql);
    $db->close();

    header("Location: index.php");
    exit;
}