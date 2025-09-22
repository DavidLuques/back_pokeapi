<?php
require_once 'conexion.php';

$db = new DatabaseConfig();

if (!isset($_GET['id']) || $_GET['id'] === '') {
    die('ID no proporcionado.');
}

$id = intval($_GET['id']); // lo convertimos a número por seguridad

$sql = "SELECT id, identificador, imagen_ruta, nombre, tipo, descripcion
        FROM POKEMONES
        WHERE id = $id";

$resultado = $db->query($sql);

// Si tu método `query` devuelve un mysqli_result, usá fetch_assoc()
if ($resultado instanceof mysqli_result) {
    $pokemon = $resultado->fetch_assoc();
} else {
    $pokemon = $resultado[0] ?? null;
}

if (!$pokemon) {
    die('Pokémon no encontrado.');
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Vista - Pokédex</title>
    <style>
        @media screen and (max-width: 992px) {
            .contenedor-main {
                display: flex;
                flex-direction: column!important;
                align-items: center!important;
            }

            .info-pokemon {
                margin-left: 10px;
                margin-right: 10px;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
            <div class="container-fluid">
                <div class="d-flex align-items-center w-100">
                    <!-- Logo -->
                    <a class="navbar-brand logo-box" href="index.php">
                        <img src="./public/pokeball-logo3.webp" style="width: 75%;" alt="Logo">
                    </a>

                    <!-- Título -->
                    <h1 class="navbar-text title-box fw-bold title">POKEDEX</h1>

                    <!-- Botón volver -->
                    <a href="index.php" class="btn btn-outline-secondary ms-auto" style="border: 2px solid #000;">
                        <i class="bi bi-arrow-left"></i> Volver al Pokédex
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="contenedor-main" style="display: flex; flex-direction: row; justify-content: center; align-items: flex-start; gap: 20px; margin-top: 30px;">
            <div style="border: 1px solid black;">
                <img src="<?= htmlspecialchars($pokemon['imagen_ruta']) ?>" alt="<?= htmlspecialchars($pokemon['nombre']) ?>" style="width:400px;">
            </div>
            <div class="info-pokemon">
                <div style="display: flex; flex-direction: row; align-items: center; gap: 15px; margin-bottom: 10px;">
                    <span><strong>Tipo:</strong> <?= htmlspecialchars($pokemon['tipo']) ?></span> |
                    <h1><?= htmlspecialchars($pokemon['nombre']) ?></h1>
                </div>
                <p><strong>Identificador:</strong> <?= htmlspecialchars($pokemon['identificador']) ?></p>
                <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($pokemon['descripcion'])) ?></p>
            </div>
        </div>
    </main>

</body>

</html>