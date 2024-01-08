<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Otros elementos en el encabezado -->
</head>
<body>
    <?php
    // Obtener el parámetro 'imagen' de la URL
    $imagen = isset($_GET['imagen']) ? $_GET['imagen'] : '';

    if (!empty($imagen)) {
    ?>
        <!-- Especifica el ancho y alto deseados -->
        <img src="<?php echo $imagen; ?>" alt="Evidencia" style="max-width: 1200px; height: auto;">
    <?php
    } else {
        echo 'Sin evidencia';
    }
    ?>
</body>
</html>

