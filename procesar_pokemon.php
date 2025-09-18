<?php
require_once 'conexion.php';

// Inicializar variables de mensaje
$mensaje = '';
$tipo_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar datos requeridos
    $identificador = trim($_POST['identificador'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $tipo = trim($_POST['tipo'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');

    // Validaciones
    $errores = [];

    if (empty($identificador)) {
        $errores[] = 'El identificador es requerido';
    } elseif (!preg_match('/^\d+$/', $identificador)) {
        $errores[] = 'El identificador debe contener solo números';
    }

    if (empty($nombre)) {
        $errores[] = 'El nombre es requerido';
    }

    if (empty($tipo)) {
        $errores[] = 'El tipo es requerido';
    }

    // Si hay errores, mostrar formulario con errores
    if (!empty($errores)) {
        $mensaje = implode('<br>', $errores);
        $tipo_mensaje = 'danger';
    } else {
        try {
            $db = new DatabaseConfig();
            
            // Verificar si ya existe un pokémon con ese identificador
            $sql_check = "SELECT id FROM POKEMONES WHERE identificador = '$identificador'";
            $existe = $db->query($sql_check);
            
            if (!empty($existe)) {
                $mensaje = 'Ya existe un pokémon con el identificador ' . $identificador;
                $tipo_mensaje = 'warning';
            } else {
                // Procesar imagen si se subió
                $imagen_ruta = '';
                if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                    $imagen_ruta = procesarImagen($_FILES['imagen'], $identificador);
                    if (!$imagen_ruta) {
                        $mensaje = 'Error al procesar la imagen. Verifica el formato y tamaño.';
                        $tipo_mensaje = 'danger';
                    }
                }
                
                // Si no hay error con la imagen, insertar pokémon
                if ($tipo_mensaje !== 'danger') {
                    $sql = "INSERT INTO POKEMONES (identificador, nombre, tipo, descripcion, imagen_ruta) VALUES ('$identificador', '$nombre', '$tipo', '$descripcion', '$imagen_ruta')";
                    $resultado = $db->query($sql);
                    
                    if ($resultado !== false) {
                        $mensaje = "Pokémon '{$nombre}' agregado exitosamente";
                        if ($imagen_ruta) {
                            $mensaje .= " con imagen";
                        }
                        $tipo_mensaje = 'success';
                        
                        // Redirigir después de 2 segundos
                        header("refresh:2;url=index.php");
                    } else {
                        $mensaje = 'Error al agregar el pokémon en la base de datos';
                        $tipo_mensaje = 'danger';
                    }
                }
            }
            
            $db->close();
            
        } catch (Exception $e) {
            $mensaje = 'Error: ' . $e->getMessage();
            $tipo_mensaje = 'danger';
        }
    }
}

function procesarImagen($archivo, $identificador) {
    // Configuración
    $directorio = 'public/images/';
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $tamaño_maximo = 5 * 1024 * 1024; // 5MB
    
    // Verificar errores de subida
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        return false;
    }
    
    // Verificar tamaño
    if ($archivo['size'] > $tamaño_maximo) {
        return false;
    }
    
    // Obtener información del archivo
    $info_archivo = pathinfo($archivo['name']);
    $extension = strtolower($info_archivo['extension']);
    
    // Verificar extensión
    if (!in_array($extension, $extensiones_permitidas)) {
        return false;
    }
    
    // Verificar que sea realmente una imagen
    $tipo_mime = mime_content_type($archivo['tmp_name']);
    if (!str_starts_with($tipo_mime, 'image/')) {
        return false;
    }
    
    // Crear directorio si no existe
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true);
    }
    
    // Generar nombre único
    $nombre_archivo = 'pokemon_' . $identificador . '_' . time() . '.' . $extension;
    $ruta_completa = $directorio . $nombre_archivo;
    
    // Mover archivo
    if (move_uploaded_file($archivo['tmp_name'], $ruta_completa)) {
        // Crear versión redimensionada si es muy grande
        redimensionarImagen($ruta_completa, $ruta_completa, 400, 400);
        
        return $ruta_completa;
    }
    
    return false;
}

function redimensionarImagen($origen, $destino, $ancho_max, $alto_max) {
    // Obtener información de la imagen
    $info = getimagesize($origen);
    if (!$info) return false;
    
    $ancho_original = $info[0];
    $alto_original = $info[1];
    $tipo = $info[2];
    
    // Si la imagen es más pequeña que el máximo, no redimensionar
    if ($ancho_original <= $ancho_max && $alto_original <= $alto_max) {
        return true;
    }
    
    // Calcular nuevas dimensiones manteniendo proporción
    $ratio = min($ancho_max / $ancho_original, $alto_max / $alto_original);
    $nuevo_ancho = intval($ancho_original * $ratio);
    $nuevo_alto = intval($alto_original * $ratio);
    
    // Crear imagen desde archivo original
    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $imagen_original = imagecreatefromjpeg($origen);
            break;
        case IMAGETYPE_PNG:
            $imagen_original = imagecreatefrompng($origen);
            break;
        case IMAGETYPE_GIF:
            $imagen_original = imagecreatefromgif($origen);
            break;
        case IMAGETYPE_WEBP:
            $imagen_original = imagecreatefromwebp($origen);
            break;
        default:
            return false;
    }
    
    if (!$imagen_original) return false;
    
    // Crear nueva imagen redimensionada
    $imagen_nueva = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    
    // Preservar transparencia para PNG y GIF
    if ($tipo == IMAGETYPE_PNG || $tipo == IMAGETYPE_GIF) {
        imagealphablending($imagen_nueva, false);
        imagesavealpha($imagen_nueva, true);
        $transparente = imagecolorallocatealpha($imagen_nueva, 255, 255, 255, 127);
        imagefill($imagen_nueva, 0, 0, $transparente);
    }
    
    // Redimensionar
    imagecopyresampled($imagen_nueva, $imagen_original, 0, 0, 0, 0, 
                      $nuevo_ancho, $nuevo_alto, $ancho_original, $alto_original);
    
    // Guardar imagen redimensionada
    $resultado = false;
    switch ($tipo) {
        case IMAGETYPE_JPEG:
            $resultado = imagejpeg($imagen_nueva, $destino, 85);
            break;
        case IMAGETYPE_PNG:
            $resultado = imagepng($imagen_nueva, $destino, 8);
            break;
        case IMAGETYPE_GIF:
            $resultado = imagegif($imagen_nueva, $destino);
            break;
        case IMAGETYPE_WEBP:
            $resultado = imagewebp($imagen_nueva, $destino, 85);
            break;
    }
    
    // Liberar memoria
    imagedestroy($imagen_original);
    imagedestroy($imagen_nueva);
    
    return $resultado;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Procesando Pokémon - Pokédex</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card" style="border: 2px solid #000;">
                    <div class="card-body text-center">
                        <?php if ($tipo_mensaje === 'success'): ?>
                            <div class="alert alert-success" style="border: 2px solid #000;">
                                <i class="bi bi-check-circle" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">¡Éxito!</h4>
                                <p><?= htmlspecialchars($mensaje) ?></p>
                                <p class="text-muted">Redirigiendo al Pokédex...</p>
                                <div class="spinner-border text-success" role="status">
                                    <span class="visually-hidden">Cargando...</span>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-<?= $tipo_mensaje ?>" style="border: 2px solid #000;">
                                <i class="bi bi-exclamation-triangle" style="font-size: 3rem;"></i>
                                <h4 class="mt-3">Error</h4>
                                <p><?= $mensaje ?></p>
                                <a href="agregar_pokemon.php" class="btn btn-primary" style="border: 2px solid #000;">
                                    <i class="bi bi-arrow-left"></i> Volver al formulario
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>
