<?php
// Configuración de la base de datos
$host = 'mysql:dbname=dwes_t3;host=127.0.0.1';
$db = 'dwes_t3';
$user = 'root';
$pass = '';

// Intentar la conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Habilitar el manejo de errores de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Verificar si el formulario de inicio de sesión ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    // Consulta preparada para evitar inyecciones SQL
    $stmt = $pdo->prepare("SELECT id, nombre_usuario, contrasena FROM usuarios WHERE nombre_usuario = ?");
    $stmt->execute([$nombre_usuario]);

    // Obtener el resultado de la consulta
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y la contraseña es correcta
    if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
        // Inicio de sesión exitoso
        session_start();
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
        header('Location: pagina_de_inicio.php'); // Redirigir a la página de inicio
        exit();
    } else {
        // Credenciales incorrectas
        echo "Nombre de usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form method="post" action="">
        <label for="nombre_usuario">Nombre de Usuario:</label>
        <input type="text" name="nombre_usuario" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>
        <br>
        <input type="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
