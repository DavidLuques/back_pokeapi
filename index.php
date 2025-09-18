<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/tabla.css">
    <title>Pokedex</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
            <div class="container-fluid">
                <div class="d-flex align-items-center w-100">
                    <!-- Logo -->
                    <a class="navbar-brand logo-box" href="#">
                        <img src="./public/pokeball-logo3.webp" style="width: 75%;" alt="Logo">
                    </a>

                    <!-- Título -->
                    <h1 class="navbar-text title-box fw-bold title">POKEDEX</h1>

                    <!-- Botón hamburguesa -->
                    <button
                        class="navbar-toggler ms-auto"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarContent"
                        aria-controls="navbarContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <!-- Contenido colapsable -->
                <div class="collapse navbar-collapse mt-2 form-box" id="navbarContent">
                    <form class="d-flex align-items-center gap-2">
                        <input class="form-control" type="text" placeholder="Usuario">
                        <input class="form-control" type="password" placeholder="Contraseña">
                        <button class="btn btn-primary" type="submit">Ingresar</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div style="width: 75%;" class="input-group container-fluid mb-3 mt-5">
            <input type="text" class="form-control" placeholder="Ingrese el nombre, tipo o número de pokémon" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-outline-secondary" type="button" id="button-addon2">Quien es este pokémon?</button>
        </div>

        <?php
        require_once 'conexion.php';

        $db = new DatabaseConfig();

        $sql = "SELECT id, identificador, imagen_ruta, nombre, tipo, descripcion FROM POKEMONES";

        try {
            $pokemones = $db->query($sql);   // $pokemones será un array asociativo
        } catch (Exception $e) {
            die("<p class='text-danger'>" . $e->getMessage() . "</p>");
        }
        ?>

        <?php if (!empty($pokemones)): ?>
            <div class="container mt-4">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Imagen</th>
                            <th>Tipo</th>
                            <th>Nombre</th>
                            <th>ID</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pokemones as $fila): ?>
                            <tr>
                                <td class="columnas">
                                    <div>
                                        <img src="<?= htmlspecialchars($fila['imagen_ruta']) ?>"
                                        alt="<?= htmlspecialchars($fila['nombre']) ?>"
                                        style="width:60px;">
                                    </div>
                                </td>
                                <td class="columnas">
                                    <div>
                                        <?= htmlspecialchars($fila['tipo']) ?>
                                    </div>
                                </td>
                                <td class="columnas">
                                    <div>
                                        <?= htmlspecialchars($fila['nombre']) ?>
                                    </div>
                                </td>
                                <td class="columnas">
                                    <div>
                                        <?= htmlspecialchars($fila['id']) ?>
                                    </div>
                                </td>
                                <td class="columnas">
                                    <div class="d-flex flex-row gap-2">
                                        <button type="button" class="btn btn-dark">Modificación</button>
                                        <button type="button" class="btn btn-dark">Baja</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center mt-4">No hay pokémones cargados.</p>
        <?php endif; ?>

        <?php $db->close(); ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>