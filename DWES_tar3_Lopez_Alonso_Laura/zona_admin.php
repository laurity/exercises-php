<?php
session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php?redirigido=true");
}

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
        exit;
    }
}
$conn = conectarBD();

function listarPizzas($conn)
{
    $consulta = $conn->prepare("SELECT id, nombre, ingredientes, precio, coste FROM pizzas");
    $consulta->execute();

    echo "<table border='1'>";
    echo "<tr><th>Pizza</th><th>Ingredientes</th><th>Precio</th><th>Coste</th><th>Acciones Admin</th></tr>";

    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<tr>";
        echo "<td>$row[nombre]</td><td>$row[ingredientes]</td><td>$row[precio]€</td><td>$row[coste]€</td>";
        echo "<td>";


        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<button type='submit' name='editar'>Editar</button>";
        echo "</form>";


        echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post' style='display: inline;'>";
        echo "<input type='hidden' name='id' value='$row[id]'>";
        echo "<button type='submit' name='borrar'>Borrar</button>";
        echo "</form>";

        echo "</td>";
        echo "</tr>";
    }

    echo "</table>";
}

if (isset($_GET['logout'])) {
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
    exit();
}


function crearPizza($conn)
{
    $nombrePizza = $_POST["nombrePizza"];
    $costePizza = floatval($_POST["costePizza"]);
    $precioPizza = floatval($_POST["precioPizza"]);
    $ingredientesPizza = $_POST["ingredientesPizza"];

    $insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES 
    (:nombre, :coste, :precio, :ingredientes)");

    $insertar->bindParam(':nombre', $nombrePizza);
    $insertar->bindParam(':coste', $costePizza);
    $insertar->bindParam(':precio', $precioPizza);
    $insertar->bindParam(':ingredientes', $ingredientesPizza);

    try {
        $insertar->execute();
    } catch (PDOException $e) {
        echo "Error al insertar la pizza: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function borrarPizza($conn, $idPizza)
{
    $eliminar = $conn->prepare("DELETE FROM pizzas WHERE id = :id");

    $eliminar->bindParam(":id", $idPizza);

    $eliminar->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        crearPizza($conn);
    } elseif (isset($_POST["editar"])) {
        //editarPizza($conn);
    } elseif (isset($_POST["borrar"])) {

        $idPizzaABorrar = $_POST["id"];
        borrarPizza($conn, $idPizzaABorrar);
    }
} else {
    $nombrePizza = $costePizza = $precioPizza = $ingredientesPizza = '';
}

$nombrePizza = $costePizza = $precioPizza = $ingredientesPizza = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Administrador
        <?php echo $_SESSION['nombre'] ?>
    </title>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <h1>Bienvenido, Admin</h1>
            <h1>Listado de Pizzas</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="nombrePizza">Nombre de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($nombrePizza); ?>" name="nombrePizza"
                    placeholder="Nombre de la Pizza..." required><br>

                <label for="costePizza">Coste de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($costePizza); ?>" name="costePizza"
                    placeholder="Coste de la Pizza..." required><br>

                <label for="precioPizza">Precio de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($precioPizza); ?>" name="precioPizza"
                    placeholder="Precio de la Pizza..." required><br>

                <label for="ingredientesPizza">Ingredientes de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($ingredientesPizza); ?>" name="ingredientesPizza"
                    placeholder="Ingredientes de la Pizza..." required><br>

                <button type="submit" name="crear">Enviar</button>
            </form>


            <?php
            listarPizzas($conn);
            ?>

            <a href='index.php?logout=true'>Cerrar Sesión</a>
        </div>
    </div>

</body>

</html>