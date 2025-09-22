<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Baja Pokémon - Pokédex</title>
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
                    <h1 class="navbar-text title-box fw-bold title">POKÉMON</h1>

                    <!-- Botón volver -->
                    <a href="index.php" class="btn btn-outline-secondary ms-auto" style="border: 2px solid #000;">
                        <i class="bi bi-arrow-left"></i> Volver al Pokédex
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container my-4">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Eliminar Pokémon</h4>
                <p>¿Estás seguro de que deseas eliminar este Pokémon? Esta acción no se puede deshacer.</p>
                <hr>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                <?php if (isset($_GET['id'])): ?>
                    <a href="baja.php?id=<?php echo htmlspecialchars($_GET['id']); ?>" class="btn btn-danger">Eliminar</a>
                <?php else: ?>
                    <span class="text-danger">ID no especificado</span>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
