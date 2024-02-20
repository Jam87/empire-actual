<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error en la Aplicación</title>
</head>
<body>
    <h1>Error en la Aplicación</h1>
    <p>Ha ocurrido un error en la aplicación. Por favor, inténtalo de nuevo más tarde.</p>
    <?php
    // Mostrar el mensaje de error si está disponible
    if (isset($errorMessage)) {
        echo "<p><strong>Detalles del Error:</strong> $errorMessage</p>";
    }
    ?>
</body>
</html>
