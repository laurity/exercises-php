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
    }
}

$conn = conectarBD();

function listarPizzas($conn)
{
    $consulta = $conn->prepare("SELECT nombre, ingredientes, precio FROM pizzas");
    $consulta->execute();
    echo "<form method='POST'>";
    echo "<label for='pizza'>Seleccione una pizza</label>";
    echo "<select name='pizza' min='1'>";
    echo "<option value='0'>Seleccione una pizza</option>";
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row) {
        echo "<option value='" . $row["nombre"] . "'>" . $row['nombre'] . "</option>";
    }
    echo "</select>";
    echo "<label for='cantidad'>Cantidad</label>";
    echo "<input type='number' name='cantidad' value='1' min='1'>";
    echo "<button type='submit'>Añadir a pedido</button>";
    echo "</form>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["pizza"]) && isset($_POST["cantidad"])) {
        $pizza = $_POST["pizza"];
        $cantidad = $_POST["cantidad"];
        if ($pizza == '0') {
            echo "Por favor, selecciona una pizza.";
        } else {
            if (!isset($_SESSION["pedido"])) {
                $_SESSION["pedido"] = array();
            }

            $pizzaIndex = -1;
            foreach ($_SESSION["pedido"] as $index => $item) {
                if ($item["pizza"] == $pizza) {
                    $pizzaIndex = $index;
                    break;
                }
            }

            if ($pizzaIndex != -1) {
                $_SESSION["pedido"][$pizzaIndex]["cantidad"] += $cantidad;
            } else {
                $_SESSION["pedido"][] = array("pizza" => $pizza, "cantidad" => $cantidad);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido de <?php echo $_SESSION['nombre'] ?></title>
</head>

<body>
    <h1>Pedido de <?php echo $_SESSION['nombre'] ?></h1>
    <h2>Seleccione las pizzas que desea añadir al pedido:</h2>
    <?php listarPizzas($conn); ?>

    <p>Resumen de tu pedido, <?php echo $_SESSION['nombre'] ?></p>
    
    <?php
    if (isset($_SESSION["pedido"]) && !empty($_SESSION["pedido"])) {
        if (!isset($_SESSION['id'])) {
            echo "El usuario no está autenticado";
            return;
        }

        echo "<form method='POST'>";
        echo "<table border='1'>";
        echo "<tr><th>Pizza</th><th>Cantidad</th><th>Precio</th></tr>";
        $total = 0;
        $detalle_pedido = "";
        foreach ($_SESSION["pedido"] as $item) {
            $sql = "SELECT precio FROM pizzas WHERE nombre = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$item['pizza']]);
            $precio = $stmt->fetchColumn();
        
            echo "<tr><td>$item[pizza]</td><td>$item[cantidad]</td><td>$precio</td></tr>";
            
            $total += $precio * $item['cantidad'];
            $detalle_pedido .= $item['pizza'] . "; ";
        }
        }
        echo "</table>";
        echo "<input type='submit' name='confirmar_pedido' value='Confirmar pedido'>";
        echo "</form>";

        if (isset($_POST['confirmar_pedido'])) {
            $sql = "INSERT INTO pedidos (id_cliente, fecha_pedido, detalle_pedido, total) VALUES (:id_cliente, NOW(), :detalle_pedido, :total)";
            $stmt = $conn->prepare($sql);
            $params = [
                ':id_cliente' => $_SESSION['id'],
                ':detalle_pedido' => $detalle_pedido,
                ':total' => $total
            ];
            if (!$stmt->execute($params)) {
                echo "Error al insertar el pedido: ";
                print_r($stmt->errorInfo());
            } else {
                $_SESSION["pedido"] = array(); // Vaciamos el pedido
                header("Location: gracias.php");
                exit;
            }
        }
        
    ?>
</body>

</html>