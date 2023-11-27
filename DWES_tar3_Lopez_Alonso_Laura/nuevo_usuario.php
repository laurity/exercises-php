<?php
function conectarBD()
{
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    try {
        return new PDO($cadena_conexion, $usuario, $clave);
    } catch (PDOException $e) {
        echo "Error conectar BD: " . $e->getMessage();
    }
}

$conn = conectarBD();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['usuario'] && $_POST['nombre'] && $_POST['clave'] && $_POST['correo']) {
        $usuario = $_POST['usuario'];
        $nombre = $_POST['nombre'];
        $clave = $_POST['clave'];
        $correo = $_POST['correo'];

        $verificar_usuario = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = :usuario");
        $verificar_usuario->bindParam(':usuario', $usuario);
        $verificar_usuario->execute();

        if ($verificar_usuario->fetchColumn() == 0) {   //Recuento de filas
            $rol = "usuario";
            $consulta = $conn->prepare("INSERT INTO usuarios (usuario, nombre, clave, rol, correo) VALUES (:usuario, :nombre, :clave, :rol, :correo)");
            $consulta->bindParam(':usuario', $usuario);
            $consulta->bindParam(':nombre', $nombre);
            $consulta->bindParam(':clave', $clave);
            $consulta->bindParam(':rol', $rol);
            $consulta->bindParam(':correo', $correo);

            if ($consulta->execute()) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["nombre"] = $nombre;
                $_SESSION["rol"] = "usuario";
                header("Location: pedido.php");
            }
        } else {
            $err = true;
            echo "El nombre de usuario ya está en uso. Por favor, elija otro.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-registro.css">
    <title>Nuevo Usuario</title>
</head>

<body>
    <div class="container">
        <div class="registro">
            <h1>REGISTRO</h1>
            <form method="POST">
                    <label for="usuario">Introduzca nombre usuario:</label>
                    <input type="text" name="usuario" placeholder="Nombre de usuario..." required>
                    <br>
                    <label for="clave">Introduzca clave:</label>
                    <input type="password" name="clave" placeholder="Contraseña..."required>
                    <br>
                    <label for="nombre">Introduzca nombre:</label>
                    <input type="text" name="nombre" placeholder="Nombre..."required>
                <br>
                    <label for="correo">Introduzca correo:</label>
                    <input type="text" name="correo" placeholder="Introduzca correo..."required>
                    <br>
                <button action="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>