<?php
require_once 'conexion.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido");
}

$id = (int)$_GET['id'];

$db = new DatabaseConfig();
$sql = "SELECT * FROM POKEMONES WHERE id = $id";
$result = $db->query($sql);
$datos = $result[0] ?? null;

if (!$datos) {
    die("Pokémon no encontrado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/header.css">
    <title>Editar Pokémon - Pokedex</title>
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
                    <h1 class="navbar-text title-box fw-bold title">AGREGAR POKÉMON</h1>

                    <!-- Botón volver -->
                    <a href="index.php" class="btn btn-outline-secondary ms-auto" style="border: 2px solid #000;">
                        <i class="bi bi-arrow-left"></i> Volver al Pokédex
                    </a>
                </div>
            </div>
        </nav>
    </header>
<main class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="border:2px solid #000;">
                <div class="card-header bg-warning">
                    <h4 class="mb-0"><i class="bi bi-pencil"></i> Editar Pokémon</h4>
                </div>
                <div class="card-body">
                    <form action="actualizar_pokemon.php" method="POST" enctype="multipart/form-data">
                        <!-- Campo oculto para el ID -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($datos['id']) ?>">

                        <div class="mb-3">
                            <label for="identificador" class="form-label">Identificador</label>
                            <input type="text" class="form-control" id="identificador" name="identificador"
                                   value="<?= htmlspecialchars($datos['identificador']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                   value="<?= htmlspecialchars($datos['nombre']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <input type="text" class="form-control" id="tipo" name="tipo"
                                   value="<?= htmlspecialchars($datos['tipo']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3"><?= htmlspecialchars($datos['descripcion']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Imagen actual:</label><br>
                            <?php if (!empty($datos['imagen_ruta'])): ?>
                                <img src="<?= htmlspecialchars($datos['imagen_ruta']) ?>" width="120">
                            <?php else: ?>
                                <em>Sin imagen</em>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="imagen" class="form-label">Subir nueva imagen (opcional)</label>
                            <input type="file" name="imagen" id="imagen" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>