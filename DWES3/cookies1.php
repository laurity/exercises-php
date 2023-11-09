<?php
if (!isset($_COOKIE["visitas"])) {
    $visitas = 1;
} else {
    $visitas = $_COOKIE["visitas"];
    $visitas++;
}

if (isset($_POST["borrar"])) {
    // Borrar la cookie y reiniciar el contador
    setcookie("visitas", "", time() - 1, "/");
    $visitas = 0;
    // Redirigir o mostrar un mensaje indicando que las cookies han sido borradas
    header("Refresh:0"); // Recargar la página para reflejar el cambio en las cookies
}

setcookie("visitas", $visitas, time() + 3600 * 24, "/");
echo "Número de visitas: " . $visitas;
echo "<br>";
print_r($_COOKIE);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de visitas</title>
</head>
<body>
    <h1>COOKIES</h1>
    <form method="post">
        <button type="submit" value="borrar" name="borrar">Borrar Cookies y Reiniciar</button>
    </form>
</body>
</html>