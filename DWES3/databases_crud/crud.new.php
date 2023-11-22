<?php
function conectarDB(){
    $cadena_conexion = 'mysql:dbname=dwes_t3;host=127.0.0.1';
    $usuario = "root";
    $clave = "";

    try{
        $bd = new PDO($cadena_conexion, $usuario, $clave);
        return $bd;
    } catch(PDOException $e){
        echo "Error al conectar en la base de datos: " . $e->getMessage();
        // En caso de error, puedes manejarlo de alguna manera (redirigir, mostrar un mensaje, etc.).
        exit(); // Termina la ejecución del script en caso de error de conexión.
    }
}

$conn = conectarDB();

function anadirPizza($conn){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombrePizza = $_POST['nombre'];
        $costePizza = $_POST['coste'];
        $precioPizza = $_POST['precio'];
        $ingredientesPizza = $_POST['ingredientes'];

        $insertar = $conn->prepare("INSERT INTO pizzas (nombre, coste, precio, ingredientes) VALUES 
        (:nombre, :coste, :precio, :ingredientes)");

        $insertar->bindParam(':nombre', $nombrePizza);
        $insertar->bindParam(':coste', $costePizza);
        $insertar->bindParam(':precio', $precioPizza);
        $insertar->bindParam(':ingredientes', $ingredientesPizza);

        
        try{
            $insertar->execute();
        } catch(PDOException $e){
        }
    }
}
function mostrarPizzas($conn){
    $consulta = $conn->query("SELECT * FROM pizzas");
    foreach ($consulta->fetchAll(PDO::FETCH_ASSOC) as $row){
        echo $row["nombre"] . " ". $row["coste"]. " " . $row["precio"] . "€". " ". $row["ingredientes"]."<br>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtrar por Pizza</title>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nombre">Añadir Pizza</label>
        <input type="text" id="nombre" name="nombre" placeholder="Agrega la Pizza" required><br>
        <label for="coste">Añadir coste</label>
        <input type="text" id="coste" name="coste" placeholder="Agrega el coste"required><br>
        <label for="precio">Añadir precio</label>
        <input type="text" id="precio" name="precio" placeholder="Agrega el precio"required><br>
        <label for="ingredientes">Añadir Ingredientes</label>
        <input type="text" id="ingredientes" name="ingredientes" placeholder="Agrega los ingredientes"required><br>
        <button type="submit">Añadir</button><br>
    </form>
    <?php anadirPizza($conn); ?>
    <?php mostrarPizzas($conn); ?>
</body>
</html>
