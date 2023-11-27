<?php
function conectarBD()
{
    //Funcion ue nos conecta a la base de datos, tenemos que mandarle la direccion ip del host, el usuario, la clave y el nombre de la BD
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";
    try {
        //Se crea el objeto de conexion a la base de datos y se devueve
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch (PDOException $e) {
        echo "Error conectar BD: " . $e->getMessage();
    }
}

function comprobar_usuario($usuario, $clave)
{
    //Nos conectamos a la BD y lo igualamos a conn que sera donde se guarde la conexion
    $conn = conectarBD();
    //preparar la consulta
    $consulta = $conn->prepare("SELECT id, usuario, nombre, rol FROM usuarios WHERE usuario =:usuario AND clave =:clave");
    $consulta->bindParam("usuario", $usuario);
    $consulta->bindParam("clave", $clave);
    //lanzar la consulta
    $consulta->execute();


    if ($consulta->rowCount() > 0) {
        $row = $consulta->fetch(PDO::FETCH_ASSOC);
        return array("id" => $row['id'], "usuario" => $row['usuario'], "nombre" => $row['nombre'], "rol" => $row['rol']);
    } else
        return FALSE;
}


// Manejar el cierre de sesión
if (isset($_GET['logout'])) {
    // Destruir todas las variables de sesión
    $_SESSION = array();

    // Destruir la sesión
    session_destroy();

    // Redirigir al inicio de sesión después de cerrar sesión
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

        // Redirigir a la zona de administrador si el usuario es 'admin'
        if ($_POST["usuario"] === 'admin') {
            header("Location: zona_admin.php");
            exit();  // Asegurarse de que el script se detenga después de la redirección
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-index.css">
    <title>Pizzeria</title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <?php
            if (isset($_SESSION['usuario'])) {
                // Si hay una sesión activa, mostrar la bienvenida y el botón de cierre de sesión
                echo "<h1>Bienvenido, " . $_SESSION['usuario'] . "</h1>";
                echo "<a href='index.php?logout=true'>Cerrar Sesión</a>";
                menu();
                echo "<a href='pedido.php'>Realizar Pedido</a>";

            } else {
                // Si no hay sesión activa, mostrar el formulario de inicio de sesión
                echo "<h1>Iniciar Sesión</h1>";

                if (isset($err)) {
                    echo "<p class='incorrect'>Usuario o contraseña incorrectos</p>";
                    
                }

                echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'>";
                echo "<label for='usuario'>Usuario: </label>";
                echo "<input value='" . (isset($usuario) ? $usuario : '') . "' name='usuario' placeholder='Usuario...'>"; //pREGUNTAR LUEGO A CHATGPT QUE HACE
                echo "<label for='clave'>Contraseña: </label>";
                echo "<input type='password' name='clave' placeholder='Contraseña...'>";
                echo "<button type='submit'>Enviar</button>";
                echo "</form>";
                
                menu();
                echo "<a href='nuevo_usuario.php'>Regístrese para comenzar el pedido</a>";
            }
                
            /************LA CARTA VA AQUÍ************************/
            function menu(){
                echo "<section>";
            echo "<h1>MENÚ</h1>";
            echo "<div class='tabla'>";
            echo "<table border='2'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Nombre</th>";
            echo "<th>Ingredientes</th>";
            echo "<th>Precio</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            // Tu consulta para obtener datos de la tabla pizzas
            $conn = conectarBD();
            $consulta = $conn->prepare("SELECT nombre, ingredientes, precio FROM pizzas");
            $consulta->execute();

            // Iterar sobre los resultados y mostrar en la tabla
            foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
                echo "<tr>";
                echo "<td>{$row['nombre']}</td>";
                echo "<td>{$row['ingredientes']}</td>";
                echo "<td>{$row['precio']}€</td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
            echo "</div>";
            echo "</section>";
            }
            
            ?>
        </div>
    </div>
</body>

</html>