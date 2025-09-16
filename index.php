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

    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <div class="container-fluid">
            <div class="d-flex align-items-center w-100">
                <!-- Logo -->
                <a class="navbar-brand logo-box" href="#">
                    <img src="./public/pokeball.webp" style="width: 50%;" alt="Logo">
                </a>

                <!-- Título -->
                <span class="navbar-text title-box fw-bold">Mi Sitio</span>

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
    <h1>Pokedex</h1>
    <img src="./public/001.png" alt="bulbasur">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>