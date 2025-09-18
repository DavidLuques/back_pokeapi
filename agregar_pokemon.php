<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/header.css">
    <title>Agregar Pokémon - Pokédex</title>
    <style>
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border: 2px solid #000;
            border-radius: 8px;
            margin-top: 10px;
        }
        .upload-area {
            border: 2px dashed #000;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            background-color: #e9ecef;
        }
        .upload-area.dragover {
            border-color: #007bff;
            background-color: #e3f2fd;
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
                <div class="card" style="border: 2px solid #000; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Nuevo Pokémon</h4>
                    </div>
                    <div class="card-body">
                        <form action="procesar_pokemon.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <!-- Información básica -->
                                <div class="col-md-6">
                                    <h5 class="mb-3"><i class="bi bi-info-circle"></i> Información Básica</h5>
                                    
                                    <div class="mb-3">
                                        <label for="identificador" class="form-label">Identificador *</label>
                                        <input type="text" class="form-control" id="identificador" name="identificador" required
                                               placeholder="Ej: 001, 002, 003..." style="border: 1px solid #000;">
                                        <div class="form-text">Número único del Pokémon</div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre *</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required
                                               placeholder="Ej: Bulbasaur, Charmander..." style="border: 1px solid #000;">
                                    </div>

                                    <div class="mb-3">
                                        <label for="tipo" class="form-label">Tipo *</label>
                                        <select class="form-select" id="tipo" name="tipo" required style="border: 1px solid #000;">
                                            <option value="">Seleccionar tipo...</option>
                                            <option value="Fuego">🔥 Fuego</option>
                                            <option value="Agua">💧 Agua</option>
                                            <option value="Planta">🌱 Planta</option>
                                            <option value="Eléctrico">⚡ Eléctrico</option>
                                            <option value="Hielo">❄️ Hielo</option>
                                            <option value="Lucha">👊 Lucha</option>
                                            <option value="Veneno">☠️ Veneno</option>
                                            <option value="Tierra">🏔️ Tierra</option>
                                            <option value="Volador">🕊️ Volador</option>
                                            <option value="Psíquico">🔮 Psíquico</option>
                                            <option value="Bicho">🐛 Bicho</option>
                                            <option value="Roca">🗿 Roca</option>
                                            <option value="Fantasma">👻 Fantasma</option>
                                            <option value="Dragón">🐉 Dragón</option>
                                            <option value="Siniestro">🌙 Siniestro</option>
                                            <option value="Acero">⚙️ Acero</option>
                                            <option value="Normal">⚪ Normal</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"
                                                  placeholder="Descripción del Pokémon..." style="border: 1px solid #000;"></textarea>
                                    </div>
                                </div>

                                <!-- Carga de imagen -->
                                <div class="col-md-6">
                                    <h5 class="mb-3"><i class="bi bi-image"></i> Imagen del Pokémon</h5>
                                    
                                    <div class="upload-area" id="uploadArea">
                                        <i class="bi bi-cloud-upload" style="font-size: 3rem; color: #6c757d;"></i>
                                        <p class="mt-2 mb-0">Arrastra y suelta una imagen aquí</p>
                                        <p class="text-muted small">o haz clic para seleccionar</p>
                                        <input type="file" id="imagen" name="imagen" accept="image/*" class="d-none">
                                    </div>

                                    <div id="imagePreview" class="text-center" style="display: none;">
                                        <img id="previewImg" class="preview-image" alt="Vista previa">
                                        <div class="mt-2">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="removeImage()" style="border: 1px solid #000;">
                                                <i class="bi bi-trash"></i> Eliminar imagen
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle"></i> Formatos permitidos: JPG, PNG, GIF, WebP<br>
                                            Tamaño máximo: 5MB
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <a href="index.php" class="btn btn-secondary" style="border: 2px solid #000;">
                                            <i class="bi bi-x-circle"></i> Cancelar
                                        </a>
                                        <button type="submit" class="btn btn-success" style="border: 2px solid #000;">
                                            <i class="bi bi-check-circle"></i> Agregar Pokémon
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <script>
        // Elementos del DOM
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('imagen');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        // Eventos para el área de carga
        uploadArea.addEventListener('click', () => fileInput.click());
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });

        // Evento para selección de archivo
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFile(e.target.files[0]);
            }
        });

        // Función para manejar el archivo
        function handleFile(file) {
            // Validar tipo de archivo
            if (!file.type.startsWith('image/')) {
                alert('Por favor selecciona un archivo de imagen válido.');
                return;
            }

            // Validar tamaño (5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('El archivo es demasiado grande. Máximo 5MB.');
                return;
            }

            // Mostrar vista previa
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                imagePreview.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        // Función para eliminar imagen
        function removeImage() {
            fileInput.value = '';
            imagePreview.style.display = 'none';
            uploadArea.style.display = 'block';
        }
    </script>
</body>

</html>
