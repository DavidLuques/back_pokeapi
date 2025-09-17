<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Pokedex</title>
    <style>
        .logo-box {
            flex: 0 0 80px;
        }

        .title-box {
            flex: 1;
            text-align: center;
        }

        .form-box {
            flex: 0 0 400px;
        }

        @media (max-width: 992px) {

            .title-box {
                flex: 0 0 auto;
            }

            .title-box {
                text-align: left;
            }

            .form-box {
                flex: 1 1 100%;
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
                <a class="navbar-brand logo-box" href="#">
                    <img src="./public/pokeball-logo3.webp" style="width: 75%;" alt="Logo">
                </a>

                <!-- Título -->
                <h1 class="navbar-text title-box fw-bold">POKEDEX</h1>

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

    $sql = "SELECT id, identificador, imagen_ruta, nombre, tipo, descripcion 
            FROM POKEMONES";
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0): ?>
        <div class="container mt-4">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Identificador</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($fila = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($fila['id']) ?></td>
                        <td><?= htmlspecialchars($fila['identificador']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($fila['imagen_ruta']) ?>" alt="<?= htmlspecialchars($fila['nombre']) ?>" style="width:60px;">
                        </td>
                        <td><?= htmlspecialchars($fila['nombre']) ?></td>
                        <td><?= htmlspecialchars($fila['tipo']) ?></td>
                        <td><?= htmlspecialchars($fila['descripcion']) ?></td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-center mt-4">No hay pokémones cargados.</p>
    <?php endif; ?>
</main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>