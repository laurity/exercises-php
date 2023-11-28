<?php
function conectarBD()
{
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    try {

        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectar BD: " . $e->getMessage();
    }
}

function comprobar_usuario($usuario, $clave)
{

    $conn = conectarBD();

    $consulta = $conn->prepare("SELECT id, usuario, nombre, rol FROM usuarios WHERE usuario =:usuario AND clave =:clave");
    $consulta->bindParam("usuario", $usuario);
    $consulta->bindParam("clave", $clave);

    $consulta->execute();


    if ($consulta->rowCount() > 0) {
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return array("id" => $row['id'], "usuario" => $row['usuario'], "nombre" => $row['nombre'], "rol" => $row['rol']);
    } else
        return FALSE;
}

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usu = comprobar_usuario($_POST["usuario"], $_POST["clave"]);

    if ($usu == FALSE) {
        $err = TRUE;
        $usuario = $_POST["usuario"];
    } else {
        session_start();
        $_SESSION['id'] = $usu['id'];
        $_SESSION['usuario'] = $_POST["usuario"];
        $_SESSION['nombre'] = $usu['nombre'];
        $_SESSION['rol'] = $usu['rol'];

        if ($_POST["usuario"] === 'admin') {
            header("Location: zona_admin.php");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria</title>
</head>

<body>
    <?php
    if (isset($_SESSION['usuario'])) {
        echo "<h1>Bienvenido, " . $_SESSION['nombre'] . "</h1>";
        echo "<a href='index.php?logout=true'>Cerrar Sesión</a>";
        menu();
        echo "<a href='pedido.php'>Realizar Pedido</a>";
    } else {
        echo "<h1>Iniciar Sesión</h1>";

        if (isset($err)) {
            echo "<p class='incorrect'>Usuario o contraseña incorrectos</p>";
        }

        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
        echo "<label for='usuario'>Usuario: </label>";
        echo "<input value='" . (isset($usuario) ? $usuario : '') . "' name='usuario' placeholder='Usuario...'required> ";
        echo "<label for='clave'>Contraseña: </label>";
        echo "<input type='password' name='clave' placeholder='Contraseña...' required>";
        echo "<button type='submit'>Enviar</button>";
        echo "</form>";

        menu();
        echo "<a href='nuevo_usuario.php'>Regístrese para comenzar el pedido</a>";
    }

    /************LA CARTA VA AQUÍ************************/
    function menu()
    {
        echo "<h1>MENÚ</h1>";
        echo "<table border='2'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Ingredientes</th>";
        echo "<th>Precio</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $conn = conectarBD();
        $consulta = $conn->prepare("SELECT nombre, ingredientes, precio FROM pizzas");
        $consulta->execute();

        foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo "<tr>";
            echo "<td>{$row['nombre']}</td>";
            echo "<td>{$row['ingredientes']}</td>";
            echo "<td>{$row['precio']}€</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
    ?>
</body>

</html>
