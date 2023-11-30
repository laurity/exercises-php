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

//Funciones del boton editar
function obtenerPizzaPorId($conn, $idPizza)
{
    $consulta = $conn->prepare("SELECT id, nombre, ingredientes, precio, coste FROM pizzas WHERE id = :id");
    $consulta->bindParam(':id', $idPizza);
    $consulta->execute();
    return $consulta->fetch(PDO::FETCH_ASSOC);
}

function editarPizza($conn)
{
    if (isset($_POST["id"])) {
        $idPizza = $_POST["id"];
        $pizza = obtenerPizzaPorId($conn, $idPizza);

        if ($pizza) {
            echo "<h2>Editar Pizza</h2>";
            echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
            echo "<input type='hidden' name='id' value='$pizza[id]'>";
            echo "<label for='nombrePizza'>Nombre de la Pizza:</label>";
            echo "<input value='" . htmlspecialchars($pizza['nombre']) . "' name='nombrePizza' placeholder='Nombre de la Pizza...' required><br>";

            echo "<label for='costePizza'>Coste de la Pizza:</label>";
            echo "<input value='" . htmlspecialchars($pizza['coste']) . "' name='costePizza' placeholder='Coste de la Pizza...' required><br>";

            echo "<label for='precioPizza'>Precio de la Pizza:</label>";
            echo "<input value='" . htmlspecialchars($pizza['precio']) . "' name='precioPizza' placeholder='Precio de la Pizza...' required><br>";

            echo "<label for='ingredientesPizza'>Ingredientes de la Pizza:</label>";
            echo "<input value='" . htmlspecialchars($pizza['ingredientes']) . "' name='ingredientesPizza' placeholder='Ingredientes de la Pizza...' required><br>";

            echo "<button type='submit' name='guardarEdicion'>Guardar Edición</button>";
            echo "</form>";
        }
    }
}

function guardarEdicionPizza($conn)
{
    $idPizza = $_POST["id"];
    $nombrePizza = $_POST["nombrePizza"];
    $costePizza = floatval($_POST["costePizza"]);
    $precioPizza = floatval($_POST["precioPizza"]);
    $ingredientesPizza = $_POST["ingredientesPizza"];

    $editar = $conn->prepare("UPDATE pizzas SET nombre = :nombre, coste = :coste, precio = :precio, ingredientes = :ingredientes WHERE id = :id");

    $editar->bindParam(':id', $idPizza);
    $editar->bindParam(':nombre', $nombrePizza);
    $editar->bindParam(':coste', $costePizza);
    $editar->bindParam(':precio', $precioPizza);
    $editar->bindParam(':ingredientes', $ingredientesPizza);

    try {
        $editar->execute();
    } catch (PDOException $e) {
        echo "Error al editar la pizza: " . $e->getMessage();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["crear"])) {
        crearPizza($conn);
    } elseif (isset($_POST["editar"])) {    //Para que se muestre el formulario
        editarPizza($conn);
    } elseif (isset($_POST["guardarEdicion"])) {    //Para que edite la pizza
        guardarEdicionPizza($conn);
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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style-admin.css">
    <title>Administrador<?php echo $_SESSION['nombre'] ?></title>
</head>

<body>
    <div >
            <h1>Bienvenido, Admin</h1>
            <h1>Listado de Pizzas</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <label for="nombrePizza">Nombre de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($nombrePizza); ?>" name="nombrePizza" placeholder="Nombre de la Pizza..." required><br>

                <label for="costePizza">Coste de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($costePizza); ?>" name="costePizza" placeholder="Coste de la Pizza..." required><br>

                <label for="precioPizza">Precio de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($precioPizza); ?>" name="precioPizza" placeholder="Precio de la Pizza..." required><br>

                <label for="ingredientesPizza">Ingredientes de la Pizza:</label>
                <input value="<?php echo htmlspecialchars($ingredientesPizza); ?>" name="ingredientesPizza" placeholder="Ingredientes de la Pizza..." required><br>

                <button type="submit" name="crear">Enviar</button>
            </form>

            <?php
            listarPizzas($conn);
            ?>

            <a href='index.php?logout=true'>Cerrar Sesión</a>
    </div>
</body>

</html>
<?php
$sql_pizzas = "SELECT nombre FROM pizzas";
$resultado_pizzas = $conn->query($sql_pizzas);
$pizzas = array();

if ($resultado_pizzas->rowCount() > 0) {
    while($row_pizza = $resultado_pizzas->fetch(PDO::FETCH_ASSOC)) {
        $nombre_pizza = $row_pizza["nombre"];
        $sql_pedidos = "SELECT COUNT(*) as cantidad FROM pedidos WHERE detalle_pedido LIKE '%$nombre_pizza%'";
        $resultado_pedidos = $conn->query($sql_pedidos);
        $row_pedidos = $resultado_pedidos->fetch(PDO::FETCH_ASSOC);
        $cantidad = $row_pedidos['cantidad'];
        $pizzas[$nombre_pizza] = $cantidad;
    }
} else {
    echo "No se encontraron pizzas";
}

arsort($pizzas);

echo "<table>";
echo "<tr><th>Pizza</th><th>Vendida</th></tr>";

foreach($pizzas as $pizza => $cantidad) {
    echo "<tr><td>" . $pizza . "</td><td>" . $cantidad . " veces</td></tr>";
}

echo "</table>";
?>